<?php

namespace backend\models\translations;

use Yii;
use raoul2000\workflow\base\SimpleWorkflowBehavior;
use yii\helpers\ArrayHelper;

/**
* This is the base-model class for table "faq__translation".
*
    * @property integer $faq_id
    * @property string $language
    * @property string $domanda
    * @property string $risposta
    * @property string $rotte
    * @property string $status
    * @property integer $created_by
    * @property integer $updated_by
    * @property integer $deleted_by
    * @property string $created_at
    * @property string $updated_at
    * @property string $deleted_at
    *
            * @property \backend\models\translations\FaqTranslation $faq
    */
class FaqTranslation extends \arter\amos\core\record\Record
{


    public $language_source;


/**
* @inheritdoc
*/
public static function tableName()
{
return 'faq__translation';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['faq_id', 'language'], 'required'],
            [['faq_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['domanda', 'risposta', 'rotte'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['language', 'status'], 'string', 'max' => 255],
            [['faq_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\faq\models\Faq::className(), 'targetAttribute' => ['faq_id' => 'id']],
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
    'faq_id' => Yii::t('amostranslation', 'Faq ID'),
    'language' => Yii::t('amostranslation', 'Language'),
    'domanda' => Yii::t('amostranslation', 'Domanda'),
    'risposta' => Yii::t('amostranslation', 'Risposta'),
    'rotte' => Yii::t('amostranslation', 'Rotte'),
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
    public function getFaq()
    {
    return $this->hasOne(\arter\amos\faq\models\Faq::className(), ['id' => 'faq_id']);
    }
}
