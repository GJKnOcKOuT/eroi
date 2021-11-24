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
 * @package    arter\amos\ticket\rules\workflow
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\ticket\rules\workflow;

use arter\amos\core\rules\BasicContentRule;
use arter\amos\ticket\models\Ticket;

/**
 * Class TicketToProcessingWorkflowRule
 * @package arter\amos\ticket\rules\workflow
 */
class TicketToProcessingWorkflowRule extends BasicContentRule
{
    public $name = 'TicketToProcessingWorkflowRule';

    /**
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        /** @var Ticket $model */
        $firstAnswer = $model->getFirstAnswer();
        return !is_null($firstAnswer) and $model->isReferente($user);
    }
}
