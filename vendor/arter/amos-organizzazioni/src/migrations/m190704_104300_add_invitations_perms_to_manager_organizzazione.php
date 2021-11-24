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
 * @package    care-for-workers\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;

/**
 * Class m190502_132139_add_cfw_invitations_permissions_to_responsabile_struttura_role
 */
class m190704_104300_add_invitations_perms_to_manager_organizzazione extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'INVITATIONS_BASIC_USER',
                'update' => true,
                'newValues' => [
                    'addParents' => ['MANAGER_ORGANIZZAZIONE']
                ]
            ],
            [
                'name' => 'INVITATIONS_ADMINISTRATOR',
                'update' => true,
                'newValues' => [
                    'addParents' => ['MANAGER_ORGANIZZAZIONE']
                ]
            ],
            [
                'name' => 'ADD_EMPLOYEE_TO_ORGANIZATION_PERMISSION',
                'update' => true,
                'newValues' => [
                    'addParents' => ['MANAGER_ORGANIZZAZIONE']
                ]
            ]
        ];
    }
}
