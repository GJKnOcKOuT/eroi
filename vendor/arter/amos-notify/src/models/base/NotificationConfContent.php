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


namespace arter\amos\notificationmanager\models\base;

use arter\amos\core\models\ModelsClassname;
use arter\amos\notificationmanager\models\NotificationConf;
use Yii;

/**
 * This is the base-model class for table "notification_conf_content".
 *
 * @property integer $id
 * @property integer $notification_conf_id
 * @property integer $models_classname_id
 * @property integer $content_id
 * @property integer $email
 * @property integer $push_notification
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property ModelsClassname $modelsClassname
 * @property \arter\amos\notificationmanager\models\Notificationconf $notificationConf
 */
class  NotificationConfContent extends \arter\amos\core\record\Record
{
    public $isSearch = false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_conf_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notification_conf_id', 'models_classname_id', 'content_id', 'email', 'push_notification', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['models_classname_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModelsClassname::className(), 'targetAttribute' => ['models_classname_id' => 'id']],
            [['notification_conf_id'], 'exist', 'skipOnError' => true, 'targetClass' => NotificationConf::className(), 'targetAttribute' => ['notification_conf_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('amosnotify', 'ID'),
            'notification_conf_id' => Yii::t('amosnotify', 'Notification conf'),
            'models_classname_id' => Yii::t('amosnotify', 'Content classname'),
            'content_id' => Yii::t('amosnotify', 'Content id'),
            'email' => Yii::t('amosnotify', 'Enable email'),
            'push_notification' => Yii::t('amosnotify', 'Enable email'),
            'created_at' => Yii::t('amosnotify', 'Created at'),
            'updated_at' => Yii::t('amosnotify', 'Updated at'),
            'deleted_at' => Yii::t('amosnotify', 'Deleted at'),
            'created_by' => Yii::t('amosnotify', 'Created by'),
            'updated_by' => Yii::t('amosnotify', 'Updated at'),
            'deleted_by' => Yii::t('amosnotify', 'Deleted at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelsClassname()
    {
        return $this->hasOne(ModelsClassname::className(), ['id' => 'models_classname_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationConf()
    {
        return $this->hasOne(\arter\amos\notificationmanager\models\Notificationconf::className(), ['id' => 'notification_conf_id']);
    }
}
