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
 * @package arter\amos\events\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\events\models\base;

use arter\amos\events\AmosEvents;
use yii\helpers\ArrayHelper;

/**
 * Class EventMembershipType
 * This is the base-model class for table "event_membership_type".
 *
 * @property integer $id
 * @property string $title
 *
 * @property \arter\amos\events\models\Event[] $events
 *
 * @package arter\amos\events\models\base
 */
class EventMembershipType extends \arter\amos\core\record\Record
{
    const TYPE_OPEN = 1;
    const TYPE_ON_INVITATION = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_membership_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => AmosEvents::t('amosevents', 'ID'),
            'title' => AmosEvents::t('amosevents', 'Title')
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(AmosEvents::instance()->model('Event'), ['event_membership_type_id' => 'id']);
    }
}
