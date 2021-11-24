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
 * Class m170629_093155_add_new_admin_workflow_permissions
 */
class m170629_093155_add_new_admin_workflow_permissions extends AmosMigrationPermissions
{
    const WORKFLOW_NAME = 'UserProfileWorkflow';
    
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => self::WORKFLOW_NAME . '/DRAFT',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'UserProfileWorkflow status permission: Draft',
                'parent' => ['ADMIN', 'BASIC_USER']
            ],
            [
                'name' => self::WORKFLOW_NAME . '/TOVALIDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'UserProfileWorkflow status permission: To validate',
                'parent' => ['ADMIN', 'BASIC_USER', 'FACILITATOR']
            ],
            [
                'name' => self::WORKFLOW_NAME . '/VALIDATED',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'UserProfileWorkflow status permission: Validated',
                'parent' => ['ADMIN', 'FACILITATOR']
            ]
        ];
    }
}
