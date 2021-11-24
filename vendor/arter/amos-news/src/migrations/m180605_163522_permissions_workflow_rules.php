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
 * @package    arter\amos\news\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m180605_163522_permissions_workflow_rules
 */
class m180605_163522_permissions_workflow_rules extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => \arter\amos\news\rules\workflow\NewsToValidateWorkflowRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check if you are an author',
                'ruleName' => \arter\amos\news\rules\workflow\NewsToValidateWorkflowRule::className(),
                'parent' => ['CREATORE_NEWS', 'FACILITATORE_NEWS', 'NewsValidate', 'VALIDATORE_NEWS']
            ],
            [
                'name' => 'NewsWorkflow/DAVALIDARE',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        \arter\amos\news\rules\workflow\NewsToValidateWorkflowRule::className()
                    ],
                    'removeParents' => [
                        'CREATORE_NEWS', 'FACILITATORE_NEWS', 'NewsValidate', 'VALIDATORE_NEWS'
                    ]
                ],
            ],

        ];
    }
}
