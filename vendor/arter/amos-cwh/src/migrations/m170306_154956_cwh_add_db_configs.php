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

class m170306_154956_cwh_add_db_configs extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cwh_config_contents}}', [
            'id' => $this->primaryKey(),
            'classname' => $this->string(255)->notNull()->comment("Classname"),
            'label' => $this->string(255)->notNull()->comment("Label"),
            'status_attribute' => $this->string(255)->notNull()->comment("Campo dello stato del workflow (es: status)"),
            'status_value' => $this->string(255)->notNull()->comment("Quale stato del workflow rende modificabile ambito di pubblicazione?"),
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
        $this->dropTable('{{%cwh_config_contents}}');
        return true;
    }

}
