<?php
/**
 * @User GJKnOcKOuT
 * @Project eroi
 * @Date 10/02/2022
 */

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $controller backend\modules\supercraft\controllers\PaController */
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\supercraft\models\PaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $this yii\web\View */
/* @var $model backend\modules\supercraft\models\ProcessoAziendale */
/* @var $dashboard backend\modules\supercraft\models\dashboard */
/* @var $fl = 0 */
$this->title = 'Processi Aziendali';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="processo-aziendale-index">

    <p>
        <?= Html::a('I Miei progetti', ['dashboard', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Opportunità', ['opportunita', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('In Corso', ['incorso', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Archiviati', ['archiviati', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Crea Processo Aziendale', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_processo_aziendale',
            //'id_processo_innovativo',
            'nome',
            'id_azienda',
            'data_inizio',
           //TODO AGGIUNGERE DATA_FINE SOLO NEL CASO SI STIA GUARDANDO I CASI ARCHIVIATI
            'descrizione:ntext',
            //'copertina',
            //'id_fase_attuale',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
