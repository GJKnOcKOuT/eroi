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

use arter\amos\core\views\DataProviderView;
use arter\amos\ticket\AmosTicket;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\ticket\models\search\TicketFaqSearch $model
 */

$this->title = AmosTicket::t('amosticket', 'Gestione Faq');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-faq-index">
    <?php echo $this->render('_search', ['model' => $model]); ?>
    <?php
    echo DataProviderView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $model,
        'currentView' => $currentView,
        'gridView' => [
            'columns' => [
                //  ['class' => 'yii\grid\SerialColumn'],
                //           'id',

                'ticket_categoria_id' => [
                    'attribute' => 'ticketCategoria.nomeCompleto',
                    'label' => AmosTicket::t('amosticket', 'Categoria')
                ],
                'domanda:html',
                'risposta:html',

                [
                    'class' => 'arter\amos\core\views\grid\ActionColumn',
                ],
            ],
        ],
    ]);
    ?>
</div>
