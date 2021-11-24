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
use arter\amos\community\rules\ValidateSubcommunitiesRule;
use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m180126_091534_fix_validate_subcommunities_permission
 */
class m180126_091534_fix_validate_subcommunities_permission extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'ValidateSubcommunities',
                'type' => Permission::TYPE_PERMISSION,
                'ruleName' => ValidateSubcommunitiesRule::className(),
                'description' => 'Permission to validate subcommunities under a specific community parent',
                'parent' => ['COMMUNITY_MEMBER', 'AMMINISTRATORE_COMMUNITY']
            ],
            [
                'name' => 'COMMUNITY_VALIDATE',
                'type' => Permission::TYPE_PERMISSION,
                'update' => true,
                'newValues' => [
                    'addParents' => ['ValidateSubcommunities'],
                ]
            ],
            [
                'name' => 'COMMUNITY_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Update permission for model Community',
                'ruleName' => null,
                'update' => true,
                'newValues' => [
                    'addParents' => ['ValidateSubcommunities'],
                    'removeParents' => [ValidateSubcommunitiesRule::className()],
                ]
            ],
            [
                'name' => ValidateSubcommunitiesRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'update' => true,
                'newValues' => [
                    'removeParents' => ['COMMUNITY_CREATOR', 'COMMUNITY_VALIDATE'],
                ]
            ],
            [
                'name' => Community::COMMUNITY_WORKFLOW_STATUS_DRAFT,
                'type' => Permission::TYPE_PERMISSION,
                'update' => true,
                'newValues' => [
                    'removeParents' => [ValidateSubcommunitiesRule::className()],
                ]
            ],
            [
                'name' => Community::COMMUNITY_WORKFLOW_STATUS_TO_VALIDATE,
                'type' => Permission::TYPE_PERMISSION,
                'update' => true,
                'newValues' => [
                    'removeParents' => [ValidateSubcommunitiesRule::className()],
                ]
            ],
            [
                'name' => Community::COMMUNITY_WORKFLOW_STATUS_VALIDATED,
                'type' => Permission::TYPE_PERMISSION,
                'update' => true,
                'newValues' => [
                    'removeParents' => [ValidateSubcommunitiesRule::className()],
                ]
            ],
            [
                'name' => 'arter\amos\community\widgets\icons\WidgetIconToValidateCommunities',
                'type' => Permission::TYPE_PERMISSION,
                'update' => true,
                'newValues' => [
                    'removeParents' => [ValidateSubcommunitiesRule::className()],
                ]
            ],
        ];
    }
}
