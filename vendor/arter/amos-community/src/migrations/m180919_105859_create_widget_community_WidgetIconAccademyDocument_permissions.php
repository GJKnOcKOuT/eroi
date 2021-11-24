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
 * Class m180919_105859_create_widget_community_WidgetIconAccademyDocument_permissions
 */
class m180919_105859_create_widget_community_WidgetIconAccademyDocument_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => \arter\amos\community\widgets\icons\WidgetIconAccademyDocument::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permession to view the widget for download accademy document.',
                'parent' => ['AMMINISTRATORE_COMMUNITY', 'BASIC_USER']
            ]
        ];
    }
}
