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
 * @package    arter\amos\admin\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m190424_110048_add_admin_basic_lists_permission
 */
class m190424_110048_add_admin_basic_lists_permission extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'USER_PROFILE_BASIC_LIST_ACTIONS',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to see the basic admin plugin lists',
                'parent' => ['AMMINISTRATORE_UTENTI', 'BASIC_USER']
            ]
        ];
    }
}
