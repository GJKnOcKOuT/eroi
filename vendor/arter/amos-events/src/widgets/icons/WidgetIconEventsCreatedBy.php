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
 * @package    arter\amos\events\widgets\icons
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\events\widgets\icons;

use arter\amos\core\widget\WidgetIcon;
use arter\amos\events\AmosEvents;
use arter\amos\events\models\search\EventSearch;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconEventsCreatedBy
 * @package arter\amos\events\widgets\icons
 */
class WidgetIconEventsCreatedBy extends WidgetIcon
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setLabel(AmosEvents::t('amosevents', 'Events created by me'));
        $this->setDescription(AmosEvents::t('amosevents', 'Events created by me'));
        $this->setIcon('calendar');
        $this->setUrl(['/events/event/created-by']);
        $this->setCode('EVENT_CREATED_BY');
        $this->setModuleName('events');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                [
                    'bk-backgroundIcon',
                    'color-lightPrimary'
                ]
            )
        );

//        /** @var AmosEvents $eventsModule */
//        $eventsModule = AmosEvents::instance();
//        /** @var EventSearch $search */
//        $search = $eventsModule->createModel('EventSearch');
//        $dataProvider = $search->searchCreatedBy([]);
//        /** @var AmosEvents $eventsModule */
//        $eventsModule = AmosEvents::instance();
//
//        $this->setBulletCount(
//            $this->makeBulletCounter(
//                Yii::$app->getUser()->getId(),
//                $eventsModule->model('Event'),
//                $dataProvider->query
//            )
//        );
    }
}
