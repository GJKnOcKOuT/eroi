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

class m171127_174040_popolate_notification_send_email extends Migration
{
    const TABLE = 'notification_send_email';

    public function safeUp()
    {
       $this->execute("
       INSERT INTO notification_send_email (classname, content_id, created_at, updated_at, created_by, updated_by)
SELECT DISTINCT class_name as classname, content_id, NOW(), NOW(), 1, 1
FROM notification
INNER JOIN notificationread ON (notification.id = notificationread.notification_id)
WHERE notification.channels = 1;

       ");
        return true;
    }

    public function safeDown()
    {

        return true;
    }
}
