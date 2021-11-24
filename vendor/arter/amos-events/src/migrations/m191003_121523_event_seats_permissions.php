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
* Class m191003_121523_event_seats_permissions*/
class m191003_121523_event_seats_permissions extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
                [
                    'name' =>  'EVENTSEATS_CREATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di CREATE sul model EventSeats',
                    'ruleName' => null,
                    'parent' => ['EVENTS_ADMINISTRATOR']
                ],
                [
                    'name' =>  'EVENTSEATS_READ',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di READ sul model EventSeats',
                    'ruleName' => null,
                    'parent' => ['EVENTS_ADMINISTRATOR']
                    ],
                [
                    'name' =>  'EVENTSEATS_UPDATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di UPDATE sul model EventSeats',
                    'ruleName' => null,
                    'parent' => ['EVENTS_ADMINISTRATOR']
                ],
                [
                    'name' =>  'EVENTSEATS_DELETE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di DELETE sul model EventSeats',
                    'ruleName' => null,
                    'parent' => ['EVENTS_ADMINISTRATOR']
                ],

            ];
    }
}
