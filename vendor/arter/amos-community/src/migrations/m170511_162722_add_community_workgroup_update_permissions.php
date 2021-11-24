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

use arter\amos\community\models\Community;
use arter\amos\community\rules\UpdateOwnWorkgroupsRule;
use arter\amos\core\migration\AmosMigrationPermissions;
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;

/**
 * Class m170511_162722_add_community_workgroup_update_permissions
 */
class m170511_162722_add_community_workgroup_update_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return ArrayHelper::merge(
            $this->setModelPermissions(),
            $this->setWorkflowPermissions()
        );
    }
    
    private function setModelPermissions()
    {
        return [
            [
                'name' => UpdateOwnWorkgroupsRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Update permission for model Community',
                'ruleName' => UpdateOwnWorkgroupsRule::className(),
            ],
            [
                'name' => 'COMMUNITY_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Update permission for model Community',
                'parent' => [UpdateOwnWorkgroupsRule::className()],
                'dontRemove' => true
            ]
        ];
    }
    
    private function setWorkflowPermissions()
    {
        return [
            [
                'name' => Community::COMMUNITY_WORKFLOW_STATUS_DRAFT,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission workflow community status draft',
                'parent' => [UpdateOwnWorkgroupsRule::className()],
                'dontRemove' => true
            ],
            [
                'name' => Community::COMMUNITY_WORKFLOW_STATUS_TO_VALIDATE,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission workflow community status to validate',
                'parent' => [UpdateOwnWorkgroupsRule::className()],
                'dontRemove' => true
            ],
            [
                'name' => Community::COMMUNITY_WORKFLOW_STATUS_VALIDATED,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission workflow community status validated',
                'parent' => [UpdateOwnWorkgroupsRule::className()],
                'dontRemove' => true
            ]
        ];
    }
}
