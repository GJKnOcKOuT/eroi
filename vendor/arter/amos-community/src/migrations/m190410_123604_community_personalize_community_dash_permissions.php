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
* Class m190408_153604_community_amos_widgets_mm_permissions*/
class m190410_123604_community_personalize_community_dash_permissions extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
                [
                    'name' =>  'COMMUNITY_WIDGETS_ADMIN_PERSONALIZE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permission to manage communties widgets only for admin',
                ],
                [
                    'name' =>  'COMMUNITY_WIDGETS_CONFIGURATOR',
                    'update' => true,
                    'newValues' => [
                        'addParents' => ['COMMUNITY_MEMBER','AMMINISTRATORE_COMMUNITY']
                    ],
                ],
            ];
    }
}
