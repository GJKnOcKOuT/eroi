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
 * @package    arter\amos\sondaggi\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;

/**
 * Class m180911_080545_new_compila_sondaggi_widgets
 */
class m180911_080545_new_compila_sondaggi_widgets extends AmosMigrationWidgets
{
    const MODULE_NAME = 'sondaggi';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggiOwnInterest::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggi::className(),
                'default_order' => 10,
                'dashboard_visible' => 0
            ],
            [
                'classname' => \arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggiAll::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggi::className(),
                'default_order' => 20,
                'dashboard_visible' => 0
            ]
        ];
    }
}
