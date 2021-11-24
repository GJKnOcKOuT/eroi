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
 * @package    arter\amos\community\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m170317_082718_add_role_community_member_and_permissions
 */
class m170317_082718_add_role_community_member_and_permissions extends AmosMigrationPermissions
{
    /**
     * Use this function to map permissions, roles and associations between permissions and roles. If you don't need to
     * to add or remove any permissions or roles you have to delete this method.
     */
    protected function setAuthorizations()
    {
        $prefixStr = 'Permesso per la dashboard per il widget ';
        $this->authorizations = [
            [
                'name' => 'COMMUNITY_MEMBER',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Role to view community plugin and apply/be invited to a community',
                'ruleName' => null,     // This is a string
            ],
            [
                'name' => 'COMMUNITY_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di lettura per il model Community',
                'ruleName' => null,
                'parent' => ['COMMUNITY_MEMBER'],
                'dontRemove' => true
            ],
            [
                'name' => \arter\amos\community\widgets\icons\WidgetIconCommunityDashboard::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconCommunityDashboard',
                'ruleName' => null,
                'parent' => ['COMMUNITY_MEMBER'],
                'dontRemove' => true
            ],
            [
                'name' => \arter\amos\community\widgets\icons\WidgetIconCommunity::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconCommunity',
                'ruleName' => null,
                'parent' => ['COMMUNITY_MEMBER'],
                'dontRemove' => true
            ],
            [
                'name' => \arter\amos\community\widgets\icons\WidgetIconMyCommunities::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconMyCommunities',
                'ruleName' => null,
                'parent' => ['COMMUNITY_MEMBER'],
                'dontRemove' => true
            ],
        ];
    }
}
