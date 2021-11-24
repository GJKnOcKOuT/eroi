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

namespace arter\amos\community\rules\workflow;


use arter\amos\community\models\Community;
use arter\amos\core\rules\BasicContentRule;
use Yii;

class CommunityWorkflowDraftRule extends BasicContentRule
{

    public $name = 'communityWorkflowDraft';

    /**
     * @param int|string $user
     * @param \yii\rbac\Item $item
     * @param array $params
     * @param Community $model
     * @return bool
     * @throws \arter\amos\community\exceptions\CommunityException
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        if(\Yii::$app->user->can('COMMUNITY_VALIDATOR')){
            return true;
        }

        $modelOld = Community::findOne($model->id);
        if($modelOld->status == Community::COMMUNITY_WORKFLOW_STATUS_VALIDATED){
            return false;
        }
        //se la manifestazione è in carico a qualcouno può modificare lo stoto solo chi l'ha incarico

        return false;
    }

}