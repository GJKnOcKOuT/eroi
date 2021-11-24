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
 * @package    arter\amos\partnershipprofiles\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use arter\amos\partnershipprofiles\models\ExpressionsOfInterest;
use arter\amos\partnershipprofiles\rules\ChangePartPropExprsOfIntStatusRule;
use arter\amos\partnershipprofiles\rules\ExprsOfIntAllowedStatesRule;
use yii\rbac\Permission;

/**
 * Class m171130_114117_change_expressions_of_interest_states_permissions_1
 */
class m171130_114117_change_expressions_of_interest_states_permissions_1 extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => ChangePartPropExprsOfIntStatusRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to modify own partnership profile expressions of interest states',
                'ruleName' => ChangePartPropExprsOfIntStatusRule::className(),
                'parent' => ['PARTNERSHIP_PROFILES_CREATOR'],
                'children' => [
                    ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_TOVALIDATE,
                    ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_RELEVANT,
                    ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_REJECTED
                ]
            ],
            [
                'name' => ExprsOfIntAllowedStatesRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to modify own partnership profile expressions of interest states',
                'ruleName' => ExprsOfIntAllowedStatesRule::className(),
                'parent' => ['EXPRESSIONS_OF_INTEREST_CREATOR'],
                'children' => [
                    ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_DRAFT,
                    ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_ACTIVE
                ]
            ],
            [
                'name' => ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_DRAFT,
                'update' => true,
                'newValues' => [
                    'removeParents' => ['EXPRESSIONS_OF_INTEREST_CREATOR']
                ]
            ],
            [
                'name' => ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_ACTIVE,
                'update' => true,
                'newValues' => [
                    'removeParents' => ['EXPRESSIONS_OF_INTEREST_CREATOR']
                ]
            ],
            [
                'name' => ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_TOVALIDATE,
                'update' => true,
                'newValues' => [
                    'removeParents' => ['PARTNERSHIP_PROFILES_CREATOR']
                ]
            ],
            [
                'name' => ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_RELEVANT,
                'update' => true,
                'newValues' => [
                    'removeParents' => ['PARTNERSHIP_PROFILES_CREATOR']
                ]
            ],
            [
                'name' => ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_REJECTED,
                'update' => true,
                'newValues' => [
                    'removeParents' => ['PARTNERSHIP_PROFILES_CREATOR']
                ]
            ]
        ];
    }
}
