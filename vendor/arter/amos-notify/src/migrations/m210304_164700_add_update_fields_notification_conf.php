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

class m210304_164700_add_update_fields_notification_conf extends Migration
{
    const TABLE = 'notificationconf';

    public function safeUp()
    {
       $this->addColumn(self::TABLE, 'last_update_frequency' ,$this->dateTime()->defaultValue(null)->after('profilo_successo_email'));

    }

    public function safeDown()
    {
        $this->dropColumn(self::TABLE, 'last_update_frequency');
    }
}
