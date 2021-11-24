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
 * @package    arter\amos\utility\drivers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\utility\drivers;

use arter\amos\utility\drivers\base\bcDriver;
use arter\amos\events\models\Event;
use arter\amos\events\models\search\EventSearch;
use arter\amos\events\widgets\icons\WidgetIconAllEvents;
use arter\amos\events\widgets\icons\WidgetIconEventOwnInterest;
use arter\amos\events\widgets\icons\WidgetIconEvents;
use arter\amos\events\widgets\icons\WidgetIconEventsCreatedBy;

/**
 * 
 */
class bcDriverEvents extends bcDriver
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->modelClassName  = Event::className(); // put here your model
        $this->widgetIconNames = [
            WidgetIconAllEvents::getWidgetIconName() => WidgetIconAllEvents::classname(),
            WidgetIconEventOwnInterest::getWidgetIconName() => WidgetIconEventOwnInterest::classname(),
        ];
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconEventsCreatedBy()
    {
        $search       = new EventSearch();
        $dataProvider = $search->searchCreatedBy([]);
        $this->query  = $dataProvider->query;
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconAllEvents()
    {
        $search       = new EventSearch();
        $dataProvider = $search->searchAllEvents([]);
        $this->query  = $dataProvider->query;
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconEventOwnInterest()
    {
        $search      = new EventSearch();
        $this->query = $search->buildQuery([], 'own-interest');
    }
}