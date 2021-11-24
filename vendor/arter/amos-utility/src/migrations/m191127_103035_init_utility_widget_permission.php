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
 * @package    arter\amos\utility\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use arter\amos\utility\widgets\icons\WidgetIconUtility;
use yii\rbac\Permission;

/**
 * Class m191127_103035_init_utility_widget_permission
 */
class m191127_103035_init_utility_widget_permission extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => WidgetIconUtility::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permissions for the dashboard for the widget WidgetIconUtility',
                'parent' => ['ADMIN']
            ]
        ];
    }
}
