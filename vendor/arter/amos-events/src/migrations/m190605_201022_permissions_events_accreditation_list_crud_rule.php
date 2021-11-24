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
 * @package    arter\amos\community\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m190605_201022_permissions_events_accreditation_list_crud_rule
 */
class m190605_201022_permissions_events_accreditation_list_crud_rule extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'EVENTACCREDITATIONLIST_MANAGER',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Manager for events event accreditation lists',
                'ruleName' => null,
                'parent' => ['EVENTS_READER']
            ],
            [
                'name' => \arter\amos\events\rules\EventsAccreditationListCRUDRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di effettuare operazioni crud nelle liste accreditamento di eventi in cui il partecipante è events_manager',
                'ruleName' => \arter\amos\events\rules\EventsAccreditationListCRUDRule::className(),
                'children' => [
                    'EVENTACCREDITATIONLIST_CREATE',
                    'EVENTACCREDITATIONLIST_READ',
                    'EVENTACCREDITATIONLIST_UPDATE',
                    'EVENTACCREDITATIONLIST_DELETE',
                ],
                'parent' => ['EVENTACCREDITATIONLIST_MANAGER'],
            ],
        ];
    }
}
