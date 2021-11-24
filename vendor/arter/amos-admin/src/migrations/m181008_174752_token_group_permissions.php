<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;


/**
* Class m181008_174752_token_group_permissions*/
class m181008_174752_token_group_permissions extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
            [
                'name' =>  'ADMINISTRATOR_TOKEN',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model TokenGroup',
                'ruleName' => null,
                'parent' => ['ADMIN']
            ],
            [
                'name' =>  'TOKENGROUP_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model TokenGroup',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_TOKEN']
            ],
            [
                'name' =>  'TOKENGROUP_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model TokenGroup',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_TOKEN']
            ],
            [
                'name' =>  'TOKENGROUP_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model TokenGroup',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_TOKEN']
            ],
            [
                'name' =>  'TOKENGROUP_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model TokenGroup',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_TOKEN']
            ],
//---------------------------------------------
            [
                'name' =>  'TOKENUSERS_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model TokenUsers',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_TOKEN']
            ],
            [
                'name' =>  'TOKENUSERS_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model TokenUsers',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_TOKEN']
            ],
            [
                'name' =>  'TOKENUSERS_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model TokenUsers',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_TOKEN']
            ],
            [
                'name' =>  'TOKENUSERS_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model TokenUsers',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_TOKEN']
            ],

        ];
    }
}
