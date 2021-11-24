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
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;

/**
 * Class m181018_104417_add_ticket_permissions_roles
 */
class m181018_104417_add_ticket_permissions_roles extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return ArrayHelper::merge(
            $this->setPluginRoles(),
            $this->setTicketCategorieModelPermissions(),
            $this->setWidgetsPermissions()
        );
    }

    /**
     * Plugin roles.
     *
     * @return array
     */
    private function setPluginRoles()
    {
        return [
            [
                'name' => 'OPERATORE_TICKET',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Operatore assistenza',
                'parent' => ['BASIC_USER', 'ADMIN']
            ],
            [
                'name' => 'REFERENTE_TICKET',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Referente assistenza',
                'parent' => ['AMMINISTRATORE_TICKET']
            ],
            [
                'name' => 'AMMINISTRATORE_TICKET',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Responsabile assistenza',
                'parent' => ['ADMIN']
            ],
        ];
    }

    /**
     * Ticket categories model permissions
     *
     * @return array
     */
    private function setTicketCategorieModelPermissions()
    {
        return [
            [
                'name' => 'TICKETCATEGORIE_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model TicketCategorie',
                'ruleName' => null,
                'parent' => ['REFERENTE_TICKET']
            ],
            [
                'name' => 'TICKETCATEGORIE_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model TicketCategorie',
                'ruleName' => null,
                'parent' => ['REFERENTE_TICKET']
            ],
            [
                'name' => 'TICKETCATEGORIE_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model TicketCategorie',
                'ruleName' => null,
                'parent' => ['REFERENTE_TICKET']
            ],
            [
                'name' => 'TICKETCATEGORIE_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model TicketCategorie',
                'ruleName' => null,
                'parent' => ['REFERENTE_TICKET']
            ]
        ];
    }

    /**
     * Plugin widgets permissions
     *
     * @return array
     */
    private function setWidgetsPermissions()
    {
        return [
            [
                'name' => arter\amos\ticket\widgets\icons\WidgetIconTicketDashboard::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget WidgetIconTicketDashboard',
                'ruleName' => null,
                'parent' => ['OPERATORE_TICKET']
            ],

        ];
    }
}
