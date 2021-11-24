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
 * @package    arter\amos\discussioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\views\AmosGridView;
use arter\amos\core\utilities\ViewUtility;
use arter\amos\discussioni\AmosDiscussioni;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\discussioni\models\search\DiscussioniRisposteSearch $searchModel
 */

$this->title = AmosDiscussioni::t('amosdiscussioni', 'Discussioni Risposte');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discussioni-risposte-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= AmosGridView::widget([
        'dataProvider' => $dataProvider,
        'showPageSummary' => true,
        'showFooter' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'testo:ntext',
            'discussioni_topic_id',
            ['attribute' => 'created_at', 'format' => ['datetime', ViewUtility::formatDateTime()]],
            ['attribute' => 'updated_at', 'format' => ['datetime', ViewUtility::formatDateTime()]],

            ['class' => 'arter\amos\core\views\grid\ActionColumn',],
        ],
    ]); ?>

</div>
