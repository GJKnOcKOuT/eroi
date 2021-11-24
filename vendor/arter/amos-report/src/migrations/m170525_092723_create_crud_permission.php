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
 * @package    arter\amos\report\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;

/**
 * Class m170524_102950_init_comments_permissions
 */
class m170525_092723_create_crud_permission extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return ArrayHelper::merge(
            $this->setPluginRoles(),
            $this->setModelPermissions()
        );
    }

    private function setPluginRoles()
    {
        return [
            [
                'name' => 'REPORT_ADMINISTRATOR',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Administrator role for report plugin',
                'ruleName' => null,
                'parent' => ['ADMIN']
            ],
            [
                'name' => 'REPORT_MODERATOR',
                'type' => Permission::TYPE_ROLE,
                'description' => 'REPORT mode role for report plugin',
                'ruleName' => null,
                'parent' => ['REPORT_ADMINISTRATOR']
            ],
            [
                'name' => 'REPORT_CONTRIBUTOR',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Reports validator role for report plugin',
                'ruleName' => null,
                'parent' => ['REPORT_ADMINISTRATOR']
            ],
        ];
    }

    private function setModelPermissions()
    {
        return [

            // Permissions for model Report
            [
                'name' => 'REPORT_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Create permission for model Report',
                'parent' => ['REPORT_ADMINISTRATOR', 'REPORT_CONTRIBUTOR']
            ],
            [
                'name' => 'REPORT_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Read permission for model Report',
                'parent' => ['REPORT_ADMINISTRATOR', 'REPORT_CONTRIBUTOR', 'REPORT_MODERATOR']
            ],
            [
                'name' => 'REPORT_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Update permission for model Report',
                'parent' => ['REPORT_ADMINISTRATOR', 'REPORT_CONTRIBUTOR', 'REPORT_MODERATOR']
            ],
            [
                'name' => 'REPORT_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Delete permission for model Report',
                'parent' => ['REPORT_ADMINISTRATOR', 'REPORT_CONTRIBUTOR', 'REPORT_MODERATOR']
            ]
        ];
    }
}
