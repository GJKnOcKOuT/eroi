<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;


/**
* Class m180330_120718_add_amos_widgets_een_expr_of_interest*/
class m180412_105618_add_amos_widgets_een_expr_of_interest extends AmosMigrationWidgets
{
    const MODULE_NAME = 'een';

    /**
    * @inheritdoc
    */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' =>\arter\amos\een\widgets\icons\WidgetIconEenExprOfInterestDashboard::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'dashboard_visible' => 1,

            ],
            [
                'classname' =>\arter\amos\een\widgets\icons\WidgetIconEenExprOfInterestReceived::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'dashboard_visible' => 0,
                'child_of' => \arter\amos\een\widgets\icons\WidgetIconEenExprOfInterestDashboard::className(),
                'default_order' => 20

            ],
            [
                'classname' =>\arter\amos\een\widgets\icons\WidgetIconEenExprOfInterest::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'dashboard_visible' => 0,
                'child_of' => \arter\amos\een\widgets\icons\WidgetIconEenExprOfInterestDashboard::className(),
                'default_order' => 10
            ]
        ];
    }
}
