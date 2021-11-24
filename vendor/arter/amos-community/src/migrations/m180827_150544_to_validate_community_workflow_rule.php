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


use \arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;
use arter\amos\projectmanagement\rules\TaskOrganizationsMmRule;

class m180827_150544_to_validate_community_workflow_rule extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {

        return [

            [
                'name' => \arter\amos\community\rules\workflow\CommunityWorkflowDraftRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Rule to validate rule',
                'ruleName' => \arter\amos\community\rules\workflow\CommunityWorkflowDraftRule::className(),
                'parent' => ['AMMINISTRATORE_COMMUNITY', 'COMMUNITY_CREATE', 'COMMUNITY_CREATOR', 'COMMUNITY_MEMBER', 'COMMUNITY_UPDATE', 'COMMUNITY_VALIDATE', 'arter\amos\community\rules\UpdateOwnWorkgroupsRulE'],
                ],
            [
                'name' => 'CommunityWorkflow/DRAFT',
                'update' => true,
                'newValues' => [
                    'removeParents' => ['AMMINISTRATORE_COMMUNITY', 'COMMUNITY_CREATE', 'COMMUNITY_CREATOR', 'COMMUNITY_MEMBER', 'COMMUNITY_UPDATE', 'COMMUNITY_VALIDATE', 'arter\amos\community\rules\UpdateOwnWorkgroupsRulE'],
                    'addParents' => [\arter\amos\community\rules\workflow\CommunityWorkflowDraftRule::className()]
                ],
            ],


        ];
    }
}
