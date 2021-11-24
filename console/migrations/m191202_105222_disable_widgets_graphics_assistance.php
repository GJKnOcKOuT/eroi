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
 * Class m191202_105222_disable_widgets_graphics_assistance
 */
class m191202_105222_disable_widgets_graphics_assistance extends AmosMigrationWidgets {

    const MODULE_NAME = 'ticket';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs() {
        $this->widgets = [
            [
                'classname' => \arter\amos\ticket\widgets\graphics\WidgetGraphicAssistance::className(),
                'update' => true,
                'status' => AmosWidgets::STATUS_DISABLED,
                'module' => self::MODULE_NAME,
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        $this->widgets = [
            [
                'classname' => \arter\amos\ticket\widgets\graphics\WidgetGraphicAssistance::className(),
                'update' => true,
                'status' => AmosWidgets::STATUS_ENABLED,
                'module' => self::MODULE_NAME,
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
