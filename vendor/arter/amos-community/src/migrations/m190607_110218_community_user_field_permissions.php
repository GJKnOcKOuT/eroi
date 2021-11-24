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
* Class m190607_110218_community_user_field_permissions*/
class m190607_110218_community_user_field_permissions extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
                [
                    'name' =>  'COMMUNITYUSERFIELD_CREATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di CREATE sul model CommunityUserField',
                    'ruleName' => null,
                    'parent' => ['AMMINISTRATORE_COMMUNITY', \arter\amos\community\rules\CommunityManagerRoleRule::className()]
                ],
                [
                    'name' =>  'COMMUNITYUSERFIELD_READ',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di READ sul model CommunityUserField',
                    'ruleName' => null,
                    'parent' => ['AMMINISTRATORE_COMMUNITY' ,'COMMUNITY_MEMBER']
                    ],
                [
                    'name' =>  'COMMUNITYUSERFIELD_UPDATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di UPDATE sul model CommunityUserField',
                    'ruleName' => null,
                    'parent' => ['AMMINISTRATORE_COMMUNITY', \arter\amos\community\rules\CommunityManagerRoleRule::className()]
                ],
                [
                    'name' =>  'COMMUNITYUSERFIELD_DELETE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di DELETE sul model CommunityUserField',
                    'ruleName' => null,
                    'parent' => ['AMMINISTRATORE_COMMUNITY',\arter\amos\community\rules\CommunityManagerRoleRule::className()]
                ],
            // ------------------------

            [
                'name' =>  'COMMUNITYUSERFIELDVAL_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model CommunityUserFieldVal',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_COMMUNITY','COMMUNITY_MEMBER']
            ],
            [
                'name' =>  'COMMUNITYUSERFIELDVAL_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model CommunityUserFieldVal',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_COMMUNITY','COMMUNITY_MEMBER']
            ],
            [
                'name' =>  'COMMUNITYUSERFIELDVAL_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model CommunityUserFieldVal',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_COMMUNITY','COMMUNITY_MEMBER']
            ],
            [
                'name' =>  'COMMUNITYUSERFIELDVAL_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model CommunityUserFieldVal',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_COMMUNITY','COMMUNITY_MEMBER']
            ],

            // ------------

            [
                'name' =>  'COMMUNITYUSERFIELDTYPE_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model CommunityUserFieldType',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_COMMUNITY',\arter\amos\community\rules\CommunityManagerRoleRule::className()]
            ],
            [
                'name' =>  'COMMUNITYUSERFIELDTYPE_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model CommunityUserFieldType',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_COMMUNITY',\arter\amos\community\rules\CommunityManagerRoleRule::className()]
            ],
            [
                'name' =>  'COMMUNITYUSERFIELDTYPE_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model CommunityUserFieldType',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_COMMUNITY', \arter\amos\community\rules\CommunityManagerRoleRule::className()]
            ],
            [
                'name' =>  'COMMUNITYUSERFIELDTYPE_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model CommunityUserFieldType',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_COMMUNITY', \arter\amos\community\rules\CommunityManagerRoleRule::className()]
            ],


        ];
    }
}
