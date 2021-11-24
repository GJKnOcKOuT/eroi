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
 * Class m170719_122922_permissions_community
 */
class m180306_153522_permissions_community_roles_rules extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => \arter\amos\community\rules\AuthorRoleRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check if you are an author',
                'ruleName' => \arter\amos\community\rules\AuthorRoleRule::className(),
                'parent' => ['COMMUNITY_READER','COMMUNITY_MEMBER']
            ],
            [
                'name' => \arter\amos\community\rules\EditorRoleRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check if you are an author',
                'ruleName' => \arter\amos\community\rules\EditorRoleRule::className(),
                'parent' => ['COMMUNITY_READER','COMMUNITY_MEMBER']
            ],
            [
                'name' => \arter\amos\community\rules\CommunityManagerRoleRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check if you are an author',
                'ruleName' => \arter\amos\community\rules\CommunityManagerRoleRule::className(),
                'parent' => ['COMMUNITY_READER','COMMUNITY_MEMBER']
            ],
        ];
    }
}
