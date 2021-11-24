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
* Class m180327_162827_add_auth_item_een_archived*/
class m180424_165727_add_auth_item_een_expr_of_interest_history extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = 'Permissions for Een expression of interest history ';

        return [
            [
                'name' =>  'EENEXPROFINTERESTHISTORY_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr ,
                'ruleName' => null,
                'parent' => ['EEN_READER', 'ADMINISTRATOR_EEN']
            ],
            [
                'name' =>  'EENEXPROFINTERESTHISTORY_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr ,
                'ruleName' => null,
                'parent' => ['EEN_READER','ADMINISTRATOR_EEN']
            ],
            [
                'name' =>  'EENEXPROFINTERESTHISTORY_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr ,
                'ruleName' => null,
                'parent' => ['EEN_READER','ADMINISTRATOR_EEN']
            ],
            [
                'name' =>  'EENEXPROFINTERESTHISTORY_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr ,
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_EEN']
            ],
        ];
    }
}
