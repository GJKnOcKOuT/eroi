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
 * @package    arter\amos\events\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m170317_154222_events_wizflow_permissions
 */
class m170317_154222_events_wizflow_permissions extends AmosMigrationPermissions
{
    /**
     * Use this function to map permissions, roles and associations between permissions and roles. If you don't need to
     * to add or remove any permissions or roles you have to delete this method.
     */
    protected function setAuthorizations()
    {
        $this->authorizations = [
            [
                'name' => 'EventCreationWizardWorkflow/INTRODUCTION',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Wizflow step permission: introduction',
                'ruleName' => null,
                'parent' => ['EVENTS_ADMINISTRATOR', 'EVENTS_CREATOR']
            ],
            [
                'name' => 'EventCreationWizardWorkflow/DESCRIPTION',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Wizflow step permission: description',
                'ruleName' => null,
                'parent' => ['EVENTS_ADMINISTRATOR', 'EVENTS_CREATOR']
            ],
            [
                'name' => 'EventCreationWizardWorkflow/ORGANIZATIONALDATA',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Wizflow step permission: organizational data',
                'ruleName' => null,
                'parent' => ['EVENTS_ADMINISTRATOR', 'EVENTS_CREATOR']
            ],
            [
                'name' => 'EventCreationWizardWorkflow/PUBLICATION',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Wizflow step permission: publication',
                'ruleName' => null,
                'parent' => ['EVENTS_ADMINISTRATOR', 'EVENTS_CREATOR']
            ],
            [
                'name' => 'EventCreationWizardWorkflow/SUMMARY',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Wizflow step permission: summary',
                'ruleName' => null,
                'parent' => ['EVENTS_ADMINISTRATOR', 'EVENTS_CREATOR']
            ]
        ];
    }
}
