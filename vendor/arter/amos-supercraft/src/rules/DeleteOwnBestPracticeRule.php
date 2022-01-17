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
 * @package    arter\amos\news
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\best\practice\rules;

use arter\amos\best\practice\models\BestPractice;
use arter\amos\core\rules\BasicContentRule;
use Yii;

class DeleteOwnBestPracticeRule extends BasicContentRule
{
    public $name = 'deleteOwnBestPractice';

    /**
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        if (!empty($model->getWorkflowStatus())) {

            if (($model->getWorkflowStatus()->getId() == BestPractice::BESTPRACTICE_WORKFLOW_STATUS_DRAFT || Yii::$app->getUser()->can($model->getValidatorRole(), ['model' => $model])) && $model->created_by == $user) {
                return true;
            }
        }
        return false;
    }
}
