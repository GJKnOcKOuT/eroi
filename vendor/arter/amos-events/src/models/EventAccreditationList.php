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


namespace arter\amos\events\models;

use arter\amos\core\validators\CFValidator;
use arter\amos\events\AmosEvents;
use yii\helpers\ArrayHelper;

/**
 * This is the base-model class for table "user_profile".
 *
 * @property integer $id
 * @property integer $event_id
 * @property integer $position
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 */
class EventAccreditationList extends \arter\amos\core\record\Record
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%event_accreditation_list}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(), [
            [[
                'title',
            ], 'string'],
            [[
                'id',
                'event_id',
                'position',
            ], 'integer'],
            [[
                'title',
                'id',
                'event_id',
                'position',
            ], 'safe'],
            [[
                'title',
                'position',
            ], 'required'],
        ]);
    }

    /**
     * @return Event|null
     */
    public function getEvent() {
        /** @var Event $eventModel */
        $eventModel = AmosEvents::instance()->createModel('Event');
        return $eventModel::findOne(['id' => $this->event_id]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'title' => AmosEvents::t('amosevents', '#name'),
            'position' => AmosEvents::t('amosevents', 'Position'),
        ]);
    }

}