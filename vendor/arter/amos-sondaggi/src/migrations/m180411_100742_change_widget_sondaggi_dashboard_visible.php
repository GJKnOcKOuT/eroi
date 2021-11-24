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

/**
 * Class m180411_100742_change_widget_sondaggi_dashboard_visible
 */
class m180411_100742_change_widget_sondaggi_dashboard_visible extends AmosMigrationWidgets
{
    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggi::className(),
                'update' => true,
                'default_order' => 110,
                'dashboard_visible' => 1
            ],
            [
                'classname' => \arter\amos\sondaggi\widgets\icons\WidgetIconPubblicaSondaggi::className(),
                'update' => true,
                'default_order' => 120,
                'dashboard_visible' => 1
            ],
            [
                'classname' => \arter\amos\sondaggi\widgets\icons\WidgetIconSondaggi::className(),
                'update' => true,
                'default_order' => 130,
                'dashboard_visible' => 1
            ]
        ];
    }
}
