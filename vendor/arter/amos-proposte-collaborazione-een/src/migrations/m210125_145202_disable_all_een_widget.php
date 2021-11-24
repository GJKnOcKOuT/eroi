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
 * Class m210125_181602_disable_all_een_widget
 */
class m210125_145202_disable_all_een_widget extends AmosMigrationWidgets
{
    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\een\widgets\icons\WidgetIconEenDashboardAll::className(),              
                'update' => true,
                'dashboard_visible' => 0,
                'sub_dashboard' => 0,
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        return true;
    }
}
