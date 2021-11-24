<?php

namespace backend\models\translations;

use Yii;
use raoul2000\workflow\base\SimpleWorkflowBehavior;
use yii\helpers\ArrayHelper;

/**
* This is the base-model class for table "partnership_profiles_type__translation".
*
    * @property integer $partnership_profiles_type_id
    * @property string $language
    * @property string $name
    * @property string $description
    * @property string $status
    * @property integer $created_by
    * @property integer $updated_by
    * @property integer $deleted_by
    * @property string $created_at
    * @property string $updated_at
    * @property string $deleted_at
    *
            * @property \backend\models\translations\PartnershipProfilesTypeTranslation $partnershipProfilesType
    */
class PartnershipProfilesTypeTranslation extends \arter\amos\core\record\Record
{


    public $language_source;


/**
* @inheritdoc
*/
public static function tableName()
{
return 'partnership_profiles_type__translation';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['partnership_profiles_type_id', 'language'], 'required'],
            [['partnership_profiles_type_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['name', 'description'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['language', 'status'], 'string', 'max' => 255],
            [['partnership_profiles_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\partnershipprofiles\models\PartnershipProfilesType::className(), 'targetAttribute' => ['partnership_profiles_type_id' => 'id']],
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
    'partnership_profiles_type_id' => Yii::t('amostranslation', 'Partnership Profiles Type ID'),
    'language' => Yii::t('amostranslation', 'Language'),
    'name' => Yii::t('amostranslation', 'Name'),
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
    public function getPartnershipProfilesType()
    {
    return $this->hasOne(\arter\amos\partnershipprofiles\models\PartnershipProfilesType::className(), ['id' => 'partnership_profiles_type_id']);
    }
}
