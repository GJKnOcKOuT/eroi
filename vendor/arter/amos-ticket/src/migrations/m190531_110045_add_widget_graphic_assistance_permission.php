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
 * @package    arter\amos\ticket\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use arter\amos\ticket\widgets\graphics\WidgetGraphicAssistance;
use yii\rbac\Permission;

/**
 * Class m190531_110045_add_widget_graphic_assistance_permission
 */
class m190531_110045_add_widget_graphic_assistance_permission extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        $prefixStr = 'Permissions for the dashboard for the widget ';
        return [
            [
                'name' => WidgetGraphicAssistance::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetGraphicAssistance',
                'parent' => ['OPERATORE_TICKET', 'REFERENTE_TICKET', 'AMMINISTRATORE_TICKET']
            ]
        ];
    }
}
