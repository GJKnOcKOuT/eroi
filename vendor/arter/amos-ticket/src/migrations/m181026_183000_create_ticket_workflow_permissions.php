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
 * @package    arter\amos\ticket\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use arter\amos\ticket\models\Ticket;
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;

/**
 * Class m181026_183000_create_ticket_workflow_permissions
 */
class m181026_183000_create_ticket_workflow_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return ArrayHelper::merge(
            $this->setWorkflowRulePermissions(),
            $this->setWorkflowStatusPermissions(),
            $this->setTicketRulePermissions(),
            $this->updateTicketModelPermissions()
        );
    }

    /**
     * Workflow statuses permissions
     *
     * @return array
     */
    private function setWorkflowRulePermissions()
    {
        return [
            [
                'name' => \arter\amos\ticket\rules\workflow\TicketToClosedWorkflowRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check if you are an author or the admin',
                'ruleName' => \arter\amos\ticket\rules\workflow\TicketToClosedWorkflowRule::className(),
                'parent' => ['OPERATORE_TICKET']
            ],
            [
                'name' => \arter\amos\ticket\rules\workflow\TicketToProcessingWorkflowRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check if you are the admin',
                'ruleName' => \arter\amos\ticket\rules\workflow\TicketToProcessingWorkflowRule::className(),
                'parent' => ['REFERENTE_TICKET']
            ],
        ];
    }

    /**
     * Workflow statuses permissions
     *
     * @return array
     */
    private function setWorkflowStatusPermissions()
    {
        return [
            [
                'name' => Ticket::TICKET_WORKFLOW_STATUS_WAITING,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso workflow ticket stato in attesa',
                'parent' => ['OPERATORE_TICKET']
            ],
            [
                'name' => Ticket::TICKET_WORKFLOW_STATUS_PROCESSING,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso workflow ticket stato in carico',
                'parent' => [\arter\amos\ticket\rules\workflow\TicketToProcessingWorkflowRule::className()]
            ],
            [
                'name' => Ticket::TICKET_WORKFLOW_STATUS_CLOSED,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso workflow ticket stato chiuso',
                'parent' => [\arter\amos\ticket\rules\workflow\TicketToClosedWorkflowRule::className()]
            ],
        ];
    }

    /**
     * Workflow statuses permissions
     *
     * @return array
     */
    private function setTicketRulePermissions()
    {
        return [
            [
                'name' => \arter\amos\ticket\rules\TicketDeleteRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Nobody can delete',
                'ruleName' => \arter\amos\ticket\rules\TicketDeleteRule::className(),
                'parent' => ['AMMINISTRATORE_TICKET']
            ],
        ];
    }

    /**
     * Ticket categories model permissions
     *
     * @return array
     */
    private function updateTicketModelPermissions()
    {
        return [
            [
                'name' => 'TICKET_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model Ticket',
                //'update' => true,
                'parent' => [\arter\amos\ticket\rules\TicketDeleteRule::className()]
            ],
        ];
    }
}
