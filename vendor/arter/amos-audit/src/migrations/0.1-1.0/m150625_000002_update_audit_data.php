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

class m150625_000002_update_audit_data extends \yii\db\Migration
{
    const TABLE = '{{%audit_data}}';

    public function up()
    {
        $this->dropColumn(self::TABLE, 'name');
        $this->dropColumn(self::TABLE, 'packed');
    }

    public function down()
    {
        $this->addColumn(self::TABLE, 'name', 'VARCHAR(255) NULL AFTER entry_id');
        $this->addColumn(self::TABLE, 'packed', 'TINYINT(1) UNSIGNED DEFAULT 0 AFTER type');
    }
}
