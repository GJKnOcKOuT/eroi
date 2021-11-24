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
 * Class m210421_081114_disable_widget_icon_een
 */
class m210421_081114_disable_widget_icon_een extends AmosMigrationWidgets
{
    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\een\widgets\icons\WidgetIconEenDashboard::className(),
                'update' => true,
                'status' => AmosWidgets::STATUS_DISABLED,
            ],
            [
                'classname' => \arter\amos\een\widgets\graphics\WidgetGraphicsLatestPartnershipProposalEen::className(),
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
                'classname' => \arter\amos\een\widgets\icons\WidgetIconEenDashboard::className(),
                'update' => true,
                'status' => AmosWidgets::STATUS_ENABLED,
            ],
            [
                'classname' => \arter\amos\een\widgets\graphics\WidgetGraphicsLatestPartnershipProposalEen::className(),
                'update' => true,
                'status' => AmosWidgets::STATUS_ENABLED,
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
