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
 * @package    arter\amos\notificationmanager\utility
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\notificationmanager\utility;

use arter\amos\core\interfaces\NewsletterInterface;
use arter\amos\core\record\Record;
use arter\amos\notificationmanager\AmosNotify;
use arter\amos\notificationmanager\exceptions\NewsletterException;
use arter\amos\notificationmanager\models\Newsletter;
use arter\amos\notificationmanager\models\NewsletterContentsConf;
use arter\amos\notificationmanager\models\Notification;
use arter\amos\notificationmanager\models\NotificationChannels;
use yii\base\BaseObject;
use yii\db\ActiveQuery;

/**
 * Class NewsletterUtility
 * @package arter\amos\notificationmanager\utility
 */
class NewsletterUtility extends BaseObject
{
    /**
     * This method add the notification row ready to be used by notifier controller.
     * @param AmosNotify $notifyModule
     * @param Newsletter $newsletter
     * @return bool
     */
    public static function addNewsletterNotification($notifyModule, $newsletter)
    {
        /** @var Notification $notification */
        $notification = $notifyModule->createModel('Notification');
        $notification->user_id = \Yii::$app->user->id;
        $notification->channels = NotificationChannels::CHANNEL_NEWSLETTER;
        $notification->content_id = $newsletter->id;
        $notification->class_name = $newsletter::className();
        $ok = $notification->save(false);
        return $ok;
    }
    
    /**
     * This method remove the notification row ready to be used by notifier controller.
     * @param AmosNotify $notifyModule
     * @param Newsletter $newsletter
     * @return bool
     */
    public static function removeNewsletterNotification($notifyModule, $newsletter)
    {
        if (is_null($notifyModule)) {
            $notifyModule = AmosNotify::instance();
            if (is_null($notifyModule)) {
                throw new NewsletterException('Notify module not found');
            }
        }
        
        /** @var Notification $notificationModel */
        $notificationModel = $notifyModule->createModel('Notification');
        
        /** @var Notification[] $notifications */
        $notifications = $notificationModel::find()->andWhere([
            'channels' => NotificationChannels::CHANNEL_NEWSLETTER,
            'content_id' => $newsletter->id,
            'class_name' => $newsletter::className(),
            'processed' => 0
        ])->all();
        $ok = true;
        foreach ($notifications as $notification) {
            /** @var Notification $notification */
            if (!is_null($notification)) {
                $notification->delete();
                if ($notification->hasErrors()) {
                    $ok = false;
                }
            }
        }
        return $ok;
    }
    
    /**
     * This methods returns all the configured models as an array of NewsletterContentsConf objects.
     * @param AmosNotify|null $notifyModule
     * @param bool $withOrder
     * @return NewsletterContentsConf[]
     * @throws \yii\base\InvalidConfigException
     */
    public static function getAllNewsletterContentsConfs($notifyModule = null, $withOrder = true)
    {
        if (is_null($notifyModule)) {
            $notifyModule = AmosNotify::instance();
        }
        /** @var NewsletterContentsConf $newsletterContentsConfModel */
        $newsletterContentsConfModel = $notifyModule->createModel('NewsletterContentsConf');
        /** @var ActiveQuery $query */
        $query = $newsletterContentsConfModel::find();
        $query->indexBy('id');
        if ($withOrder) {
            $query->orderBy(['order' => SORT_ASC]);
        }
        /** @var NewsletterContentsConf[] $newsletterContentsConfs */
        $newsletterContentsConfs = $query->all();
        return $newsletterContentsConfs;
    }
    
    /**
     * This methods returns an array of the configured models as objects.
     * @param AmosNotify|null $notifyModule
     * @param bool $withOrder
     * @return Record|NewsletterInterface[]
     * @throws \yii\base\InvalidConfigException
     */
    public static function getAllNewsletterContentsModels($notifyModule = null, $withOrder = true)
    {
        $newsletterContentsConfs = self::getAllNewsletterContentsConfs($notifyModule, $withOrder);
        $newsletterContentsModels = [];
        foreach ($newsletterContentsConfs as $newsletterContentsConf) {
            $newsletterContentsModels[$newsletterContentsConf->id] = $newsletterContentsConf->getContentConfModel();
        }
        return $newsletterContentsModels;
    }
    
    /**
     * This methods returns an array with the published statuses of the configured models.
     * @param AmosNotify|null $notifyModule
     * @param bool $withOrder
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public static function getAllConfModelsPublishedStatuses($notifyModule = null, $withOrder = true)
    {
        $newsletterContentsModels = NewsletterUtility::getAllNewsletterContentsModels($notifyModule, $withOrder);
        $publishedStatusesByContentConfModel = [];
        foreach ($newsletterContentsModels as $newsletterContentsConfId => $newsletterContentsModel) {
            $publishedStatusesByContentConfModel[$newsletterContentsConfId] = $newsletterContentsModel->newsletterPublishedStatus();
        }
        return $publishedStatusesByContentConfModel;
    }
}
