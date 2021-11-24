<?php

namespace backend\models\translations;

use Yii;
use raoul2000\workflow\base\SimpleWorkflowBehavior;
use yii\helpers\ArrayHelper;

/**
* This is the base-model class for table "slideshow_pages__translation".
*
    * @property integer $slideshow_pages_id
    * @property string $language
    * @property string $name
    * @property string $pageContent
    * @property string $status
    * @property integer $created_by
    * @property integer $updated_by
    * @property integer $deleted_by
    * @property string $created_at
    * @property string $updated_at
    * @property string $deleted_at
*/
class SlideshowPageTranslation extends \arter\amos\core\record\Record
{


    public $language_source;


/**
* @inheritdoc
*/
public static function tableName()
{
return 'slideshow_pages__translation';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['slideshow_pages_id', 'language'], 'required'],
            [['slideshow_pages_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['name', 'pageContent'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['language', 'status'], 'string', 'max' => 255],
            [['slideshow_pages_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\slideshow\models\SlideshowPage::className(), 'targetAttribute' => ['slideshow_pages_id' => 'id']],
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
    'slideshow_pages_id' => Yii::t('amostranslation', 'Slideshow Pages ID'),
    'language' => Yii::t('amostranslation', 'Language'),
    'name' => Yii::t('amostranslation', 'Name'),
    'pageContent' => Yii::t('amostranslation', 'Page Content'),
    'status' => Yii::t('amostranslation', 'Status'),
    'created_by' => Yii::t('amostranslation', 'Created By'),
    'updated_by' => Yii::t('amostranslation', 'Updated By'),
    'deleted_by' => Yii::t('amostranslation', 'Deleted By'),
    'created_at' => Yii::t('amostranslation', 'Created At'),
    'updated_at' => Yii::t('amostranslation', 'Updated At'),
    'deleted_at' => Yii::t('amostranslation', 'Deleted At'),
];
}
}
