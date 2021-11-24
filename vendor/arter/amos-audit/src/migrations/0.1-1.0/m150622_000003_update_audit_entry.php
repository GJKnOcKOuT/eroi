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

class m150622_000003_update_audit_entry extends \yii\db\Migration
{
    const TABLE = '{{%audit_entry}}';
    public function up()
    {
        $this->dropColumn(self::TABLE, 'origin');
    }
    public function down()
    {
        $this->addColumn(self::TABLE, 'origin', 'varchar(512) NULL AFTER ip');
    }
}
