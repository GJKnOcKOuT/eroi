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
* Class m201204_095200_een_tag_een_permissions*/
class m201204_095200_een_tag_een_permissions extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
                [
                    'name' =>  'EENTAGEEN_CREATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di CREATE sul model EenTagEen',
                    'ruleName' => null,
                    'parent' => ['ADMIN','ADMINISTRATOR_EEN']
                ],
                [
                    'name' =>  'EENTAGEEN_READ',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di READ sul model EenTagEen',
                    'ruleName' => null,
                    'parent' => ['ADMIN','ADMINISTRATOR_EEN']
                    ],
                [
                    'name' =>  'EENTAGEEN_UPDATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di UPDATE sul model EenTagEen',
                    'ruleName' => null,
                    'parent' => ['ADMIN','ADMINISTRATOR_EEN']
                ],
                [
                    'name' =>  'EENTAGEEN_DELETE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di DELETE sul model EenTagEen',
                    'ruleName' => null,
                    'parent' => ['ADMIN','ADMINISTRATOR_EEN']
                ],

            ];
    }
}
