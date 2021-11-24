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

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m170719_122922_permissions_community
 */
class m180605_180022_permissions_workflow_rules extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => \arter\amos\events\rules\workflow\EventsToValidateWorkflowRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check',
                'ruleName' =>  \arter\amos\events\rules\workflow\EventsToValidateWorkflowRule::className(),
                'parent' => ['EVENTS_ADMINISTRATOR', 'EVENTS_CREATOR', 'PLATFORM_EVENTS_VALIDATOR', 'EventValidate', 'EVENTS_VALIDATOR']
            ],
            [
                'name' => 'EventWorkflow/PUBLISHREQUEST',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        \arter\amos\events\rules\workflow\EventsToValidateWorkflowRule::className(),
                    ],
                    'removeParents' => [
                        'EVENTS_ADMINISTRATOR', 'EVENTS_CREATOR', 'PLATFORM_EVENTS_VALIDATOR', 'EventValidate', 'EVENTS_VALIDATOR'
                    ]
                ],
            ],

        ];
    }
}
