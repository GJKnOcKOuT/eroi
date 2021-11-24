<?php

namespace backend\models\translations;

use Yii;
use raoul2000\workflow\base\SimpleWorkflowBehavior;
use yii\helpers\ArrayHelper;

/**
* This is the base-model class for table "slideshow__translation".
*
    * @property integer $slideshow_id
    * @property string $language
    * @property string $name
    * @property string $label
    * @property string $description
    * @property string $status
    * @property integer $created_by
    * @property integer $updated_by
    * @property integer $deleted_by
    * @property string $created_at
    * @property string $updated_at
    * @property string $deleted_at
    *
            * @property \backend\models\translations\SlideshowTranslation $slideshow
    */
class SlideshowTranslation extends \arter\amos\core\record\Record
{


    public $language_source;


/**
* @inheritdoc
*/
public static function tableName()
{
return 'slideshow__translation';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['slideshow_id', 'language'], 'required'],
            [['slideshow_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['name', 'label', 'description'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['language', 'status'], 'string', 'max' => 255],
            [['slideshow_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\slideshow\models\Slideshow::className(), 'targetAttribute' => ['slideshow_id' => 'id']],
 ['language_source', 'safe'],
];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
'language_source' => \Yii::t('amostranslation', 'Select another source language'),
    'slideshow_id' => Yii::t('amostranslation', 'Slideshow ID'),
    'language' => Yii::t('amostranslation', 'Language'),
    'name' => Yii::t('amostranslation', 'Name'),
    'label' => Yii::t('amostranslation', 'Label'),
    'description' => Yii::t('amostranslation', 'Description'),
    'status' => Yii::t('amostranslation', 'Status'),
    'created_by' => Yii::t('amostranslation', 'Created By'),
    'updated_by' => Yii::t('amostranslation', 'Updated By'),
    'deleted_by' => Yii::t('amostranslation', 'Deleted By'),
    'created_at' => Yii::t('amostranslation', 'Created At'),
    'updated_at' => Yii::t('amostranslation', 'Updated At'),
    'deleted_at' => Yii::t('amostranslation', 'Deleted At'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSlideshow()
    {
    return $this->hasOne(\arter\amos\slideshow\models\Slideshow::className(), ['id' => 'slideshow_id']);
    }
}
