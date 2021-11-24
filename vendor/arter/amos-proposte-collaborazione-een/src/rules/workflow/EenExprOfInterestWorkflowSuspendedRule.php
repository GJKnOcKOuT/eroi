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

namespace arter\amos\een\rules\workflow;


use arter\amos\core\rules\BasicContentRule;
use arter\amos\een\models\EenExprOfInterest;
use yii\rbac\Rule;
use Yii;

class EenExprOfInterestWorkflowSuspendedRule extends BasicContentRule
{

    public $name = 'eenExprOfInterestWorkflowSuspended';

    /**
     * @param int|string $user
     * @param \yii\rbac\Item $item
     * @param array $params
     * @param EenExprOfInterest $model
     * @return bool
     * @throws \arter\amos\community\exceptions\CommunityException
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        //se la manifestazione è in carico a qualcouno può modificare lo stoto solo chi l'ha incarico
        if($model->eenStaff){
            return $model->isLoggedUserInCharge();
        }

        return false;
    }

}