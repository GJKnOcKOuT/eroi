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
 * Class m170630_102512_add_new_admin_widgets_permissions
 */
class m170630_102512_add_new_admin_widgets_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        $prefixStr = 'Permissions for the dashboard for the widget ';
        return [
            [
                'name' => \arter\amos\admin\widgets\graphics\WidgetGraphicMyProfile::className(),
                'update' => true,
                'newValues' => [
                    'addParents' => ['BASIC_USER']
                ]
            ],
            [
                'name' => \arter\amos\admin\widgets\icons\WidgetIconMyProfile::className(),
                'update' => true,
                'newValues' => [
                    'addParents' => ['BASIC_USER']
                ]
            ],
            [
                'name' => \arter\amos\admin\widgets\icons\WidgetIconAdmin::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconAdmin',
                'parent' => ['BASIC_USER', 'ADMIN']
            ],
            [
                'name' => \arter\amos\admin\widgets\icons\WidgetIconUserProfile::className(),
                'update' => true,
                'newValues' => [
                    'addParents' => ['BASIC_USER']
                ]
            ],
            [
                'name' => \arter\amos\admin\widgets\icons\WidgetIconValidatedUserProfiles::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconValidatedUserProfiles',
                'parent' => ['BASIC_USER']
            ],
            [
                'name' => \arter\amos\admin\widgets\icons\WidgetIconFacilitatorUserProfiles::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconFacilitatorUserProfiles',
                'parent' => ['BASIC_USER']
            ],
            [
                'name' => \arter\amos\admin\widgets\icons\WidgetIconCommunityManagerUserProfiles::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconCommunityManagerUserProfiles',
                'parent' => ['BASIC_USER']
            ],
            [
                'name' => \arter\amos\admin\widgets\icons\WidgetIconInactiveUserProfiles::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconInactiveUserProfiles',
                'parent' => ['ADMIN']
            ]
        ];
    }
}
