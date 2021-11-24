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

use backend\widgets\graphics\WidgetGraphicToolbox;
use arter\amos\community\widgets\graphics\WidgetGraphicsMyCommunities;
use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\utility\DashboardUtility;
use arter\amos\news\widgets\graphics\WidgetGraphicsUltimeNews;
use arter\amos\partnershipprofiles\widgets\graphics\WidgetGraphicsLatestPartnershipProfiles;

/**
 * Class m190429_123912_update_aster_widgets_graphic_default_order
 */
class m190429_123912_update_aster_widgets_graphic_default_order extends AmosMigrationWidgets
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
                'classname' => WidgetGraphicsLatestPartnershipProfiles::className(),
                'update' => true,
                'default_order' => 200
            ],
            [
                'classname' => WidgetGraphicsMyCommunities::className(),
                'update' => true,
                'default_order' => 210
            ],
            [
                'classname' => WidgetGraphicsUltimeNews::className(),
                'update' => true,
                'default_order' => 230
            ],
            [
                'classname' => WidgetGraphicToolbox::className(),
                'update' => true,
                'default_order' => 240
            ],
        ];
    }
}
