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
use arter\amos\community\rules\UpdateCommunitiesManagerRule;
use arter\amos\community\rules\ValidateSubcommunitiesRule;
use arter\amos\core\migration\AmosMigrationPermissions;
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;

/**
 * Class m170508_075132_add_community_manager_rule_and_widget_permissions
 */
class m170508_075132_add_community_manager_rule_and_widget_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return ArrayHelper::merge(
            $this->setModelPermissions(),
            $this->setWorkflowPermissions(),
            $this->setWidgetPermissions()
        );
    }

    private function setModelPermissions()
    {
        return [
            [
                'name' => UpdateCommunitiesManagerRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Update permission for model Community',
                'ruleName' => UpdateCommunitiesManagerRule::className(),
                'parent' => ['COMMUNITY_MEMBER'],
            ],
            [
                'name' => ValidateSubcommunitiesRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Update permission for model Community',
                'ruleName' => ValidateSubcommunitiesRule::className(),
                'parent' => ['COMMUNITY_CREATOR', 'COMMUNITY_VALIDATE'],
            ],
            [
                'name' => 'COMMUNITY_VALIDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Validate permission for model Community',
                'ruleName' => null,
                'parent' => ['COMMUNITY_VALIDATOR'],
                'dontRemove' => true
            ],
            [
                'name' => 'COMMUNITY_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Update permission for model Community',
                'ruleName' => null,
                'parent' => [UpdateCommunitiesManagerRule::className(), ValidateSubcommunitiesRule::className()],
                'dontRemove' => true
            ],
        ];
    }

    private function setWorkflowPermissions()
    {
        return [
            [
                'name' => Community::COMMUNITY_WORKFLOW_STATUS_DRAFT,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permession workflow community status draft',
                'ruleName' => null,
                'parent' => ['COMMUNITY_MEMBER', ValidateSubcommunitiesRule::className()],
                'dontRemove' => true
            ],
            [
                'name' => Community::COMMUNITY_WORKFLOW_STATUS_TO_VALIDATE,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permession workflow community status to validate',
                'ruleName' => null,
                'parent' => ['COMMUNITY_MEMBER', ValidateSubcommunitiesRule::className()],
                'dontRemove' => true
            ],
            [
                'name' => Community::COMMUNITY_WORKFLOW_STATUS_VALIDATED,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permession workflow community status validated',
                'ruleName' => null,
                'parent' => [ValidateSubcommunitiesRule::className()],
                'dontRemove' => true
            ],
        ];
    }

    private function setWidgetPermissions()
    {
        return [
            [
                'name' => 'arter\amos\community\widgets\icons\WidgetIconToValidateCommunities',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Dashboard permission for widget ' . 'WidgetIconToValidateCommunities',
                'ruleName' => null,
                'parent' => ['COMMUNITY_VALIDATOR', ValidateSubcommunitiesRule::className()],
                'dontRemove' => true
            ],
            [
                'name' => \arter\amos\community\widgets\icons\WidgetIconCommunity::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Dashboard permission for widget ' . 'WidgetIconCommunity',
                'ruleName' => null,
                'parent' => ['COMMUNITY_VALIDATOR', 'COMMUNITY_CREATOR', 'COMMUNITY_READER'],
                'dontRemove' => true
            ],
            [
                'name' => \arter\amos\community\widgets\icons\WidgetIconCommunityDashboard::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Dashboard permission for widget ' . 'WidgetIconCommunityDashboard',
                'ruleName' => null,
                'parent' => ['COMMUNITY_VALIDATOR', 'COMMUNITY_CREATOR', 'COMMUNITY_READER'],
                'dontRemove' => true
            ],
            [
                'name' => \arter\amos\community\widgets\icons\WidgetIconCreatedByCommunities::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Dashboard permission for widget ' . 'WidgetIconCreatedByCommunity',
                'ruleName' => null,
                'parent' => ['COMMUNITY_CREATOR'],
                'dontRemove' => true
            ],
            [
                'name' => \arter\amos\community\widgets\icons\WidgetIconMyCommunities::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Dashboard permission for widget ' . 'WidgetIconMyCommunities',
                'ruleName' => null,
                'parent' => ['COMMUNITY_CREATOR', 'COMMUNITY_READER'],
                'dontRemove' => true
            ],
        ];
    }
}
