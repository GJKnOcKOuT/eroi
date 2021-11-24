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
use arter\amos\dashboard\utility\DashboardUtility;

/**
 * Class m190319_091623_aster_default_plugin_order
 */
class m190319_091623_aster_default_plugin_order extends AmosMigrationWidgets
{
    /**
     * @inheritdoc
     */
    public function afterAddWidgets()
    {
        return DashboardUtility::resetAllDashboards();
    }

    /**
     * @inheritdoc
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
                'classname' => arter\amos\admin\widgets\icons\WidgetIconAdmin::className(),
                'update' => true,
                'default_order' => 200
            ],
            [
                'classname' => arter\amos\organizzazioni\widgets\icons\WidgetIconProfilo::className(),
                'update' => true,
                'default_order' => 210
            ],
            [
                'classname' => arter\amos\community\widgets\icons\WidgetIconCommunityDashboard::className(),
                'update' => true,
                'default_order' => 220
            ],
            [
                'classname' => arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboardGeneral::className(),
                'update' => true,
                'default_order' => 230
            ],
            [
                'classname' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeDashboard::className(),
                'update' => true,
                'default_order' => 240
            ],
            [
                'classname' => arter\amos\news\widgets\icons\WidgetIconNewsDashboard::className(),
                'update' => true,
                'default_order' => 250
            ],
            [
                'classname' => arter\amos\events\widgets\icons\WidgetIconEvents::className(),
                'update' => true,
                'default_order' => 260
            ],
            [
                'classname' => arter\amos\dashboard\widgets\icons\WidgetIconManagement::className(),
                'update' => true,
                'default_order' => 270
            ]
        ];
    }
}
