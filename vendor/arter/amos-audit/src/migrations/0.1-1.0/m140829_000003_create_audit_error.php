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

class m140829_000003_create_audit_error extends \yii\db\Migration
{
    const TABLE = '{{%audit_error}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE, [
            'id'         => Schema::TYPE_PK,
            'audit_id'   => Schema::TYPE_INTEGER . ' NOT NULL',
            'created'    => Schema::TYPE_DATETIME . ' NOT NULL',
            'message'    => Schema::TYPE_STRING . '(512) NOT NULL',
            'code'       => Schema::TYPE_INTEGER . " DEFAULT '0'",
            'file'       => Schema::TYPE_STRING . '(512)',
            'line'       => Schema::TYPE_INTEGER ,
            'trace'      => 'BLOB',
        ], $tableOptions);

        $this->addForeignKey('fk_audit_error_audit_id', self::TABLE, ['audit_id'], '{{%audit_entry}}', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable(self::TABLE);
    }
}
