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
 * Class m210519_180050_update_widget_news_default_order
 */
class m210519_180050_update_widget_news_default_order extends AmosMigrationWidgets
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
                // NEWS
                'classname' => arter\amos\news\widgets\graphics\WidgetGraphicsUltimeNews::className(),
                'update' => true,
                'default_order' => 317
            ],

        ];
    }

}