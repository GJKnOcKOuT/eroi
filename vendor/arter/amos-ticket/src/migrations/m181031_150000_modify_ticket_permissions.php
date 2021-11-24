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
use arter\amos\ticket\rules\TicketReadRule;
use arter\amos\ticket\rules\TicketUpdateRule;
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;

/**
 * Class m181031_150000_modify_ticket_permissions
 */
class m181031_150000_modify_ticket_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return ArrayHelper::merge(
            $this->setTicketRulePermissions(),
            $this->updateTicketModelPermissions()
        );
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
                'name' => TicketReadRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Who can view',
                'ruleName' => TicketReadRule::className(),
                'parent' => ['OPERATORE_TICKET']
            ],
            [
                'name' => TicketUpdateRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Owner and referent can update',
                'ruleName' => TicketUpdateRule::className(),
                'parent' => ['OPERATORE_TICKET']
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
                'name' => 'TICKET_READ',
                'update' => true,
                'newValues' => [
                    'addParents' => [TicketReadRule::className()]
                ]
            ],
            [
                'name' => 'TICKET_UPDATE',
                'update' => true,
                'newValues' => [
                    'addParents' => [TicketUpdateRule::className()]
                ]
            ]
        ];
    }
}
