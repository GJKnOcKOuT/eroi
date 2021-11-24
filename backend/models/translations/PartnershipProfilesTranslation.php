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


namespace backend\models\translations;

use Yii;
use raoul2000\workflow\base\SimpleWorkflowBehavior;
use yii\helpers\ArrayHelper;

/**
* This is the base-model class for table "partnership_profiles__translation".
*
    * @property integer $partnership_profiles_id
    * @property string $language
    * @property string $title
    * @property string $short_description
    * @property string $extended_description
    * @property string $advantages_innovative_aspects
    * @property string $other_prospect_desired_collab
    * @property string $expected_contribution
    * @property string $contact_person
    * @property string $english_title
    * @property string $english_short_description
    * @property string $english_extended_description
    * @property string $other_work_language
    * @property string $other_development_stage
    * @property string $other_intellectual_property
    * @property string $status
    * @property integer $created_by
    * @property integer $updated_by
    * @property integer $deleted_by
    * @property string $created_at
    * @property string $updated_at
    * @property string $deleted_at
    *
            * @property \backend\models\translations\PartnershipProfilesTranslation $partnershipProfiles
    */
class PartnershipProfilesTranslation extends \arter\amos\core\record\Record
{


    public $language_source;


/**
* @inheritdoc
*/
public static function tableName()
{
return 'partnership_profiles__translation';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['partnership_profiles_id', 'language'], 'required'],
            [['partnership_profiles_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['title', 'short_description', 'extended_description', 'advantages_innovative_aspects', 'other_prospect_desired_collab', 'expected_contribution', 'contact_person', 'english_title', 'english_short_description', 'english_extended_description', 'other_work_language', 'other_development_stage', 'other_intellectual_property'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['language', 'status'], 'string', 'max' => 255],
            [['partnership_profiles_id'], 'exist', 'skipOnError' => true, 'targetClass' => \backend\modules\aster_partnership_profiles\models\PartnershipProfiles::className(), 'targetAttribute' => ['partnership_profiles_id' => 'id']],
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
    'partnership_profiles_id' => Yii::t('amostranslation', 'Partnership Profiles ID'),
    'language' => Yii::t('amostranslation', 'Language'),
    'title' => Yii::t('amostranslation', 'Title'),
    'short_description' => Yii::t('amostranslation', 'Short Description'),
    'extended_description' => Yii::t('amostranslation', 'Extended Description'),
    'advantages_innovative_aspects' => Yii::t('amostranslation', 'Advantages Innovative Aspects'),
    'other_prospect_desired_collab' => Yii::t('amostranslation', 'Other Prospect Desired Collab'),
    'expected_contribution' => Yii::t('amostranslation', 'Expected Contribution'),
    'contact_person' => Yii::t('amostranslation', 'Contact Person'),
    'english_title' => Yii::t('amostranslation', 'English Title'),
    'english_short_description' => Yii::t('amostranslation', 'English Short Description'),
    'english_extended_description' => Yii::t('amostranslation', 'English Extended Description'),
    'other_work_language' => Yii::t('amostranslation', 'Other Work Language'),
    'other_development_stage' => Yii::t('amostranslation', 'Other Development Stage'),
    'other_intellectual_property' => Yii::t('amostranslation', 'Other Intellectual Property'),
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
    public function getPartnershipProfiles()
    {
    return $this->hasOne(\backend\modules\aster_partnership_profiles\models\PartnershipProfiles::className(), ['id' => 'partnership_profiles_id']);
    }
}
