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
 * @package    arter\amos\admin\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\rules;

use arter\amos\admin\models\UserProfile;
use arter\amos\core\rules\BasicContentRule;

/**
 * Class UpdateProfileFacilitatorRule
 * @package arter\amos\admin\rules
 */
class UpdateProfileFacilitatorRule extends BasicContentRule
{
    public $name = 'updateProfileFacilitator';
    
    /**
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        // Return false if the model is null
        if (is_null($model)) {
            return false;
        }
        /** @var UserProfile $model */
        
        // Check if the profile has a facilitator
        if (is_null($model->facilitatore)) {
            return false;
        }
        
        // Check if the profile facilitator is the logged user
        return ($model->facilitatore->user_id == $user);
    }
}
