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
 * @package    arter\amos\community\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\een\rules;


use arter\amos\core\rules\BasicContentRule;
use yii\helpers\Url;

/**
 * Class CreateSubcommunitiesRule
 * @package arter\amos\community\rules
 */
class EenExprOfInterestWorkflowClosedRule extends BasicContentRule
{
    /**
     * @inheritdoc
     */
    public $name = 'eenExprOfInterestWorkflowClosed';

    /**
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        if(\Yii::$app->user->can('STAFF_EEN')){
            $currentUrl = explode("?", Url::current());
            if($currentUrl[0] == '/een/een-expr-of-interest/not-interested') {
                return true;
            }
            //se la manifestazione è in carico a qualcouno può modificare lo stoto solo chi l'ha incarico
            if($model->eenStaff){
                return $model->isLoggedUserInCharge();
            }
        }
        else {
            $currentUrl = explode("?", Url::current());
            if($currentUrl[0] == '/een/een-expr-of-interest/not-interested') {
                return true;
            }
            if($currentUrl[0]=='/een/een-expr-of-interest' || $currentUrl[0]=='/een/een-expr-of-interest/index'){
                return true;
            }
            else {
                return false;
            }
        }
        return false;
    }

}
