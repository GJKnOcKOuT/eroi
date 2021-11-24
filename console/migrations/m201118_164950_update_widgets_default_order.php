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
 * Class m201118_164950_update_widgets_default_order
 */
class m201118_164950_update_widgets_default_order extends AmosMigrationWidgets
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
                'classname' => arter\amos\admin\widgets\icons\WidgetIconMyProfile::className(),
                'update' => true,
                'default_order' => 200
            ],
            [
                // Utenti
                'classname' => arter\amos\admin\widgets\icons\WidgetIconAdmin::className(),
                'update' => true,
                'default_order' => 210
            ],
            [
                // ORGANIZZAZIONI 
                'classname' => arter\amos\organizzazioni\widgets\icons\WidgetIconProfilo::className(),
                'update' => true,
                'default_order' => 220
            ],
            [
                // Community
                'classname' => arter\amos\community\widgets\icons\WidgetIconCommunityDashboard::className(),
                'update' => true,
                'default_order' => 230
            ],
            [
                // SFIDE
                'classname' => arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboardGeneral::className(),
                'update' => true,
                'default_order' => 240
            ],
            [
                // STORIE
                'classname' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeDashboard::className(),
                'update' => true,
                'default_order' => 250
            ],
            [
                // NEWS
                'classname' => arter\amos\news\widgets\icons\WidgetIconNewsDashboard::className(),
                'update' => true,
                'default_order' => 260
            ],
            [
                // SONDAGGI
                'classname' => arter\amos\sondaggi\widgets\icons\WidgetIconSondaggiGeneral::className(),
                'update' => true,
                'default_order' => 270
            ],
            [
                // FAQ
                'classname' => arter\amos\ticket\widgets\icons\WidgetIconTicketDashboard::className(),
                'update' => true,
                'default_order' => 280
            ],
            [
                // GESTIONE
                'classname' => arter\amos\dashboard\widgets\icons\WidgetIconManagement::className(),
                'update' => true,
                'default_order' => 290
            ],
        ];
    }

}