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

use backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideAssignedWidgetIcon;
use backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfidePublishedWidgetIcon;
use backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideToAssignWidgetIcon;
use backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideToValidateWidgetIcon;
use backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideWidgetIcon;
use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\utility\DashboardUtility;

/**
 * Class m200408_112412_update_cl_widgets_graphic_default_order
 */
class m200408_112412_update_cl_widgets_graphic_default_order extends AmosMigrationWidgets
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
                'classname' => AnimazioneSfideWidgetIcon::className(),
                'update' => true,
                'default_order' => 200
            ],
            [
                'classname' => AnimazioneSfideToAssignWidgetIcon::className(),
                'update' => true,
                'default_order' => 210
            ],
            [
                'classname' => AnimazioneSfideAssignedWidgetIcon::className(),
                'update' => true,
                'default_order' => 220
            ],
            [
                'classname' => AnimazioneSfideToValidateWidgetIcon::className(),
                'update' => true,
                'default_order' => 230
            ],
            [
                'classname' => AnimazioneSfidePublishedWidgetIcon::className(),
                'update' => true,
                'default_order' => 240
            ],
           
        ];
    }
}
