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
 * @package    arter\amos\documenti\components
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\documenti\components;

use arter\amos\attachments\models\File;
use arter\amos\core\components\PartQuestionarioAbstract;
use arter\amos\documenti\AmosDocumenti;
use arter\amos\documenti\models\Documenti;
use Yii;
use yii\web\UploadedFile;

/**
 * Class PartsWizardDocumentiCreation
 * @package arter\amos\documenti\components
 */
class PartsWizardDocumentiCreation extends PartQuestionarioAbstract
{
    const PART_INTRODUCTION = 'introduction';
    const PART_DETAILS = 'details';
    const PART_PUBLICATION = 'publication';
    const PART_SUMMARY = 'summary';
    const PART_FINISH = 'finish';
    
    /**
     * @var Documenti $model The model.
     */
    public $model;
    
    /**
     * @inheritdoc
     */
    public function getStatus($part)
    {
        if ($part == $this->current || $part == $this->currentChild) {
            if (Yii::$app->getRequest()->getIsPost() && !$this->isCompleted($part)) {
                self::$HAS_ERROR = true;
                return self::STATUS_ERROR;
            }
            return self::STATUS_CURRENT;
        } elseif ($this->partIsPostCurrent($part)) {
            return self::STATUS_UNDONE;
        } elseif ($this->isCompleted($part)) {
            return self::STATUS_COMPLETED;
        }
        return self::STATUS_UNDONE;
    }
    
    /**
     * @inheritdoc
     */
    public function initMap()
    {
        $i = 1;
        self::$map = [
            self::PART_INTRODUCTION => [
                'label' => AmosDocumenti::t('amosdocumenti', '#INTRODUCTION'),
                'index' => $i++,
                'description' => '',
                'status' => $this->getStatus(self::PART_INTRODUCTION),
                'title' => $this->getTitle(self::PART_INTRODUCTION),
                'url' => $this->createUrl([self::PART_INTRODUCTION, 'id' => $this->model->id, 'parentId' => $this->model->parent_id]),
            ],
            self::PART_DETAILS => [
                'label' => AmosDocumenti::t('amosdocumenti', '#DETAILS'),
                'index' => $i++,
                'description' => '',
                'status' => $this->getStatus(self::PART_DETAILS),
                'title' => $this->getTitle(self::PART_DETAILS),
                'url' => $this->createUrl([self::PART_DETAILS, 'id' => $this->model->id, 'parentId' => $this->model->parent_id]),
            ],
            self::PART_PUBLICATION => [
                'label' => AmosDocumenti::t('amosdocumenti', '#PUBLICATION'),
                'index' => $i++,
                'description' => '',
                'status' => $this->getStatus(self::PART_PUBLICATION),
                'title' => $this->getTitle(self::PART_PUBLICATION),
                'url' => $this->createUrl([self::PART_PUBLICATION, 'id' => $this->model->id]),
            ],
            self::PART_SUMMARY => [
                'label' => AmosDocumenti::t('amosdocumenti', '#SUMMARY'),
                'index' => $i++,
                'description' => '',
                'status' => $this->getStatus(self::PART_SUMMARY),
                'title' => $this->getTitle(self::PART_SUMMARY),
                'url' => $this->createUrl([self::PART_SUMMARY, 'id' => $this->model->id]),
            ],
            self::PART_FINISH => [
                'label' => AmosDocumenti::t('amosdocumenti', '#FINISH'),
                'index' => $i++,
                'description' => '',
                'status' => $this->getStatus(self::PART_FINISH),
                'title' => $this->getTitle(self::PART_FINISH),
                'url' => $this->createUrl([self::PART_FINISH, 'id' => $this->model->id]),
            ]
        ];
    }
    
    /**
     * @param string $part
     * @return bool
     */
    public function isCompleted($part)
    {
        switch ($part) {
            case self::PART_INTRODUCTION:
                return true;
                break;
            case self::PART_DETAILS:
                $this->model->setScenario(Documenti::SCENARIO_DETAILS);
                $ok = true;
                $cwhBehavior = $this->model->getBehavior('cwhBehavior');
                if (!empty($cwhBehavior)) {
                    $this->model->detachBehavior('cwhBehavior');
                }
                if (!is_null($this->model->documentMainFile)) {
                    $ok = (($this->model->documentMainFile instanceof UploadedFile) || ($this->model->documentMainFile instanceof File));
                }
                $ok = $ok && $this->model->id && $this->model->validate();
                if (!empty($cwhBehavior)) {
                    $this->model->attachBehavior('cwhBehavior', $cwhBehavior);
                }
                if ($ok) {
                    return true;
                }
                break;
            case self::PART_PUBLICATION:
                $this->model->setScenario(Documenti::SCENARIO_PUBLICATION);
                if ($this->model->id && $this->model->validate()) {
                    return true;
                }
                break;
            case self::PART_SUMMARY:
                $previousCompleted = (
                    $this->isCompleted(self::PART_INTRODUCTION) &&
                    $this->isCompleted(self::PART_DETAILS) &&
                    $this->isCompleted(self::PART_PUBLICATION)
                );
                $this->model->setScenario(Documenti::SCENARIO_SUMMARY);
                $cwhBehavior = $this->model->getBehavior('cwhBehavior');
                if (!empty($cwhBehavior)) {
                    $this->model->detachBehavior('cwhBehavior');
                }
                $ok = ($previousCompleted && $this->model->id && $this->model->validate());
                if (!empty($cwhBehavior)) {
                    $this->model->attachBehavior('cwhBehavior', $cwhBehavior);
                }
                if ($ok) {
                    return true;
                }
                break;
            case self::PART_FINISH:
                return $this->isCompleted(self::PART_SUMMARY);
                break;
        }
        
        if (!Yii::$app->getRequest()->getIsPost()) {
            $this->model->clearErrors();
        }
        
        return false;
    }
}
