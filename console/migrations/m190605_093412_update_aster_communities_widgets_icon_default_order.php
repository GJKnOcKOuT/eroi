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

use arter\amos\community\widgets\icons\WidgetIconMyCommunities;
use arter\amos\community\widgets\icons\WidgetIconCreatedByCommunities;
use arter\amos\community\widgets\icons\WidgetIconCommunity;
use arter\amos\community\widgets\icons\WidgetIconToValidateCommunities;
use arter\amos\community\widgets\icons\WidgetIconAdminAllCommunity;
use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\utility\DashboardUtility;

/**
 * Class m190605_093412_update_aster_communities_widgets_icon_default_order
 */
class m190605_093412_update_aster_communities_widgets_icon_default_order extends AmosMigrationWidgets
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
                'classname' => WidgetIconMyCommunities::className(),
                'update' => true,
                'default_order' => 10
            ],
            [
                'classname' => WidgetIconCreatedByCommunities::className(),
                'update' => true,
                'default_order' => 20
            ],
            [
                'classname' => WidgetIconCommunity::className(),
                'update' => true,
                'default_order' => 30
            ],
            [
                'classname' => WidgetIconToValidateCommunities::className(),
                'update' => true,
                'default_order' => 40
            ],
            [
                'classname' => WidgetIconAdminAllCommunity::className(),
                'update' => true,
                'default_order' => 80
            ],
        ];
    }
}
