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
 * @package    arter\amos\notificationmanager\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\notificationmanager\models;

use arter\amos\core\record\Record;
use arter\amos\notificationmanager\AmosNotify;

/**
 * Class NewsletterContentsConf
 * This is the model class for table "notification_newsletter_contents_conf".
 * @package arter\amos\notificationmanager\models
 */
class NewsletterContentsConf extends \arter\amos\notificationmanager\models\base\NewsletterContentsConf
{
    /**
     * @inheritdoc
     */
    public function representingColumn()
    {
        return [
            'newsletter_id',
            'newsletter_contents_conf_id',
            'content_id'
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function getModelModuleName()
    {
        return AmosNotify::getModuleName();
    }
    
    /**
     * This method returns a new instance of the model classname configured.
     * @return Record
     * @throws \yii\base\InvalidConfigException
     */
    public function getContentConfModel()
    {
        /** @var Record $contentConfModel */
        $contentConfModel = \Yii::createObject($this->classname);
        return $contentConfModel;
    }
}
