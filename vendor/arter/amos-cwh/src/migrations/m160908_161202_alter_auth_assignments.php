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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

class m160908_161202_alter_auth_assignments extends Migration
{

    const TABLE = '{{%cwh_auth_assignment}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->dropTable(self::TABLE);

        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'item_name' => $this->string(255)->notNull(),
            'user_id' => $this->string(255)->notNull(),
            'cwh_nodi_id' => $this->string(255)->notNull(),
            'created_at' => $this->dateTime()->null()->comment("Creato il"),
            'updated_at' => $this->dateTime()->null()->comment("Aggiornato il"),
            'deleted_at' => $this->dateTime()->null()->comment("Cancellato il"),
            'created_by' => $this->dateTime()->null()->comment("Creato da"),
            'updated_by' => $this->dateTime()->null()->comment("Aggiornato da"),
            'deleted_by' => $this->dateTime()->null()->comment("Cancellato da"),
        ], $tableOptions);

        return true;
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE);
        return true;
    }


}
