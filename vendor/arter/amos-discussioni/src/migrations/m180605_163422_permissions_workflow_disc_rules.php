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
class m180605_163422_permissions_workflow_disc_rules extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => \arter\amos\discussioni\rules\workflow\DiscussioniToValidateWorkflowRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check permissio to validate',
                'ruleName' => \arter\amos\discussioni\rules\workflow\DiscussioniToValidateWorkflowRule::className(),
                'parent' => ['CREATORE_DISCUSSIONI', 'FACILITATORE_DISCUSSIONI', 'DiscussionValidate', 'VALIDATORE_DISCUSSIONI']
            ],
            [
                'name' => 'DiscussioniTopicWorkflow/DAVALIDARE',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        \arter\amos\discussioni\rules\workflow\DiscussioniToValidateWorkflowRule::className()
                    ],
                    'removeParents' => [
                        'CREATORE_DISCUSSIONI', 'FACILITATORE_DISCUSSIONI', 'DiscussionValidate', 'VALIDATORE_DISCUSSIONI'
                    ]
                ],
            ],

        ];
    }
}
