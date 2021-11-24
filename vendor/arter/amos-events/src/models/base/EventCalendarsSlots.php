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


namespace arter\amos\events\models\base;

use arter\amos\core\user\User;
use Yii;

/**
 * This is the base-model class for table "event_calendars_slots".
 *
 * @property integer $id
 * @property integer $event_calendars_id
 * @property string $date
 * @property string $hour_start
 * @property string $hour_end
 * @property integer $user_id
 * @property string $cellphone
 * @property string $affiliation
 * @property string $booked_at
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property User $user
 */
class  EventCalendarsSlots extends \arter\amos\core\record\Record
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_calendars_slots';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_calendars_id', 'date','hour_start','hour_end'], 'required'],
            [['event_calendars_id', 'user_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['cellphone', 'affiliation', 'booked_at', 'hour_start', 'hour_end', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('amosevents', 'ID'),
            'event_calendars_id' => Yii::t('amosevents', 'Event'),
            'hour_end' => Yii::t('amosevents', 'Time end'),
            'date' => Yii::t('amosevents', 'Date'),
            'hour_start' => Yii::t('amosevents', 'Time start'),
            'user_id' => Yii::t('amosevents', 'User'),
            'affiliation' => Yii::t('amosevents', 'Affiliation'),
            'cellphone' => Yii::t('amosevents', 'Cellphone'),
            'booked_at' => Yii::t('amosevents', 'Booked at'),
            'created_at' => Yii::t('amosevents', 'Created at'),
            'updated_at' => Yii::t('amosevents', 'Updated at'),
            'deleted_at' => Yii::t('amosevents', 'Deleted at'),
            'created_by' => Yii::t('amosevents', 'Created by'),
            'updated_by' => Yii::t('amosevents', 'Updated by'),
            'deleted_by' => Yii::t('amosevents', 'Deleted by'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventCalendars()
    {
        return $this->hasOne(\arter\amos\events\models\EventCalendars::className(), [ 'id' =>'event_calendars_id']);
    }

}
