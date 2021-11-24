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

use yii\db\Migration;

/**
 * Class m191125_103355_update_widgets_subdashboard
 */
class m191125_103355_update_widgets_subdashboard extends Migration {

    /**
     * @inheritdoc
     */
    public function safeUp() {

        $this->insert('amos_widgets', [
            'classname' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboard',
            'type' => 'ICON',
            'module' => 'community',
            'status' => 1,
            'dashboard_visible' => 0,
            'sub_dashboard' => 1,
        ]);

        $this->insert('amos_widgets', [
            'classname' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestDashboard',
            'type' => 'ICON',
            'module' => 'community',
            'status' => 1,
            'dashboard_visible' => 0,
            'sub_dashboard' => 1,
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown() {

        $this->delete('amos_widgets', [
            'classname' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboard',
            'type' => 'ICON',
            'module' => 'community',
            'status' => 1,
            'dashboard_visible' => 0,
            'sub_dashboard' => 1,
        ]);

        $this->delete('amos_widgets', [
            'classname' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestDashboard',
            'type' => 'ICON',
            'module' => 'community',
            'status' => 1,
            'dashboard_visible' => 0,
            'sub_dashboard' => 1,
        ]);

    }

}
