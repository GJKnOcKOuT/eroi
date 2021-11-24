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
use yii\db\Schema;

class m180918_084437_add_email_spool_index extends Migration
{
    const TABLE = '{{%email_template}}';
    const TABLE_SPOOL = '{{%email_spool}}';


    public function safeUp()
    {
        if ($this->db->schema->getTableSchema(self::TABLE_SPOOL, true) !== null) {
            $this->createIndex("created_at", self::TABLE_SPOOL, ["created_at"]);
        }
    }

    public function safeDown()
    {
        if ($this->db->schema->getTableSchema(self::TABLE_SPOOL, true) !== null) {
            $this->dropIndex("created_at", self::TABLE_SPOOL);
        }
    }
}
