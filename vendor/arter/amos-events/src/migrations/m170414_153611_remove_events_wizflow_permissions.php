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

class m170414_153611_remove_events_wizflow_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->setProcessInverted(true);
    }

    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
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
