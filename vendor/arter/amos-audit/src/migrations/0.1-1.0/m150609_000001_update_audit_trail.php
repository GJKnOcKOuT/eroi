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

class m150609_000001_update_audit_trail extends \yii\db\Migration
{
    const TABLE = '{{%audit_trail}}';

    public function up()
    {
        $this->addColumn(self::TABLE, 'user_id', 'int(11) NULL AFTER audit_id');
        $this->createIndex('idx_audit_entry_user_id', self::TABLE, ['user_id']);
    }

    public function down()
    {
        $this->dropColumn(self::TABLE, 'user_id');
    }
}
