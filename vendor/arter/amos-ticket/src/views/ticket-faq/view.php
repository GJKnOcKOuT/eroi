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
 * @package    arter\amos\ticket\views\ticket-faq
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\ticket\AmosTicket;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var arter\amos\ticket\models\TicketFaq $model
 */

$this->title = strip_tags(substr($model->domanda, 0, 15) . '...');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('cruds', 'Ticket Faq'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => AmosTicket::t('amosticket', 'Assistenza'), 'url' => '/ticket'];
$this->params['breadcrumbs'][] = ['label' => AmosTicket::t('amosticket', 'Faq'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-faq-view col-xs-12">
    <?=
    ContextMenuWidget::widget([
        'model' => $model,
        'actionModify' => "/ticket/ticket-faq/update?id=" . $model->id,
        'actionDelete' => "/ticket/ticket-faq/delete?id=" . $model->id,
        'labelDeleteConfirm' => AmosTicket::t('amosticket', 'Sei sicuro di voler cancellare questa faq?'),
    ])
    ?>
    <h2>
        <?= AmosTicket::t('amosticket', 'Dettagli'); ?>
    </h2>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'domanda:html',
            'risposta:html',
            [
                'attribute' => 'ticket_categoria_id',
                'label' => $model->getAttributeLabel('ticket_categoria_id'),
                'value' => (!is_null($model->ticket_categoria_id) ? $model->ticketCategoria->nomeCompleto : '-'),
            ]
        ],
    ])
    ?>

    <div class="btnViewContainer pull-right">
        <?= Html::a(Yii::t('amoscore', 'Chiudi'), Url::previous(), ['class' => 'btn btn-secondary']); ?>
    </div>
</div>
