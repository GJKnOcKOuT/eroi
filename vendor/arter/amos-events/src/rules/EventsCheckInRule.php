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
 * @package    arter\amos\events\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\events\rules;

use arter\amos\community\models\CommunityUserMm;
use arter\amos\events\AmosEvents;
use arter\amos\events\models\Event;
use yii\rbac\Rule;

/**
 * Class EventsCheckInRule
 * @package arter\amos\events\rules
 */
class EventsCheckInRule extends Rule
{
    public $name = 'EventsCheckIn';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        $get = \Yii::$app->getRequest()->get();
        if (array_key_exists('eid', $get)) {
            /** @var AmosEvents $eventsModule */
            $eventsModule = AmosEvents::instance();
            if (is_null($eventsModule)) {
                return false;
            }
            /** @var Event $eventModel */
            $eventModel = $eventsModule->createModel('Event');
            $event = $eventModel::findOne(['id' => $get['eid']]);
            if ($event) {
                return $this->ruleLogic($user, $item, $params, $event);
            }
        } elseif (array_key_exists('communityId', $get)) {
            /** @var AmosEvents $eventsModule */
            $eventsModule = AmosEvents::instance();
            if (is_null($eventsModule)) {
                return false;
            }
            /** @var Event $eventModel */
            $eventModel = $eventsModule->createModel('Event');
            $event = $eventModel::findOne(['community_id' => $get['communityId']]);
            if ($event) {
                return $this->ruleLogic($user, $item, $params, $event);
            }
        }
        return false;
    }

    /**
     * Rule to Read Community
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        $communityUserMm = CommunityUserMm::find()->andWhere(['community_id' => $model->community_id,
            'role' => [Event::EVENTS_CHECK_IN, Event::EVENT_MANAGER]])
            ->andWhere(['user_id' => $user])->one();
        if (!empty($communityUserMm)) {
            return true;
        }
        return false;
    }
}
