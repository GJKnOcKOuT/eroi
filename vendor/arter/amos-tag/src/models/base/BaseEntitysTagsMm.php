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
 * @package    arter\amos\tag
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\tag\models\base;

use arter\amos\core\record\Record;
use arter\amos\tag\AmosTag;

/**
 * This is the base-model class for table "tag".
 *
 * @property integer $entitys_tags_mm_id
 * @property string $classname
 * @property integer $record_id
 * @property integer $tag_id
 * @property integer $root_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $version
 *
 * @property \arter\amos\tag\models\Tag $tag
 */
class BaseEntitysTagsMm extends Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entitys_tags_mm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entitys_tags_mm_id', 'record_id', 'tag_id', 'root_id'], 'integer'],
            [['classname'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'entitys_tags_mm_id' => AmosTag::t('amostag', 'ID'),
            'record_id' => AmosTag::t('amostag', 'ID record'),
            'tag_id' => AmosTag::t('amostag', 'ID tag'),
            'created_at' => AmosTag::t('amostag', 'Creato il'),
            'updated_at' => AmosTag::t('amostag', 'Aggiornato il'),
            'deleted_at' => AmosTag::t('amostag', 'Cancellato il'),
            'created_by' => AmosTag::t('amostag', 'Creato da'),
            'updated_by' => AmosTag::t('amostag', 'Aggiornato da'),
            'deleted_by' => AmosTag::t('amostag', 'Cancellato da'),
            'version' => AmosTag::t('amostag', 'Versione numero'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(\arter\amos\tag\models\Tag::className(), ['id' => 'tag_id']);
    }
}
