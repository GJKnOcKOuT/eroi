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
 * @package    arter\amos\notificationmanager\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\notificationmanager\rules;

use arter\amos\core\rules\BasicContentRule;
use arter\amos\notificationmanager\models\Newsletter;
use raoul2000\workflow\base\SimpleWorkflowBehavior;

/**
 * Class OwnNewsletterRule
 * @package arter\amos\notificationmanager\rules
 */
abstract class OwnNewsletterRule extends BasicContentRule
{
    /**
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        /** @var Newsletter|SimpleWorkflowBehavior $model */
        if (!$model->id) {
            return false;
        }
        $workflowStatus = $model->getWorkflowStatus();
        return (!empty($workflowStatus) && ($workflowStatus->getId() == Newsletter::WORKFLOW_STATUS_DRAFT) && ($model->created_by == $user));
    }
}
