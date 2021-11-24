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
 * Class DevelopmentStage
 *
 * This is the base-model class for table "development_stage".
 *
 * @property integer $id
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $priority
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\partnershipprofiles\models\PartnershipProfiles[] $partnershipProfiles
 *
 * @package arter\amos\partnershipprofiles\models\base
 */
class DevelopmentStage extends Record
{
    public $orderAttribute;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'development_stage';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'required'],
            [['created_at', 'updated_at', 'deleted_at', 'priority'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by', 'priority'], 'integer'],
            [['value'], 'string', 'max' => 255],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Module::t('amospartnershipprofiles', 'ID'),
            'value' => Module::t('amospartnershipprofiles', 'Value'),
            'priority' => Module::t('amospartnershipprofiles', 'Priority'),
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
        return $this->hasMany(Module::instance()->model('PartnershipProfiles'), ['development_stage_id' => 'id']);
    }
}
