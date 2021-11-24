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
 * @package    arter\amos\events
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\events\widgets\icons;

use arter\amos\core\widget\WidgetIcon;
use arter\amos\events\AmosEvents;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconEventsToPublish
 * @package arter\amos\events\widgets\icons
 */
class WidgetIconEventsToPublish extends WidgetIcon
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        $this->setLabel(AmosEvents::t('amosevents', 'Events to publish'));
        $this->setDescription(AmosEvents::t('amosevents', 'Events to publish'));
        $this->setIcon('calendar');
        $this->setUrl(['/events/event/to-publish']);
        $this->setCode('EVENT_TO_PUBLISH');
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
    }

}
