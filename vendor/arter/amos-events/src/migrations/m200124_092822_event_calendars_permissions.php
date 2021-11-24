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
 * Class m200124_092822_event_calendars_permissions*/
class m200124_092822_event_calendars_permissions extends AmosMigrationPermissions
{

    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
            [
                'name' => 'EVENTCALENDARS_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model EventCalendars',
                'ruleName' => null,
                'parent' => ['EVENTS_ADMINISTRATOR','arter\amos\events\rules\EventsUpdateRule']
            ],
            [
                'name' => 'EVENTCALENDARS_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model EventCalendars',
                'ruleName' => null,
                'parent' => ['EVENTS_ADMINISTRATOR','arter\amos\events\rules\EventsUpdateRule']
            ],
            [
                'name' => 'EVENTCALENDARS_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model EventCalendars',
                'ruleName' => null,
                'parent' => ['EVENTS_ADMINISTRATOR','arter\amos\events\rules\EventsUpdateRule']
            ],
            [
                'name' => 'EVENTCALENDARS_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model EventCalendars',
                'ruleName' => null,
                'parent' => ['EVENTS_ADMINISTRATOR','arter\amos\events\rules\EventsUpdateRule']
            ],

//------------------------------------------------
            [
                'name' => 'EVENTCALENDARSSLOTS_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model EventCalendarsSlots',
                'ruleName' => null,
                'parent' => ['EVENTS_ADMINISTRATOR']
            ],
            [
                'name' => 'EVENTCALENDARSSLOTS_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model EventCalendarsSlots',
                'ruleName' => null,
                'parent' => ['EVENTS_ADMINISTRATOR','arter\amos\events\rules\EventsUpdateRule']
            ],
            [
                'name' => 'EVENTCALENDARSSLOTS_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model EventCalendarsSlots',
                'ruleName' => null,
                'parent' => ['EVENTS_ADMINISTRATOR','arter\amos\events\rules\EventsUpdateRule']
            ],
            [
                'name' => 'EVENTCALENDARSSLOTS_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model EventCalendarsSlots',
                'ruleName' => null,
                'parent' => ['EVENTS_ADMINISTRATOR','arter\amos\events\rules\EventsUpdateRule']
            ],

        ];
    }
}
