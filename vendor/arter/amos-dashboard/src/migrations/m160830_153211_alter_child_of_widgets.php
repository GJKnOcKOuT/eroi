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
 * @package    arter\amos\dashboard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

class m160830_153211_alter_child_of_widgets extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%amos_widgets}}', 'child_of', \yii\db\Schema::TYPE_STRING . ' NULL DEFAULT NULL AFTER status');
        return true;
    }

    public function safeDown()
    {
        echo "m160830_153211_alter_child_of_widgets cannot be reverted.\n";
        $this->dropColumn('{{%amos_widgets}}', 'child_of');
        return true;
    }
}
