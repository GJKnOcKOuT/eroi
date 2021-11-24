<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_admin\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_admin\models;

use arter\amos\admin\models\UserProfile as AmosUserProfile;
use yii\helpers\ArrayHelper;

/**
 * Class UserProfile
 * @package backend\modules\aster_admin\models
 */
class UserProfile extends AmosUserProfile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['user_profile_role_id'], 'required'],
        ]);
    }
    
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        
        $scenarios[self::SCENARIO_INTRODUCING_MYSELF][] = 'nascita_data';
        $scenarios[self::SCENARIO_ROLE_AND_AREA][] = 'presentazione_personale';
        
        return $scenarios;
    }
    
    /**
     * @return bool
     */
    public function getShortDescription()
    {
        parent::getShortDescription();
    }
    
    /**
     * @return bool
     */
    public function sendCommunication()
    {
        parent::sendCommunication();
    }
}
