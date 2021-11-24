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

class m160815_081611_sw_status extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%sw_status}}', [
            'id' => $this->string(32)->notNull(),
            'workflow_id' => $this->string(32)->notNull(),
            'label' => $this->string(64)->null()->defaultValue(null),
            'sort_order' => $this->integer(11)->null()->defaultValue(null),
            'PRIMARY KEY (id, workflow_id)',
        ], 'ENGINE=InnoDB');
        $this->createIndex('workflow_id', '{{%sw_status}}', 'workflow_id');
    }

    public function safeDown()
    {
        $this->dropIndex('workflow_id', '{{%sw_status}}');
        $this->dropTable('{{%sw_status}}');
    }
    
}
