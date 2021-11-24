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
 * @package    arter\amos\ticket\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\ticket\rules;

use arter\amos\core\rules\BasicContentRule;
use arter\amos\ticket\models\Ticket;
use raoul2000\workflow\base\SimpleWorkflowBehavior;

/**
 * Class TicketUpdateRule
 * @package arter\amos\ticket\rules
 */
class TicketUpdateRule extends BasicContentRule
{
    public $name = 'TicketUpdateRule';

    /**
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        /** @var Ticket|SimpleWorkflowBehavior $model */
        if (!$model->id) {
            return true;
        }
        $modelWorkflowStatus = $model->getWorkflowStatus();
        if (!empty($modelWorkflowStatus)) {
            return (
                ($modelWorkflowStatus->getId() == Ticket::TICKET_WORKFLOW_STATUS_WAITING) &&
                (($model->created_by == $user) || $model->isReferente($user))
            );
        }
        return false;
    }
}
