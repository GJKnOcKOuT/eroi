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
 * @package    arter\amos\ticket\widgets\graphics\views\fullsize
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\icons\AmosIcons;
use arter\amos\ticket\AmosTicket;
use arter\amos\ticket\models\Ticket;
use arter\amos\ticket\widgets\graphics\WidgetGraphicAssistance;

\arter\amos\ticket\assets\TicketAsset::register($this);

/**
 * @var yii\web\View $this
 * @var WidgetGraphicAssistance $widget
 * @var Ticket[] $waitingTicketsList
 * @var Ticket[] $inProgressTicketsList
 * @var Ticket[] $closedTicketsList
 */

?>
<div class="box-widget-header">
    <div class="box-widget-wrapper">
        <h2 class="box-widget-title">
            <?= AmosIcons::show('assistenza', ['class' => 'am-2'], AmosIcons::IC) ?>
            <?= AmosTicket::t('amosticket', '#widget_graphic_assistance_label') ?>
        </h2>
    </div>
</div>
<div class="box-widget box-widget-column assistance-widget">
    <section>
        <div class="list-items">
            <?= $this->render('_ticket_list', [
                'widget' => $widget,
                'ticketsList' => $waitingTicketsList,
                'listTitle' => AmosTicket::t('amosticket', 'Ticket in attesa'),
                'linkToTicketList' => ['/ticket/ticket/ticket-waiting'],
                'listContainerClass' => 'widget-listbox-option waiting-tickets',
            ]) ?>
            <?= $this->render('_ticket_list', [
                'widget' => $widget,
                'ticketsList' => $inProgressTicketsList,
                'listTitle' => AmosTicket::t('amosticket', 'Ticket in lavorazione'),
                'linkToTicketList' => ['/ticket/ticket/ticket-processing'],
                'listContainerClass' => 'widget-listbox-option processing-tickets',
            ]) ?>
            <?= $this->render('_ticket_list', [
                'widget' => $widget,
                'ticketsList' => $closedTicketsList,
                'listTitle' => AmosTicket::t('amosticket', 'Ticket chiusi'),
                'linkToTicketList' => ['/ticket/ticket/ticket-closed'],
                'listContainerClass' => 'widget-listbox-option closed-tickets',
            ]) ?>
        </div>
    </section>
</div>
