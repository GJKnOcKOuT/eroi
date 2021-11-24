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
* Class m190731_182105_community_user_field_default_val_permissions*/
class m190731_182105_community_user_field_default_val_permissions extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
                [
                    'name' =>  'COMMUNITYUSERFIELDDEFAULTVAL_CREATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di CREATE sul model CommunityUserFieldDefaultVal',
                    'ruleName' => null,
                    'parent' => ['AMMINISTRATORE_COMMUNITY', \arter\amos\community\rules\CommunityManagerRoleRule::className()]
                ],
                [
                    'name' =>  'COMMUNITYUSERFIELDDEFAULTVAL_READ',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di READ sul model CommunityUserFieldDefaultVal',
                    'ruleName' => null,
                    'parent' => ['COMMUNITY_MEMBER', 'AMMINISTRATORE_COMMUNITY', \arter\amos\community\rules\CommunityManagerRoleRule::className()]
                    ],
                [
                    'name' =>  'COMMUNITYUSERFIELDDEFAULTVAL_UPDATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di UPDATE sul model CommunityUserFieldDefaultVal',
                    'ruleName' => null,
                    'parent' => ['AMMINISTRATORE_COMMUNITY', \arter\amos\community\rules\CommunityManagerRoleRule::className()]
                ],
                [
                    'name' =>  'COMMUNITYUSERFIELDDEFAULTVAL_DELETE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di DELETE sul model CommunityUserFieldDefaultVal',
                    'ruleName' => null,
                    'parent' => ['AMMINISTRATORE_COMMUNITY', \arter\amos\community\rules\CommunityManagerRoleRule::className()]
                ],

            ];
    }
}
