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
 * @package    arter\amos\een\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\dashboard\models\AmosWidgets;

/**
 * Class m171025_114423_create_een_widgets
 */
class m171025_114423_create_een_widgets extends \arter\amos\core\migration\AmosMigrationWidgets
{
    const MODULE_NAME = 'een';
    
    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\een\widgets\icons\WidgetIconEenDashboard::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => null,
                'dashboard_visible' => 1,
                'default_order' => 100
            ],
            [
                'classname' => \arter\amos\een\widgets\icons\WidgetIconEen::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\een\widgets\icons\WidgetIconEenDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 10
            ],
            [
                'classname' => \arter\amos\een\widgets\icons\WidgetIconEenAll::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\een\widgets\icons\WidgetIconEenDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 20
            ]
        ];
    }
}
