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
 * Class m201118_164954_update_graphic_widgets_default_order
 */
class m201118_164954_update_graphic_widgets_default_order extends AmosMigrationWidgets
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
                // Sfide in cui se coinvolto
                'classname' => backend\modules\aster_partnership_profiles\widget\graphics\WidgetGraphicsLatestPartnershipProfilesAnimator::className(),
                'update' => true,
                'default_order' => 300
            ],
            [
                // Ultime sfide
                'classname' => arter\amos\partnershipprofiles\widgets\graphics\WidgetGraphicsLatestPartnershipProfiles::className(),
                'update' => true,
                'default_order' => 310
            ],
            [
                // GRuppi
                'classname' => arter\amos\community\widgets\graphics\WidgetGraphicsMyCommunities::className(),
                'update' => true,
                'default_order' => 320
            ],
            [
                // News
                'classname' => arter\amos\news\widgets\graphics\WidgetGraphicsUltimeNews::className(),
                'update' => true,
                'default_order' => 330
            ],
            [
                // News
                'classname' => arter\amos\sondaggi\widgets\graphics\WidgetGraphicsUltimiSondaggi::className(),
                'update' => true,
                'default_order' => 340
            ],
            [
                // News
                'classname' => backend\widgets\graphics\WidgetGraphicToolbox::className(),
                'update' => true,
                'default_order' => 350
            ],
            
        ];
    }

}