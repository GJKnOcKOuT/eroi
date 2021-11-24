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

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconEventOwnInterest
 * @package arter\amos\events\widgets\icons
 */
class WidgetIconEventOwnInterest extends WidgetIcon
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setLabel(AmosEvents::t('amosevents', 'Own Interest Events'));
        $this->setDescription(AmosEvents::t('amosevents', 'Own Interest Events'));
        $this->setLabel(AmosEvents::t('amosevents', '#widget_icon_event_own_interest_label'));
        $this->setDescription(AmosEvents::t('amosevents', '#widget_icon_event_own_interest_description'));
        $this->setIcon('calendar');
        $this->setUrl(['/events/event/own-interest']);
        $this->setCode('EVENT_OWN_INTEREST');
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

        if ($this->disableBulletCounters == false) {
            /** @var AmosEvents $eventsModule */
            $eventsModule = AmosEvents::instance();
            /** @var EventSearch $search */
            $search = $eventsModule->createModel('EventSearch');
            $this->setBulletCount(
                $this->makeBulletCounter(
                    Yii::$app->getUser()->getId(),
                    $eventsModule->model('Event'),
                    $search->buildQuery([], 'own-interest')
                )
            );
        }
    }
}
