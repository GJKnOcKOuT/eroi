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
 * @package    arter\amos\partnershipprofiles\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\partnershipprofiles\models\base;

use arter\amos\core\record\Record;
use arter\amos\partnershipprofiles\Module;
use yii\helpers\ArrayHelper;

/**
 * Class PartnershipProfilesCountriesMm
 *
 * This is the base-model class for table "partnership_profiles_countries_mm".
 *
 * @property integer $id
 * @property integer $partnership_profile_id
 * @property integer $country_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\partnershipprofiles\models\PartnershipProfiles[] $partnershipProfiles
 * @property \arter\amos\comuni\models\IstatNazioni[] $countries
 *
 * @package arter\amos\partnershipprofiles\models\base
 */
class PartnershipProfilesCountriesMm extends Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partnership_profiles_countries_mm';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partnership_profile_id', 'country_id'], 'required'],
            [['partnership_profile_id', 'country_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['partnership_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\partnershipprofiles\models\PartnershipProfiles::className(), 'targetAttribute' => ['partnership_profile_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\comuni\models\IstatNazioni::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Module::t('amospartnershipprofiles', 'ID'),
            'partnership_profile_id' => Module::t('amospartnershipprofiles', 'Partnership Profile ID'),
            'country_id' => Module::t('amospartnershipprofiles', 'Country ID'),
            'created_at' => Module::t('amospartnershipprofiles', 'Created at'),
            'updated_at' => Module::t('amospartnershipprofiles', 'Updated at'),
            'deleted_at' => Module::t('amospartnershipprofiles', 'Deleted at'),
            'created_by' => Module::t('amospartnershipprofiles', 'Created by'),
            'updated_by' => Module::t('amospartnershipprofiles', 'Updated by'),
            'deleted_by' => Module::t('amospartnershipprofiles', 'Deleted by')
        ]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnershipProfiles()
    {
        return $this->hasMany(Module::instance()->model('PartnershipProfiles'), ['id' => 'partnership_profile_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasOne(\arter\amos\comuni\models\IstatNazioni::className(), ['id' => 'country_id']);
    }
}
