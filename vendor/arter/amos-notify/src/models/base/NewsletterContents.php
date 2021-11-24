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
 * @package    arter\amos\notificationmanager\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\notificationmanager\models\base;

use arter\amos\core\record\Record;
use arter\amos\notificationmanager\AmosNotify;

/**
 * Class NewsletterContents
 *
 * This is the base-model class for table "notification_newsletter_contents".
 *
 * @property integer $id
 * @property integer $newsletter_id
 * @property integer $newsletter_contents_conf_id
 * @property integer $content_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\notificationmanager\models\Newsletter $newsletter
 * @property \arter\amos\notificationmanager\models\NewsletterContentsConf $newsletterContentsConf
 * @property \arter\amos\notificationmanager\models\NewsletterContents[] $newsletterContentWithBrothers
 *
 * @package arter\amos\notificationmanager\models\base
 */
abstract class NewsletterContents extends Record
{
    /**
     * @var AmosNotify $notifyModule
     */
    protected $notifyModule = null;
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->notifyModule = AmosNotify::instance();
        parent::init();
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_newsletter_contents';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['newsletter_id', 'newsletter_contents_conf_id', 'content_id'], 'required'],
            [['newsletter_id', 'newsletter_contents_conf_id', 'content_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['newsletter_id'], 'exist', 'skipOnError' => true, 'targetClass' => $this->notifyModule->model('Newsletter'), 'targetAttribute' => ['newsletter_id' => 'id']],
            [['newsletter_contents_conf_id'], 'exist', 'skipOnError' => true, 'targetClass' => $this->notifyModule->model('NewsletterContentsConf'), 'targetAttribute' => ['newsletter_contents_conf_id' => 'id']],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosNotify::t('amosnotify', 'ID'),
            'newsletter_id' => AmosNotify::t('amosnotify', 'Newsletter Id'),
            'newsletter_contents_conf_id' => AmosNotify::t('amosnotify', 'Newsletter Contents Conf Id'),
            'content_id' => AmosNotify::t('amosnotify', 'Content ID'),
            'created_at' => AmosNotify::t('amosnotify', 'Created at'),
            'updated_at' => AmosNotify::t('amosnotify', 'Updated at'),
            'deleted_at' => AmosNotify::t('amosnotify', 'Deleted at'),
            'created_by' => AmosNotify::t('amosnotify', 'Created by'),
            'updated_by' => AmosNotify::t('amosnotify', 'Updated by'),
            'deleted_by' => AmosNotify::t('amosnotify', 'Deleted by'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsletter()
    {
        return $this->hasOne($this->notifyModule->model('Newsletter'), ['id' => 'newsletter_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsletterContentsConf()
    {
        return $this->hasOne($this->notifyModule->model('NewsletterContentsConf'), ['id' => 'newsletter_contents_conf_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsletterContentWithBrothers()
    {
        return $this->hasMany(self::className(), ['newsletter_id' => 'newsletter_id'])
            ->andWhere(['newsletter_contents_conf_id' => $this->newsletter_contents_conf_id]);
    }
}
