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
 * @package    arter\amos\news
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

class m171025_113025_drop_old_een_widgets extends Migration
{


    public function safeUp()
    {

        \arter\amos\dashboard\models\AmosUserDashboardsWidgetMm::deleteAll([
            'like',
            'amos_widgets_classname',
            'proposte_collaborazione_een',
        ]);

        \arter\amos\dashboard\models\AmosWidgets::deleteAll([
            'like',
            'classname',
            'proposte_collaborazione_een',
        ]);

        return true;
    }

    public function safeDown()
    {
        return true;
    }


}
