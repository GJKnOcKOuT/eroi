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
 * @package    arter\amos\report\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

/**
 * Class m170607_153251_add_default_report_types
 */
class m170607_153251_add_default_report_types extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $reportType = new \arter\amos\report\models\ReportType();
        $reportType->name = "Inappropriate contents";
        $reportType->description = "Inappropriate contents";
        $ok = $reportType->detachBehaviors();
        $ok = $reportType->save(false);

        if(!$ok){
            echo "Error occurred while saving report type '$reportType->name'";
            return false;
        }

        $reportType = new \arter\amos\report\models\ReportType();
        $reportType->name = "Errors";
        $reportType->description = "Errors";
        $ok = $reportType->detachBehaviors();
        $ok = $reportType->save(false);

        if(!$ok){
            echo "Error occurred while saving report type '$reportType->name'";
            return false;
        }

        return true;

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m170607_153251_add_default_report_types cannot be reverted.\n";

        return true;
    }
}
