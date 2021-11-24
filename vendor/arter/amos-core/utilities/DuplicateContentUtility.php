<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\core\utilities
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\utilities;

use arter\amos\attachments\models\File;
use arter\amos\core\exceptions\DuplicateContentException;
use arter\amos\core\models\DuplicateContentLog;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\record\Record;
use arter\amos\cwh\AmosCwh;
use arter\amos\cwh\models\CwhConfigContents;
use arter\amos\cwh\models\CwhPubblicazioni;
use arter\amos\cwh\models\CwhPubblicazioniCwhNodiEditoriMm;
use arter\amos\cwh\models\CwhPubblicazioniCwhNodiValidatoriMm;
use arter\amos\tag\models\EntitysTagsMm;
use yii\base\BaseObject;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\log\Logger;

/**
 * Class DuplicateContentUtility
 * @package arter\amos\core\utilities
 */
class DuplicateContentUtility extends BaseObject
{
    const ATTACHMENT_SINGLE = 1;
    const ATTACHMENT_MULTI = 2;

    /**
     * @var Record $model The model to be duplicated
     */
    public $model;

    /**
     * @var array $attachmentsAttributes Key value array with attachment attribute name in the key and the type (single or multi) in the value)
     */
    public $attachmentsAttributes = [];

    /**
     * @var Record $model The model classname to be duplicated
     */
    private $modelClassName;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->modelClassName = $this->model->className();
    }

    /**
     * This method logs the id of the source content and the new duplicated content.
     * @param string $className
     * @param int $oldContentId
     * @param int $newContentId
     * @return bool
     */
    public static function logDuplicatedContent($className, $oldContentId, $newContentId)
    {
        $logDuplication = new DuplicateContentLog();
        $logDuplication->model_classname = $className;
        $logDuplication->source_model_id = $oldContentId;
        $logDuplication->duplicate_model_id = $newContentId;
        return $logDuplication->save();
    }

    /**
     * This method duplicates the entire activity.
     * @return Record|null
     * @throws DuplicateContentException
     * @throws \raoul2000\workflow\base\WorkflowException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function duplicateContent()
    {
        // If the id is missing stop the operations.
        if (!$this->model->id) {
            return null;
        }

        // If the model hasn't the duplicateContentRow stop the operations.
        if (!$this->model->hasMethod('duplicateContentRow')) {
            \Yii::getLogger()->log(BaseAmosModule::t('amoscore', '#duplication_action_missing_model_duplication_row_method'), Logger::LEVEL_ERROR);
            return null;
        }

        // If the model hasn't the getDuplicateContentAttachmentsAttributes stop the operations.
        if (!$this->model->hasMethod('getDuplicateContentAttachmentsAttributes')) {
            \Yii::getLogger()->log(BaseAmosModule::t('amoscore', '#duplication_action_missing_model_duplication_attachments_method'), Logger::LEVEL_ERROR);
            return null;
        }

        $this->attachmentsAttributes = $this->model->getDuplicateContentAttachmentsAttributes();

        $transaction = \Yii::$app->db->beginTransaction();

        $newContent = $this->model->duplicateContentRow();
        if (is_null($newContent)) {
            return null;
        }

        $ok = true;

        foreach ($this->attachmentsAttributes as $attributeName => $type) {
            $ok = $this->duplicateContentAttachFiles($newContent, $attributeName);
            if (!$ok) {
                break;
            }
        }

        if ($ok) {
            $ok = $this->duplicateContentTags($newContent);
        }

        if ($ok) {
            $ok = $this->duplicateContentCwh($newContent);
        }

        if ($ok) {
            $ok = static::logDuplicatedContent($this->modelClassName, $this->model->id, $newContent->id);
        }

        if ($ok) {
            $transaction->commit();
            return $newContent;
        } else {
            $transaction->rollBack();
            return null;
        }
    }

    /**
     * @param Record $newContent
     * @param string $attribute
     * @param bool $isSingle
     * @return bool
     * @throws DuplicateContentException
     */
    public function duplicateContentAttachFiles($newContent, $attribute)
    {
        $oldFiles = $this->findContentAttachmentsToDuplicate($attribute);
        if (count($oldFiles) == 0) {
            return true;
        }
        $allOk = true;
        foreach ($oldFiles as $oldFile) {
            /** @var File $oldFile */
            $ok = $this->duplicateContentOldFile($oldFile, $newContent->id);
            if (!$ok) {
                $allOk = false;
            }
        }
        return $allOk;
    }

    /**
     * @param string $attribute
     * @param bool $isSingle
     * @return array|\yii\db\ActiveRecord[]
     * @throws DuplicateContentException
     */
    private function findContentAttachmentsToDuplicate($attribute)
    {
        $whereCondition = [
            'model' => $this->modelClassName,
            'attribute' => $attribute,
            'itemId' => $this->model->id
        ];
        $type = $this->attachmentsAttributes[$attribute];
        if (($type != self::ATTACHMENT_SINGLE) && ($type != self::ATTACHMENT_MULTI)) {
            throw new DuplicateContentException(BaseAmosModule::t('amoscore', '#duplicate_content_error_attachments_attribute_type_not_valid'));
        }
        if ($type == self::ATTACHMENT_SINGLE) {
            $oldFile = File::findOne($whereCondition);
            $oldFiles = [];
            if (!is_null($oldFile)) {
                $oldFiles[] = $oldFile;
            }
        } else {
            $oldFiles = File::find()->andWhere($whereCondition)->all();
        }
        return $oldFiles;
    }

    /**
     * @param File $oldFile
     * @param int $newContentId
     * @return bool
     */
    private function duplicateContentOldFile($oldFile, $newContentId)
    {
        $file = new File();
        $file->setAttributes($oldFile->attributes);
        $file->id = null;
        $file->itemId = $newContentId;
        $ok = $file->save(false);
        return $ok;
    }

    /**
     * @param Record $newContent
     * @return bool
     */
    private function duplicateContentTags($newContent)
    {
        $moduleTag = \Yii::$app->getModule('tag');
        $ok = true;
        if (in_array($this->modelClassName, $moduleTag->modelsEnabled) && $moduleTag->behaviors) {
            $query = new Query();
            $query->select(['tag_id', 'root_id']);
            $query->from(EntitysTagsMm::tableName());
            $query->where([
                'deleted_at' => null,
                'classname' => $this->modelClassName,
                'record_id' => $this->model->id
            ]);
            $contentTags = $query->all();
            foreach ($contentTags as $contentTag) {
                $entityTag = new EntitysTagsMm();
                $entityTag->classname = $this->modelClassName;
                $entityTag->record_id = $newContent->id;
                $entityTag->tag_id = $contentTag['tag_id'];
                $entityTag->root_id = $contentTag['root_id'];
                $ok = $entityTag->save(false);
                if (!$ok) {
                    break;
                }
            }
        }
        return $ok;
    }

    /**
     * @param Record $newContent
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    private function duplicateContentCwh($newContent)
    {
        /** @var AmosCwh $cwhModule */
        $cwhModule = \Yii::$app->getModule('cwh');

        // If the platform doesn't have the cwh module return true to skip this step.
        if (is_null($cwhModule)) {
            return true;
        }

        // If the model isn't configured in the cwh module return true to skip this step.
        if (!in_array($this->modelClassName, $cwhModule->modelsEnabled)) {
            return true;
        }

        $cwhConfigContent = CwhConfigContents::find()->andWhere(['classname' => $this->modelClassName])->one();

        /** @var CwhPubblicazioni $oldCwhPubblicazioni */
        $oldCwhPubblicazioni = CwhPubblicazioni::find()->andWhere([
            'cwh_config_contents_id' => $cwhConfigContent->id,
            'content_id' => $this->model->id
        ])->one();

        // The missing cwh pubblicazioni row means that there's an error in the old content save operations. The publication can be corrupted.
        if (is_null($oldCwhPubblicazioni)) {
            return false;
        }

        $newCwhPubblicazioni = new CwhPubblicazioni();
        $newCwhPubblicazioni->cwh_config_contents_id = $oldCwhPubblicazioni->cwh_config_contents_id;
        $newCwhPubblicazioni->cwh_regole_pubblicazione_id = $oldCwhPubblicazioni->cwh_regole_pubblicazione_id;
        $newCwhPubblicazioni->content_id = $newContent->id;
        $ok = $newCwhPubblicazioni->save();

        if ($ok) {
            $ok = $this->duplicateCwhPubblicazioniMms(
                $newContent,
                $oldCwhPubblicazioni,
                $newCwhPubblicazioni,
                CwhPubblicazioniCwhNodiValidatoriMm::className()
            );
        }

        if ($ok) {
            $ok = $this->duplicateCwhPubblicazioniMms(
                $newContent,
                $oldCwhPubblicazioni,
                $newCwhPubblicazioni,
                CwhPubblicazioniCwhNodiEditoriMm::className()
            );
        }

        return $ok;
    }

    /**
     * @param Record $newContent
     * @param CwhPubblicazioni $oldCwhPubblicazioni
     * @param CwhPubblicazioni $newCwhPubblicazioni
     * @param string $cwhPubblicazioniMmClassName
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    private function duplicateCwhPubblicazioniMms($newContent, $oldCwhPubblicazioni, $newCwhPubblicazioni, $cwhPubblicazioniMmClassName)
    {
        /** @var CwhPubblicazioniCwhNodiEditoriMm|CwhPubblicazioniCwhNodiValidatoriMm $cwhMmModel */
        $cwhMmModel = \Yii::createObject($cwhPubblicazioniMmClassName);

        /** @var ActiveQuery $query */
        $query = $cwhMmModel::find();

        /** @var CwhPubblicazioniCwhNodiEditoriMm[]|CwhPubblicazioniCwhNodiValidatoriMm[] $cwhMms */
        $cwhMms = $query->andWhere(['cwh_pubblicazioni_id' => $oldCwhPubblicazioni->id])->all();
        $ok = true;

        foreach ($cwhMms as $cwhMm) {
            /** @var CwhPubblicazioniCwhNodiEditoriMm|CwhPubblicazioniCwhNodiValidatoriMm $newCwhMm */
            $newCwhMm = \Yii::createObject($cwhPubblicazioniMmClassName);
            $newCwhMm->cwh_pubblicazioni_id = $newCwhPubblicazioni->id;
            $newCwhMm->cwh_config_id = $cwhMm->cwh_config_id;
            if (strpos($cwhMm->cwh_nodi_id, 'user') !== false) {
                // Case content published in platform
                $newCwhMm->cwh_nodi_id = 'user-' . $newContent->created_by;
                $newCwhMm->cwh_network_id = $newContent->created_by;
            } else {
                // Case content published in network
                $cwhNodiSplit = explode('-', $cwhMm->cwh_nodi_id);
                $cwhNodiPrefix = reset($cwhNodiSplit);
                $newCwhMm->cwh_nodi_id = $cwhNodiPrefix . '-' . $cwhMm->cwh_network_id;
                $newCwhMm->cwh_network_id = $cwhMm->cwh_network_id;
            }
            $ok = $newCwhMm->save();
            if (!$ok) {
                break;
            }
        }

        return $ok;
    }
}
