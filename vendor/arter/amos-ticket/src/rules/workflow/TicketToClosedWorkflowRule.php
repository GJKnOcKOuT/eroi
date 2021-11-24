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

//use yii\rbac\Rule;
use arter\amos\core\rules\BasicContentRule;
use arter\amos\ticket\models\Ticket;
use arter\amos\ticket\models\TicketCategorie;

/**
 * Class TicketToClosedWorkflowRule
 * @package arter\amos\ticket\rules\workflow
 */
class TicketToClosedWorkflowRule extends BasicContentRule
{
    public $name = 'ticketToClosedWorkflowRule';

    /**
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        /** @var Ticket $model */
        if (!$model->id) {
            return true;    // TODO errore nella creazione in una categoria tecnica nella chiusura del ticket appena creato sistemare diversamente
        }
        $isCategoriaTecnica = $model->ticketCategoria->tecnica;
//        pr($model->attributes);
//        pr((($model->created_by == $user) && $isCategoriaTecnica) ? "primo if true" : "primo if false");
//        pr(($model->isReferente($user, true, true)) ? "isReferente true" : "isReferente false");
//        pr(($isCategoriaTecnica || ($model->status == Ticket::TICKET_WORKFLOW_STATUS_PROCESSING)) ? "tecnica processing true" : "tecnica processing false");
//        pr((($model->status == Ticket::TICKET_WORKFLOW_STATUS_WAITING) && $model->isAncestor()) ? "waiting ancestor true" : "waiting ancestor false");
//        die();
        return (
            (($model->created_by == $user) && $isCategoriaTecnica) || // creato in una categoria tecnica
//            () || // Permesso di chiusura se referente della vecchia categoria
            (
                $model->isReferente($user) &&
                ($isCategoriaTecnica || ($model->status == Ticket::TICKET_WORKFLOW_STATUS_PROCESSING)) ||
                (($model->status == Ticket::TICKET_WORKFLOW_STATUS_WAITING) && $model->isAncestor())   // è stato forwadato
            )
        );
    }
}
