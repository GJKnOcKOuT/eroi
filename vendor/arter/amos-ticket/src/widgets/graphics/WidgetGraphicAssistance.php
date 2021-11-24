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
 * @package    arter\amos\ticket\widgets\graphics
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\ticket\widgets\graphics;

use arter\amos\core\widget\WidgetGraphic;
use arter\amos\ticket\AmosTicket;
use arter\amos\ticket\models\search\TicketSearch;

/**
 * Class WidgetGraphicAssistance
 * @package arter\amos\ticket\widgets\graphics
 */
class WidgetGraphicAssistance extends WidgetGraphic
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setCode('ASSISTANCE_GRAPHIC');
        $this->setLabel(AmosTicket::t('amosticket', '#widget_graphic_assistance_label'));
        $this->setDescription(AmosTicket::t('amosticket', '#widget_graphic_assistance_description'));
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        $viewToRender = '@vendor/arter/amos-ticket/src/widgets/graphics/views/assistance_widget';
        $numberToView = 3;

        /** @var TicketSearch $searchModel */
        $searchModel = AmosTicket::instance()->createModel('TicketSearch');
        $waitingTicketsList = $searchModel->searchTicketWaiting($_GET, $numberToView)->getModels();
        $inProgressTicketsList = $searchModel->searchTicketProcessing($_GET, $numberToView)->getModels();
        $closedTicketsList = $searchModel->searchTicketClosed($_GET, $numberToView)->getModels();

        return $this->render(
            $viewToRender,
            [
                'widget' => $this,
                'waitingTicketsList' => $waitingTicketsList,
                'inProgressTicketsList' => $inProgressTicketsList,
                'closedTicketsList' => $closedTicketsList,
            ]
        );
    }
}
