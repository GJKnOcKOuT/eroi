<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Processo Aziendale';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="processo-aziendale-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Processo Aziendale', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_processo_aziendale',
            'id_processo_innovativo',
            'nome',
            'id_azienda',
            'data_inizio',
            //'data_fine',
            //'descrizione:ntext',
            //'copertina',
            //'id_fase_attuale',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
