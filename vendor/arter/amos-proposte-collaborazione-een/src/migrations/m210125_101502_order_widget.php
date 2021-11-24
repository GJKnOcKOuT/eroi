<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;

/**
 * Class m210125_101502_order_widget
 */
class m210125_101502_order_widget extends AmosMigrationWidgets
{
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {

        $this->widgets = [
            [
                'classname' => \arter\amos\een\widgets\icons\WidgetIconEenDashboard::className(),
                'update' => true,
                'dashboard_visible' => 1,
                'child_of' => null,
                'default_order' => 244,
            ], [
                'classname' => \arter\amos\een\widgets\icons\WidgetIconEenTagDashboard::className(),
                'update' => true,
                'dashboard_visible' => 1,
                'child_of' => null,
                'default_order' => 246,
            ],
            [
                'classname' => \arter\amos\een\widgets\icons\WidgetIconEenDashboardGeneral::className(),
                'update' => true,
                'dashboard_visible' => 0,
                'default_order' => 242,
            ]
        ];
    }
}
