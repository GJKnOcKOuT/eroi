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

use arter\amos\core\interfaces\NewsletterInterface;
use arter\amos\core\record\Record;
use arter\amos\notificationmanager\AmosNotify;
use yii\db\ActiveQuery;

/**
 * Class NewsletterContents
 * This is the model class for table "notification_newsletter_contents".
 * @package arter\amos\notificationmanager\models
 */
class NewsletterContents extends \arter\amos\notificationmanager\models\base\NewsletterContents
{
    /**
     * @inheritdoc
     */
    public function representingColumn()
    {
        return [
            'classname'
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
     * Returns the content model instance.
     * @return Record|NewsletterInterface|null
     */
    public function getContentModel()
    {
        $newsletterConf = $this->newsletterContentsConf;
        /** @var Record $className */
        $className = $newsletterConf->classname;
        /** @var ActiveQuery $query */
        $contentModel = $className::findOne(['id' => $this->content_id]);
        return $contentModel;
    }
}
