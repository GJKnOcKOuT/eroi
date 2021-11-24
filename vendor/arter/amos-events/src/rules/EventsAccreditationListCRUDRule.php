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
use arter\amos\core\record\Record;
use arter\amos\events\AmosEvents;
use arter\amos\events\models\Event;
use arter\amos\events\models\EventAccreditationList;

/**
 * Class EventsAccreditationListCRUDRule
 * @package arter\amos\events\rules
 */
class EventsAccreditationListCRUDRule extends \arter\amos\core\rules\BasicContentRule
{
    public $name = 'EventsAccreditationListCRUDRule';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        if (isset($params['model'])) {
            /** @var Record $model */
            $model = $params['model'];
            if (!$model->id) {
                $post = \Yii::$app->getRequest()->post();
                $get = \Yii::$app->getRequest()->get();
                if (isset($get['id'])) {
                    $model = $this->instanceModel($model, $get['id']);
                } elseif (isset($post['id'])) {
                    $model = $this->instanceModel($model, $post['id']);
                } elseif (array_key_exists('eid', $get)) {
                    /** @var Event $eventModel */
                    $eventModel = AmosEvents::instance()->createModel('Event');
                    $model = $eventModel::findOne(['id' => $get['eid']]);
                }
            }
            return $this->ruleLogic($user, $item, $params, $model);
        }

        return false;
    }

    /**
     * Rule to Read Community
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        if ($model instanceof Event) {
            $communityUserMm = CommunityUserMm::find()->andWhere(['community_id' => $model->community_id, 'role' => Event::EVENT_MANAGER])->andWhere(['user_id' => $user])->one();
            if (!empty($communityUserMm)) {
                return true;
            }
        } elseif ($model instanceof EventAccreditationList) {
            $communityUserMm = CommunityUserMm::find()->andWhere(['community_id' => $model->event_id, 'role' => Event::EVENT_MANAGER])->andWhere(['user_id' => $user])->one();
            if (!empty($communityUserMm)) {
                return true;
            }
        }

        return false;
    }
}
