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
 * @package    arter\amos\events\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\events\models\base;

use arter\amos\events\AmosEvents;
use yii\helpers\ArrayHelper;

/**
 * Class EventTypeContext
 * This is the base-model class for table "event_type_context".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 *
 * @property \arter\amos\events\models\EventType[] $eventTypes
 *
 * @package arter\amos\events\models\base
 */
class EventTypeContext extends \arter\amos\core\record\Record
{
    const EVENT_TYPE_CONTEXT_GENERIC = 1;
    const EVENT_TYPE_CONTEXT_PROJECT = 2;
    const EVENT_TYPE_CONTEXT_MATCHMAKING = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_type_context';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 2000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => AmosEvents::t('amosevents', 'ID'),
            'title' => AmosEvents::t('amosevents', 'Title'),
            'description' => AmosEvents::t('amosevents', 'Description')
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTypes()
    {
        return $this->hasMany(AmosEvents::instance()->model('EventType'), ['id' => 'event_context_id']);
    }
}
