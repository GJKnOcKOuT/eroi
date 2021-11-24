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

use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\ticket\AmosTicket;
use arter\amos\ticket\models\Ticket;
use arter\amos\ticket\widgets\graphics\WidgetGraphicAssistance;

/**
 * @var yii\web\View $this
 * @var WidgetGraphicAssistance $widget
 * @var Ticket[] $ticketsList
 * @var string $listTitle
 * @var array $linkToTicketList
 * @var string $listContainerClass
 */

?>

<div class="<?= $listContainerClass; ?>">
    <div>
        <h4><?= $listTitle; ?></h4>
        <?= Html::a(AmosIcons::show('open-in-new',['class' => 'am-2']), $linkToTicketList) ?>
    </div>
    <section>
        <?php if (count($ticketsList) == 0): ?>
            <div class="list-items list-empty"><p><?= AmosTicket::t('amosticket', '#widget_assistance_list_no_tickets') ?></p></div>
        <?php endif; ?>
        <div class="list-items">
            <?php foreach ($ticketsList as $ticket): ?>
                <div class="widget-listbox-option" role="option">
                    <article class="wrap-item-box">
                        <?= $this->render('_ticket_list_element', [
                            'widget' => $widget,
                            'ticket' => $ticket,
                            'listContainerClass' => $listContainerClass,
                        ]) ?>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>
