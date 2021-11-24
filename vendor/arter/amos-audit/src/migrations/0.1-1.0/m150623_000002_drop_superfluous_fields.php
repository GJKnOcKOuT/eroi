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


use arter\amos\audit\models\AuditError;

class m150623_000002_drop_superfluous_fields extends \yii\db\Migration
{
    const TABLE = '{{%audit_entry}}';

    public function up()
    {
        $this->dropColumn(self::TABLE, 'start_time');
        $this->dropColumn(self::TABLE, 'end_time');
        $this->dropColumn(self::TABLE, 'data');
        $this->dropColumn(self::TABLE, 'memory');
    }

    public function down()
    {
        $this->addColumn(self::TABLE, 'start_time', 'float DEFAULT NULL AFTER id');
        $this->addColumn(self::TABLE, 'end_time', 'float DEFAULT NULL AFTER start_time');
        $this->addColumn(self::TABLE, 'data', 'blob AFTER route');
        $this->addColumn(self::TABLE, 'memory', 'int(11) DEFAULT NULL after data');
    }
}
