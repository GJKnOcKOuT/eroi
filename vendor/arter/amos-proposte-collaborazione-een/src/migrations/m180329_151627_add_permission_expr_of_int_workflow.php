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

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;


/**
* Class m180327_162827_add_auth_item_een_archived*/
class m180329_151627_add_permission_expr_of_int_workflow extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = 'Permissions for Workflow Een Expr of interest';

        return [
                [
                    'name' => 'EenExpressionOfInterestWorkflow/SUSPENDED',
                    'type' => Permission::TYPE_PERMISSION,
                    'status' => \arter\amos\dashboard\models\AmosWidgets::STATUS_ENABLED,
                    'description' => $prefixStr . '',
                    'ruleName' => null,
                    'parent' => ['ADMINISTRATOR_EEN','EEN_READER','STAFF_EEN', 'EEN_VALIDATOR'],
                ],
                [
                    'name' => 'EenExpressionOfInterestWorkflow/TAKENOVER',
                    'type' => Permission::TYPE_PERMISSION,
                    'status' => \arter\amos\dashboard\models\AmosWidgets::STATUS_ENABLED,
                    'description' => $prefixStr . '',
                    'ruleName' => null,
                    'parent' => ['ADMINISTRATOR_EEN','STAFF_EEN', 'EEN_VALIDATOR'],
                ],
                [
                    'name' => 'EenExpressionOfInterestWorkflow/CLOSED',
                    'type' => Permission::TYPE_PERMISSION,
                    'status' => \arter\amos\dashboard\models\AmosWidgets::STATUS_ENABLED,
                    'description' => $prefixStr . '',
                    'ruleName' => null,
                    'parent' => ['ADMINISTRATOR_EEN', 'STAFF_EEN', 'EEN_VALIDATOR'],
                ],

            ];
    }
}
