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
use arter\amos\dashboard\models\AmosWidgets;

/**
 * Class m190319_092758_disable_videconference_dashboard_widget
 */
class m190319_092758_disable_videconference_dashboard_widget extends AmosMigrationWidgets
{
    const MODULE_NAME = 'videoconference';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\videoconference\widgets\icons\WidgetIconVideoconference::className(),
                'update' => true,
                'status' => AmosWidgets::STATUS_DISABLED,
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
                'classname' => \arter\amos\videoconference\widgets\icons\WidgetIconVideoconference::className(),
                'update' => true,
                'status' => AmosWidgets::STATUS_ENABLED,
            ]
        ];
        foreach ($this->widgets as $widgetData) {
            $ok = $this->insertOrUpdateWidget($widgetData);
            if (!$ok) {
                $allOk = false;
            }
        }
        return $allOk;
    }
}
