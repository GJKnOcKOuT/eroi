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
use arter\amos\ticket\rules\TicketDeleteRule;
use arter\amos\ticket\rules\TicketManagerInCommunityRoleRule;
use arter\amos\ticket\rules\workflow\TicketToProcessingWorkflowRule;
use yii\rbac\Permission;

/**
 * Class m190207_095324_add_permission_ticket_manager
 */
class m190207_095324_add_permission_ticket_manager extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'TICKET_MANAGER_FOR_COMMUNITY',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to manage tickets, categories and faq',
                'ruleName' => TicketManagerInCommunityRoleRule::className(),
                'parent' => ['VALIDATED_BASIC_USER'],
                'children' => [
                    'TICKET_CREATE',
                    'TICKET_READ',
                    'TICKET_UPDATE',
                    'TICKET_DELETE',
                    'TICKETCATEGORIE_CREATE',
                    'TICKETCATEGORIE_READ',
                    'TICKETCATEGORIE_UPDATE',
                    'TICKETCATEGORIE_DELETE',
                    'TICKETFAQ_CREATE',
                    'TICKETFAQ_READ',
                    'TICKETFAQ_UPDATE',
                    'TICKETFAQ_DELETE',
                    TicketToProcessingWorkflowRule::className(),
                    TicketDeleteRule::className()
                ]
            ]
        ];
    }
}
