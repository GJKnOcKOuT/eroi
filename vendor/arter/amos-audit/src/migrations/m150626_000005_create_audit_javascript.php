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

class m150626_000005_create_audit_javascript extends Migration
{
    const TABLE = '{{%audit_javascript}}';

    public function up()
    {
        $this->createTable(self::TABLE, [
            'id'         => Schema::TYPE_PK,
            'entry_id'   => Schema::TYPE_INTEGER . ' NOT NULL',
            'created'    => Schema::TYPE_DATETIME . ' NOT NULL',
            'type'       => Schema::TYPE_STRING . '(20) NOT NULL',
            'message'    => Schema::TYPE_TEXT . ' NOT NULL',
            'origin'     => Schema::TYPE_STRING . '(512)',
            'data'       => Schema::TYPE_BINARY,
        ], $this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB' : null);

        if ($this->db->driverName != 'sqlite') {
            $this->addForeignKey('fk_audit_javascript_entry_id', self::TABLE, ['entry_id'], '{{%audit_entry}}', 'id');
        }
    }

    public function down()
    {
        if ($this->db->driverName != 'sqlite') {
            $this->dropForeignKey('fk_audit_javascript_entry_id', self::TABLE);
        }
        $this->dropTable(self::TABLE);
    }
}
