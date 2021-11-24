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

class m150626_000004_create_audit_trail extends Migration
{
    const TABLE = '{{%audit_trail}}';

    public function up()
    {
        $this->createTable(self::TABLE, [
            'id'        => Schema::TYPE_PK,
            'entry_id'  => Schema::TYPE_INTEGER,
            'user_id'   => Schema::TYPE_INTEGER . ' NULL',
            'action'    => Schema::TYPE_STRING . ' NOT NULL',
            'model'     => Schema::TYPE_STRING . ' NOT NULL',
            'model_id'  => Schema::TYPE_STRING . ' NOT NULL',
            'field'     => Schema::TYPE_STRING,
            'old_value' => Schema::TYPE_TEXT,
            'new_value' => Schema::TYPE_TEXT,
            'created'   => Schema::TYPE_DATETIME . ' NOT NULL',
        ], ($this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB' : null));

        if ($this->db->driverName != 'sqlite') {
            $this->addForeignKey('fk_audit_trail_entry_id', self::TABLE, ['entry_id'], '{{%audit_entry}}', 'id');
        }
        $this->createIndex('idx_audit_user_id', self::TABLE, 'user_id');
        $this->createIndex('idx_audit_trail_field', self::TABLE, ['model', 'model_id', 'field']);
        $this->createIndex('idx_audit_trail_action', self::TABLE, 'action');
    }

    public function down()
    {
        if ($this->db->driverName != 'sqlite') {
            $this->dropForeignKey('fk_audit_trail_entry_id', self::TABLE);
        }
        $this->dropTable(self::TABLE);
    }
}
