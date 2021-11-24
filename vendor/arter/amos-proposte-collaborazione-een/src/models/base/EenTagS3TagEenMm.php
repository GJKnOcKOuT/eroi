<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


namespace arter\amos\een\models\base;

use Yii;

/**
 * This is the base-model class for table "een_tag_s3_tag_een_mm".
 *
 * @property integer $id
 * @property integer $een_tag_een_id
 * @property integer $tag_s3_id
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\een\models\EenTagEen $eenTagEen
 * @property \arter\amos\een\models\Tag $tagS3
 */
class  EenTagS3TagEenMm extends \arter\amos\core\record\Record
{
    public $isSearch = false;
    public $tagsS3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'een_tag_s3_tag_een_mm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['een_tag_een_id', 'tagsS3'], 'required'],
            [['een_tag_een_id', 'tag_s3_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at','tagsS3'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['een_tag_een_id'], 'exist', 'skipOnError' => true, 'targetClass' => EenTagEen::className(), 'targetAttribute' => ['een_tag_een_id' => 'id']],
            [['tag_s3_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\tag\models\Tag::className(), 'targetAttribute' => ['tag_s3_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('aster_een', 'ID'),
            'een_tag_een_id' => Yii::t('aster_een', 'TAG EEN'),
            'tag_s3_id' => Yii::t('aster_een', 'TAG S3'),
            'description' => Yii::t('aster_een', 'Descrizione'),
            'created_at' => Yii::t('aster_een', 'Created at'),
            'updated_at' => Yii::t('aster_een', 'Updated at'),
            'deleted_at' => Yii::t('aster_een', 'Deleted at'),
            'created_by' => Yii::t('aster_een', 'Created by'),
            'updated_by' => Yii::t('aster_een', 'Updated by'),
            'deleted_by' => Yii::t('aster_een', 'Deleted by'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEenTagEen()
    {
        return $this->hasOne(\arter\amos\een\models\EenTagEen::className(), ['id' => 'een_tag_een_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagS3()
    {
        return $this->hasOne(\arter\amos\tag\models\Tag::className(), ['id' => 'tag_s3_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(\arter\amos\tag\models\Tag::className(), ['id' => 'tag_s3_id']);
    }
    /**
     * @return ActiveQuery
     */
    public function getTagsS3s()
    {
        return $this->hasMany(EenTagS3TagEenMm::className(), ['een_tag_een_id' => 'een_tag_een_id']);
    }
}
