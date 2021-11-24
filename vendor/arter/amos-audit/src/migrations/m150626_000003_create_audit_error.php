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


use arter\amos\audit\components\Migration;
use yii\db\Schema;

class m150626_000003_create_audit_error extends Migration
{
    const TABLE = '{{%audit_error}}';

    public function up()
    {
        $driver = $this->db->driverName;
        $this->createTable(self::TABLE, [
            'id'         => Schema::TYPE_PK,
            'entry_id'   => Schema::TYPE_INTEGER . ' NOT NULL',
            'created'    => Schema::TYPE_DATETIME . ' NOT NULL',
            'message'    => Schema::TYPE_TEXT . ' NOT NULL',
            'code'       => Schema::TYPE_INTEGER . " DEFAULT '0'",
            'file'       => Schema::TYPE_STRING . '(512)',
            'line'       => Schema::TYPE_INTEGER ,
            'trace'      => Schema::TYPE_BINARY,
            'hash'       => Schema::TYPE_STRING . '(32)',
            'emailed'    => Schema::TYPE_BOOLEAN . " NOT NULL DEFAULT '0'",
        ], ($driver === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB' : null));

        if ($driver != 'sqlite') {
            $this->addForeignKey('fk_audit_error_entry_id', self::TABLE, ['entry_id'], '{{%audit_entry}}', 'id');
        }

        // Issue #122: Specified key was too long; max key length is 767 bytes - http://stackoverflow.com/q/1814532/50158
        $this->createIndex('idx_file', self::TABLE, ['file' . ($driver === 'mysql' ? '(180)' : '')]);
        $this->createIndex('idx_emailed', self::TABLE, ['emailed']);
    }

    public function down()
    {
        if ($this->db->driverName != 'sqlite') {
            $this->dropForeignKey('fk_audit_error_entry_id', self::TABLE);
        }
        $this->dropTable(self::TABLE);
    }
}
