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

class m150626_000002_create_audit_data extends Migration
{
    const TABLE = '{{%audit_data}}';

    public function up()
    {
        $this->createTable(self::TABLE, [
            'id'         => Schema::TYPE_PK,
            'entry_id'   => Schema::TYPE_INTEGER . ' NOT NULL',
            'type'       => Schema::TYPE_STRING . '(255) NOT NULL',
            'data'       => Schema::TYPE_BINARY,
        ], ($this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB' : null));

        if ($this->db->driverName != 'sqlite') {
            $this->addForeignKey('fk_audit_data_entry_id', self::TABLE, ['entry_id'], '{{%audit_entry}}', 'id');
        }
    }

    public function down()
    {
        if ($this->db->driverName != 'sqlite') {
            $this->dropForeignKey('fk_audit_data_entry_id', self::TABLE);
        }
        $this->dropTable(self::TABLE);
    }
}
