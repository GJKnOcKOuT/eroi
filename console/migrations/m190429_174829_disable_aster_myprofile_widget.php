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
 * Class m190429_174829_disable_aster_myprofile_widget
 */
class m190429_174829_disable_aster_myprofile_widget extends AmosMigrationWidgets
{
    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\admin\widgets\graphics\WidgetGraphicMyProfile::className(),
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
        $this->widgets = [
            [
                'classname' => \arter\amos\admin\widgets\graphics\WidgetGraphicMyProfile::className(),
                'update' => true,
                'dashboard_visible' => 1,
                'sub_dashboard' => 1,
            ]
        ];

        $allOk = true;
        foreach ($this->widgets as $widgetData) {
            $ok = $this->insertOrUpdateWidget($widgetData);
            if (!$ok) {
                $allOk = false;
            }
        }

        return $allOk;
    }
}
