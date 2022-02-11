<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\supercraft\models\PaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $this yii\web\View */
/* @var $model backend\modules\supercraft\models\ProcessoAziendale */

$this->title = 'Processo Aziendale';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="processo-aziendale-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Processo Aziendale', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
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
            'descrizione:ntext',
            //'copertina',
            //'id_fase_attuale',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
