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
 * Class m190605_185722_permissions_events_update_rule
 */
class m190605_185722_permissions_events_update_rule extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => \arter\amos\events\rules\EventsUpdateRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di effettuare modifiche negli eventi in cui il partecipante è events_manager',
                'ruleName' => \arter\amos\events\rules\EventsUpdateRule::className(),
                'children' => [
                    'EVENT_READ',
                    'EVENT_UPDATE',
                    'COMMUNITY_READ',
                    'COMMUNITY_UPDATE',
                    'EventWorkflow/DRAFT',
                    'EventWorkflow/PUBLISHREQUEST',
                ],
                'parent' => ['EVENTS_READER'],
            ],
        ];
    }
}
