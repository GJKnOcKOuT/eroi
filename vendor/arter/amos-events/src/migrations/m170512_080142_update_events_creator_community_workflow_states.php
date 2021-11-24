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
 * @package    arter\amos\events\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\models\Community;
use arter\amos\community\rules\UpdateOwnWorkgroupsRule;
use arter\amos\core\migration\AmosMigrationPermissions;
use yii\db\Query;

/**
 * Class m170512_080142_update_events_creator_community_workflow_states
 */
class m170512_080142_update_events_creator_community_workflow_states extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        $authorizations = [];
        
        $communityWorkflowStates = [
            Community::COMMUNITY_WORKFLOW_STATUS_DRAFT,
            Community::COMMUNITY_WORKFLOW_STATUS_TO_VALIDATE,
            Community::COMMUNITY_WORKFLOW_STATUS_VALIDATED,
            Community::COMMUNITY_WORKFLOW_STATUS_NOT_VALIDATED
        ];
        
        foreach ($communityWorkflowStates as $communityWorkflowStatus) {
            $query = new Query();
            $query->from('auth_item')->andWhere(['name' => $communityWorkflowStatus]);
            $communityWorkflowStatusFound = $query->one();
            if ($communityWorkflowStatusFound !== false) {
                $authorizations[] = [
                    'name' => $communityWorkflowStatus,
                    'update' => true,
                    'newValues' => [
                        'removeParents' => ['EVENTS_ADMINISTRATOR', 'EVENTS_CREATOR', 'EVENTS_VALIDATOR', 'PLATFORM_EVENTS_VALIDATOR']
                    ]
                ];
            }
        }
        
        $authorizations[] = [
            'name' => UpdateOwnWorkgroupsRule::className(),
            'update' => true,
            'newValues' => [
                'addParents' => ['EVENTS_ADMINISTRATOR', 'EVENTS_CREATOR', 'EVENTS_VALIDATOR', 'PLATFORM_EVENTS_VALIDATOR']
            ]
        ];
        
        return $authorizations;
    }
}
