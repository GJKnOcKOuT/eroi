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
 * @package    arter\amos\events\widgets\graphics
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\events\widgets\graphics;

use arter\amos\core\widget\WidgetGraphic;
use arter\amos\events\AmosEvents;
use arter\amos\events\models\search\EventSearch;
use arter\amos\notificationmanager\base\NotifyWidgetDoNothing;

/**
 * Class WidgetGraphicsEvents
 * @package arter\amos\events\widgets\graphics
 */
class WidgetGraphicsEvents extends WidgetGraphic
{
    /**
     * @var int Numero eventi visualizzati
     */
    const NUMBER_EVENTS = 5;

    /**
     * @var string ORDER_EVENTS ordimento event Carousel
     */
    const ORDER_EVENTS = 'begin_date_hour DESC';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setLabel(AmosEvents::tHtml('amosevents', 'Events'));
        $this->setDescription(AmosEvents::t('amosevents', 'Elenca gli ultimi Eventi'));
    }

    /**
     * @inheritdoc
     */
    public function getHtml()
    {
        /** @var EventSearch $search */
        $search = AmosEvents::instance()->createModel('EventSearch');
        $search->setNotifier(new NotifyWidgetDoNothing());
        $listEvents = $search->ultimeEvents($_GET, self::NUMBER_EVENTS);
        $eventsForCarousel = $search->ultimeEventsQuery($_GET, self::NUMBER_EVENTS)->orderBy(self::ORDER_EVENTS)->limit(self::NUMBER_EVENTS)->all();

        $viewToRender = 'ultime_events';
        $moduleLayout = \Yii::$app->getModule('layout');

        if (is_null($moduleLayout)) {
            $viewToRender .= '_old';
        }

        return $this->render($viewToRender, [
            'listEvents' => $listEvents,
            'eventsForCarousel' => $eventsForCarousel,
            'widget' => $this,
            'toRefreshSectionId' => 'widgetGraphicLatestEvents',
            'numEvents' => self::NUMBER_EVENTS,
            'orderEvents' => self::ORDER_EVENTS
        ]);
    }
}
