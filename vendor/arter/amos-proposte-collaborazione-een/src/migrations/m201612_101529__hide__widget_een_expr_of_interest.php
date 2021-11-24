<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    care_for_workers\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;

/**
 * Class m201612_101529__hide__widget_een_expr_of_interest
 */
class m201612_101529__hide__widget_een_expr_of_interest extends AmosMigrationWidgets
{
    const MODULE_NAME = 'een';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs() {
        $this->widgets = [
            [
                'classname' => arter\amos\een\widgets\icons\WidgetIconEenExprOfInterestDashboard::className(),
                'update' => true,
                'status' => AmosWidgets::STATUS_DISABLED,
                'dashboard_visible' => 0
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {

        return true;
    }
}
