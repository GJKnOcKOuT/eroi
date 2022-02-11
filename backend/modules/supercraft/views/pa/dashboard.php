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

$this->title = 'Processo Aziendale';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="processo-aziendale-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crea Processo Aziendale', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('I Miei progetti', ['dashboard', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Opportunità', ['opportunita', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-danger']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel->search([1, 0, 0]),
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
