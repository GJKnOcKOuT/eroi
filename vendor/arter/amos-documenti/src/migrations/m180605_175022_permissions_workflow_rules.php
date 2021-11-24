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
 * @package    arter\amos\documenti\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m170719_122922_permissions_community
 */
class m180605_175022_permissions_workflow_rules extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => \arter\amos\documenti\rules\workflow\DocumentiToValidateWorkflowRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check',
                'ruleName' => \arter\amos\documenti\rules\workflow\DocumentiToValidateWorkflowRule::className(),
                'parent' => ['CREATORE_DOCUMENTI', 'FACILITATORE_DOCUMENTI', 'DocumentValidate', 'VALIDATORE_DOCUMENTI']
            ],
            [
                'name' => 'DocumentiWorkflow/DAVALIDARE',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        \arter\amos\documenti\rules\workflow\DocumentiToValidateWorkflowRule::className()
                    ],
                    'removeParents' => [
                        'CREATORE_DOCUMENTI', 'FACILITATORE_DOCUMENTI', 'DocumentValidate', 'VALIDATORE_DOCUMENTI'
                    ]
                ],
            ],

        ];
    }
}
