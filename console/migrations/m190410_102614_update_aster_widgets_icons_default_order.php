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

use arter\amos\admin\widgets\icons\WidgetIconAdmin;
use arter\amos\best\practice\widgets\icons\WidgetIconSuperCraftDashboard;
use arter\amos\community\widgets\icons\WidgetIconCommunityDashboard;
use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\utility\DashboardUtility;
use arter\amos\dashboard\widgets\icons\WidgetIconManagement;
use arter\amos\events\widgets\icons\WidgetIconEvents;
use arter\amos\news\widgets\icons\WidgetIconNewsDashboard;
use arter\amos\organizzazioni\widgets\icons\WidgetIconProfilo;
use arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboardGeneral;

/**
 * Class m190410_102614_update_aster_widgets_icons_default_order
 */
class m190410_102614_update_aster_widgets_icons_default_order extends AmosMigrationWidgets
{
    /**
     * Override this to make operations after adding the widgets.
     * @return bool
     */
    public function afterAddWidgets()
    {
        return DashboardUtility::resetAllDashboards();
    }

    /**
     * Override this to make operations after removing the widgets.
     * @return bool
     */
    public function afterRemoveWidgets()
    {
        return DashboardUtility::resetAllDashboards();
    }

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => WidgetIconAdmin::className(),
                'update' => true,
                'default_order' => 300
            ],
            [
                'classname' => WidgetIconProfilo::className(),
                'update' => true,
                'default_order' => 310
            ],
            [
                'classname' => WidgetIconCommunityDashboard::className(),
                'update' => true,
                'default_order' => 320
            ],
            [
                'classname' => WidgetIconPartnershipProfilesDashboardGeneral::className(),
                'update' => true,
                'default_order' => 330
            ],
            [
                'classname' => \arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeDashboard::className(),
                'update' => true,
                'default_order' => 340
            ],
            [
                'classname' => WidgetIconNewsDashboard::className(),
                'update' => true,
                'default_order' => 350
            ],
            [
                'classname' => WidgetIconEvents::className(),
                'update' => true,
                'default_order' => 360
            ],
            [
                'classname' => WidgetIconManagement::className(),
                'update' => true,
                'default_order' => 370
            ],
            [
                'classname' => WidgetIconSuperCraftDashboard::className(),
                'update' => true,
                'default_order' => 380
            ],
        ];
    }
}
