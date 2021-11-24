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
 * @package    arter\amos\ticket\views\ticket
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\CloseButtonWidget;
use arter\amos\ticket\AmosTicket;
use arter\amos\ticket\controllers\TicketController;

/**
 * @var yii\web\View $this
 * @var arter\amos\ticket\models\Ticket $model
 */
if ($model->ticketCategoria) {
    $this->title = AmosTicket::t('amosticket', 'Nuovo ticket');
}

/** @var TicketController $appController */
$appController = Yii::$app->controller;
?>

<div class="ticket-create m-t-10">
    <?= AmosTicket::t('amosticket', '#create_ticket_thankyou_message', ['categoryName' => $model->ticketCategoria->nomeCompleto]) ?>
</div>
<div class="btnViewContainer pull-left">
    <?=
    CloseButtonWidget::widget([
        'title' => AmosTicket::t('amosticket', '#go_back'),
        'layoutClass' => 'pull-left',
        'urlClose' => $appController->getViewCloseUrl()
    ])
    ?>
</div>