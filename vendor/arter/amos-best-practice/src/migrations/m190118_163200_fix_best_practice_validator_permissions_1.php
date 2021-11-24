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
 * @package    arter\amos\bestpractice\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\best\practice\models\BestPractice;
use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;
use arter\amos\best\practice\rules\workflow\BestPracticeToValidateWorkflowRule;

/**
 * Class m190118_163200_fix_best_practice_validator_permissions_1
 */
class m190118_163200_fix_best_practice_validator_permissions_1 extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'BESTPRACTICE_VALIDATOR',
                'update' => true,
                'newValues' => [
                    'addParents' => ['BESTPRACTICE_ADMINISTRATOR', 'VALIDATOR'],
                    'removeParents' => ['ADMIN']
                ]
            ],
            [
                'name' => 'BestPracticeValidate',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to validate a BestPractice with cwh query',
                'ruleName' => \arter\amos\core\rules\ValidatorUpdateContentRule::className(),
                'parent' => ['BESTPRACTICE_VALIDATOR', 'VALIDATED_BASIC_USER'],
                'children' => ['BESTPRACTICE_UPDATE']
            ],
            [
                'name' => BestPracticeToValidateWorkflowRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check if you are an author',
                'ruleName' => BestPracticeToValidateWorkflowRule::className(),
                'parent' => ['BESTPRACTICE_CREATOR', 'BestPracticeValidate', 'BESTPRACTICE_VALIDATOR']
            ],
            [
                'name' => 'BESTPRACTICE_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'update' => true,
                'newValues' => [
                    'removeParents' => ['BESTPRACTICE_VALIDATOR']
                ]
            ],
            [
                'name' => BestPractice::BESTPRACTICE_WORKFLOW_STATUS_DRAFT,
                'update' => true,
                'newValues' => [
                    'addParents' => ['BestPracticeValidate'],
                    'removeParents' => ['BESTPRACTICE_ADMINISTRATOR', 'BESTPRACTICE_VALIDATOR']
                ]
            ],
            [
                'name' => BestPractice::BESTPRACTICE_WORKFLOW_STATUS_TOVALIDATE,
                'update' => true,
                'newValues' => [
                    'addParents' => [BestPracticeToValidateWorkflowRule::className()],
                    'removeParents' => ['BESTPRACTICE_ADMINISTRATOR', 'BESTPRACTICE_CREATOR', 'BESTPRACTICE_VALIDATOR']
                ]
            ],
            [
                'name' => BestPractice::BESTPRACTICE_WORKFLOW_STATUS_VALIDATED,
                'update' => true,
                'newValues' => [
                    'addParents' => ['BestPracticeValidate'],
                    'removeParents' => ['BESTPRACTICE_ADMINISTRATOR']
                ]
            ]
        ];
    }
}
