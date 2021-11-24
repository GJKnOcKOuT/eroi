<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\discussioni\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\libs\common\MigrationCommon;
use arter\amos\discussioni\AmosDiscussioni;
use arter\amos\discussioni\models\DiscussioniTopic;
use yii\db\Migration;

/**
 * Class m170619_152314_add_discussioni_favourite_channel_notifications
 */
class m170619_152314_add_discussioni_favourite_channel_notifications extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $notifyModule = Yii::$app->getModule('notify');
        if (is_null($notifyModule)) {
            MigrationCommon::printConsoleMessage(AmosDiscussioni::t('amosdiscussioni', 'Notify module not installed. Nothing to do.'));
            return true;
        }
        $retval = \arter\amos\notificationmanager\AmosNotify::manageNewChannelNotifications(
            DiscussioniTopic::className(),
            \arter\amos\notificationmanager\models\NotificationChannels::CHANNEL_FAVOURITES,
            \arter\amos\notificationmanager\models\NotificationChannels::MANAGE_UP);
        
        if (is_array($retval)) {
            if (!$retval['success']) {
                foreach ($retval['errors'] as $error) {
                    MigrationCommon::printConsoleMessage($error);
                }
            }
        }
        
        return $retval['success'];
    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $notifyModule = Yii::$app->getModule('notify');
        if (is_null($notifyModule)) {
            MigrationCommon::printConsoleMessage(AmosDiscussioni::t('amosdiscussioni', 'Notify module not installed. Nothing to do.'));
            return true;
        }
        $retval = \arter\amos\notificationmanager\AmosNotify::manageNewChannelNotifications(
            DiscussioniTopic::className(),
            \arter\amos\notificationmanager\models\NotificationChannels::CHANNEL_FAVOURITES,
            \arter\amos\notificationmanager\models\NotificationChannels::MANAGE_DOWN);
        if (!$retval['success']) {
            foreach ($retval['errors'] as $error) {
                MigrationCommon::printConsoleMessage($error);
            }
        }
        return $retval['success'];
    }
}
