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
 * @package    arter\amos\myactivities\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m170712_141330_init_my_activities_permissions
 */
class m170726_084532_add_permission_to_basic_user extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        $prefixStr = 'Permissions for the dashboard for the widget ';
        return [
            [
                'name' => \arter\amos\myactivities\widgets\icons\WidgetIconMyActivities::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconMyActivities',
                'parent' => ['BASIC_USER']
            ],
            [
                'name' => 'MYACTIVITIES_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Read permission for model MyActivities',
                'ruleName' => null,
                'parent' => ['BASIC_USER'],
                'dontRemove' => true
            ],
        ];
    }
}

