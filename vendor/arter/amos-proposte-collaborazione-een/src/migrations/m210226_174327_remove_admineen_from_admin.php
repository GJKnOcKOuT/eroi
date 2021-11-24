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
* Class m210226_174327_remove_admineen_from_admin*/
class m210226_174327_remove_admineen_from_admin extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {

        return [
            [
                'name' => 'ADMINISTRATOR_EEN',
                'update' =>true,
                'newValues' => [
                    'removeParents' => ['ADMIN']
                ]
            ],
        ];
    }
}
