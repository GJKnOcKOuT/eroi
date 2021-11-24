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


use yii\db\Migration;

class m160815_081613_sw_workflow extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%sw_workflow}}', [
            'id' => $this->string(32)->notNull(),
            'initial_status_id' => $this->string(32)->null()->defaultValue(null),
            'PRIMARY KEY (id)',
        ], 'ENGINE=InnoDB');
        $this->createIndex('initial_status_id', '{{%sw_workflow}}', 'initial_status_id');
    }

    public function safeDown()
    {
        $this->dropIndex('initial_status_id', '{{%sw_workflow}}');
        $this->dropTable('{{%sw_workflow}}');
    }
    
}
