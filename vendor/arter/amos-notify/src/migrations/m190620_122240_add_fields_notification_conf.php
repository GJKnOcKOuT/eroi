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

class m190620_122240_add_fields_notification_conf extends Migration
{
    const TABLE = 'notificationconf';

    public function safeUp()
    {
        $this->addColumn(self::TABLE, 'notify_comments' ,$this->integer(1)->defaultValue(1)->after('user_id'));
        $this->addColumn(self::TABLE, 'notify_content_pubblication' ,$this->integer(1)->defaultValue(1)->after('user_id'));
        $this->addColumn(self::TABLE, 'notifications_enabled' ,$this->integer(1)->defaultValue(1)->after('user_id'));
    }

    public function safeDown()
    {
        $this->dropColumn(self::TABLE, 'notifications_enabled');
        $this->dropColumn(self::TABLE, 'notify_content_pubblication');
        $this->dropColumn(self::TABLE, 'notify_comments');
    }
}
