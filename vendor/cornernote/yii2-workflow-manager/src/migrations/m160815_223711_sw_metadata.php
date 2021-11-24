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


use yii\db\Schema;
use yii\db\Migration;

class m160815_223711_sw_metadata extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%sw_metadata}}', [
            'workflow_id' => $this->string(32)->notNull(),
            'status_id' => $this->string(32)->notNull(),
            'key' => $this->string(64)->notNull(),
            'value' => $this->string(255)->null()->defaultValue(null),
        ], 'ENGINE=InnoDB');
        $this->createIndex('workflow_status_id', '{{%sw_metadata}}', ['workflow_id', 'status_id', 'key'], true);
    }

    public function safeDown()
    {
        $this->dropIndex('workflow_status_id', '{{%sw_metadata}}');
        $this->dropTable('{{%sw_metadata}}');
    }

}
