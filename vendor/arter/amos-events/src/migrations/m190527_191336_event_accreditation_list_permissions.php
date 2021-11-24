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
 * Class m190527_191336_event_accreditation_list_permissions*/
class m190527_191336_event_accreditation_list_permissions extends AmosMigrationPermissions
{

    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
            [
                'name' =>  'EVENTACCREDITATIONLIST_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model EventAccreditationList',
                'ruleName' => null,
                'parent' => ['ADMIN', 'EVENTS_ADMINISTRATOR', 'EVENTS_MANAGER']
            ],
            [
                'name' =>  'EVENTACCREDITATIONLIST_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model EventAccreditationList',
                'ruleName' => null,
                'parent' => ['ADMIN', 'EVENTS_ADMINISTRATOR', 'EVENTS_MANAGER']
            ],
            [
                'name' =>  'EVENTACCREDITATIONLIST_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model EventAccreditationList',
                'ruleName' => null,
                'parent' => ['ADMIN', 'EVENTS_ADMINISTRATOR', 'EVENTS_MANAGER']
            ],
            [
                'name' =>  'EVENTACCREDITATIONLIST_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model EventAccreditationList',
                'ruleName' => null,
                'parent' => ['ADMIN', 'EVENTS_ADMINISTRATOR', 'EVENTS_MANAGER']
            ],

        ];
    }
}
