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

/**
 * 
 */
class m190710_101000_alter_translation extends Migration
{
    protected
        $tableName    = '{{%language_source}}',
        $tableOptions = null;

    /**
     * Create tableName
     *
     */
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            $this->tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        if ($this->db->schema->getTableSchema($this->tableName, true) !== null) {
            $this->addColumn($this->tableName, 'urls', $this->text()->null());
        }
    }

    /**
     * Remove tableName 
     * 
     */
    public function down()
    {
        $this->dropColumn($this->tableName, 'urls');
    }
}