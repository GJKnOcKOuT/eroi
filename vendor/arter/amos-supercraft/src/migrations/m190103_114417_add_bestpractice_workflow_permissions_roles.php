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
 * @package    arter\amos\bestpractice
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\best\practice\models\BestPractice;
use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m190103_114417_add_bestpractice_workflow_permissions_roles
 */
class m190103_114417_add_bestpractice_workflow_permissions_roles extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => SuperCraft::BESTPRACTICE_WORKFLOW_STATUS_DRAFT,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso stato workflow BestPractice: bozza',
                'parent' => [
                    'BESTPRACTICE_ADMINISTRATOR',
                    'BESTPRACTICE_CREATOR',
                    'BESTPRACTICE_VALIDATOR'
                ]
            ],
            [
                'name' => SuperCraft::BESTPRACTICE_WORKFLOW_STATUS_TOVALIDATE,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso stato workflow BestPractice: da validare',
                'parent' => [
                    'BESTPRACTICE_ADMINISTRATOR',
                    'BESTPRACTICE_CREATOR',
                    'BESTPRACTICE_VALIDATOR'
                ]
            ],
            [
                'name' => SuperCraf::BESTPRACTICE_WORKFLOW_STATUS_VALIDATED,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso stato workflow BestPractice: validato',
                'parent' => [
                    'BESTPRACTICE_ADMINISTRATOR',
                    'BESTPRACTICE_VALIDATOR'
                ]
            ]
        ];
    }
}
