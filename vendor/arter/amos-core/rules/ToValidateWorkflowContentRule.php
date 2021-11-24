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
 * @package    arter\amos\projectmanagement\rules\workflow
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\rules;

use arter\amos\core\rules\BasicContentRule;
use arter\amos\projectmanagement\models\ProjectsActivities;

class ToValidateWorkflowContentRule extends BasicContentRule {

    public $name = 'toValidateWorkflowContent';
    public $validateRuleName = '';

    public function ruleLogic($user, $item, $params, $model) {
                //if you have the permission to validate a news and you are in Draft, you cannot send the publish request
        if(!empty($model)){
           if(\Yii::$app->user->can($this->validateRuleName, ['model' => $model])){
               return false;
           }
        }
        return true;
    }

}
