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
class m180330_105027_add_permission_rules extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = 'Permissions for Workflow Een Expr of interest';

        return [
                [
                    'name' => \arter\amos\een\rules\UpdateOwnEenExprOfInterestRule::className(),
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di modifica di una propria manifstazione di interesse',
                    'ruleName' => \arter\amos\een\rules\UpdateOwnEenExprOfInterestRule::className(),
                    'parent' => ['EEN_READER'],
                    'children' => ['EENEXPROFINTEREST_UPDATE']
                ],
                [
                    'name' => \arter\amos\een\rules\ReadOwnEenExprOfInterestRule::className(),
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di lettura di una propria manifstazione di interesse',
                    'ruleName' => \arter\amos\een\rules\ReadOwnEenExprOfInterestRule::className(),
                    'parent' => ['EEN_READER'],
                    'children' => ['EENEXPROFINTEREST_READ']
                ],

                [
                    'name' => \arter\amos\een\rules\EenExprOfInterestWorkflowClosedRule::className(),
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di lettura di una propria manifstazione di interesse',
                    'ruleName' => \arter\amos\een\rules\EenExprOfInterestWorkflowClosedRule::className(),
                    'parent' => ['EEN_READER'],
                    'children' => ['EenExpressionOfInterestWorkflow/CLOSED']
                ],


        ];
    }
}
