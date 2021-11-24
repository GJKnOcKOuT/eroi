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
 * Class NewsletterContentsConf
 *
 * This is the base-model class for table "notification_newsletter_contents_conf".
 *
 * @property integer $id
 * @property string $tablename
 * @property string $classname
 * @property string $label
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\notificationmanager\models\NewsletterContents[] $newsletterContents
 *
 * @package arter\amos\notificationmanager\models\base
 */
abstract class NewsletterContentsConf extends Record
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
        return 'notification_newsletter_contents_conf';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tablename', 'classname', 'label'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['tablename', 'classname', 'label'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosNotify::t('amosnotify', 'ID'),
            'tablename' => AmosNotify::t('amosnotify', 'Tablename'),
            'classname' => AmosNotify::t('amosnotify', 'Classname'),
            'label' => AmosNotify::t('amosnotify', 'Label'),
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
    public function getNewsletterContents()
    {
        return $this->hasMany($this->notifyModule->model('NewsletterContents'), ['newsletter_contents_conf_id' => 'id']);
    }
}
