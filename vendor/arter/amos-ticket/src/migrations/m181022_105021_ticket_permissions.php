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
use yii\rbac\Permission;


/**
 * Class m181022_105021_ticket_permissions
 */
class m181022_105021_ticket_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'TICKET_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model Ticket',
                'ruleName' => null,
                'parent' => ['OPERATORE_TICKET']
            ],
            [
                'name' => 'TICKET_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model Ticket',
                'ruleName' => null,
                'parent' => ['OPERATORE_TICKET']
            ],
            [
                'name' => 'TICKET_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model Ticket',
                'ruleName' => null,
                'parent' => ['OPERATORE_TICKET']
            ],
            [
                'name' => 'TICKET_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model Ticket',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_TICKET']
            ],
        ];
    }
}
