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
 * @package    arter\amos\news\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m180727_124144_add_news_read_rule
 */
class m181019_164144_add_events_read_rule extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'EventsRead',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to read a News ',
                'ruleName' => \arter\amos\core\rules\ReadContentRule::className(),
                'parent' => ['EVENTS_ADMINISTRATOR', 'EVENTS_CREATOR', 'EVENTS_VALIDATOR', 'EVENTS_READER', 'PLATFORM_EVENTS_VALIDATOR', 'EVENTS_MANAGER']
            ],
            [
                'name' => 'EVENT_READ',
                'type' => Permission::TYPE_PERMISSION,
                'update' => true,
                'newValues' => [
                    'removeParents' => ['EVENTS_ADMINISTRATOR', 'EVENTS_CREATOR', 'EVENTS_VALIDATOR', 'EVENTS_READER', 'PLATFORM_EVENTS_VALIDATOR', 'EVENTS_MANAGER'],
                    'addParents' => ['EventsRead']
                ]
            ],
        ];
    }
}
