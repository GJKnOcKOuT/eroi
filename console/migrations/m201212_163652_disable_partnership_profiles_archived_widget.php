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
 * Class m201212_163652_disable_partnership_profiles_archived_widget
 */
class m201212_163652_disable_partnership_profiles_archived_widget extends AmosMigrationWidgets
{
    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesArchived::className(),
                'module' => 'partnershipprofiles',
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
                'classname' => \arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesArchived::className(),
                'module' => 'partnershipprofiles',
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
