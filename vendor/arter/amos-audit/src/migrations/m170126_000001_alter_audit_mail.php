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

class m170126_000001_alter_audit_mail extends Migration
{
    const TABLE = '{{%audit_mail}}';

    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            $this->alterColumn(self::TABLE, 'data', 'LONGBLOB');
        } elseif ($this->db->driverName === 'sqlsrv') {
            $this->alterColumn(self::TABLE, 'data', 'VARBINARY(MAX)');
        } else {
            $this->alterColumn(self::TABLE, 'data', 'BYTEA');
        }
    }
}
