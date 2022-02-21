<?php
/**
 * @User GJKnOcKOuT
 * @Project eroi
 * @Date 14/02/2022
 */

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $controller backend\modules\supercraft\controllers\PaController */
/* @var $searchModel backend\modules\supercraft\models\PaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $this yii\web\View */
/* @var $model */
/* @var $dashboard backend\modules\supercraft\models\dashboard */
/* @var $actionColum yii\grid\ActionColumn */
/* @var $fl */
/* @var $id_processo_aziendale */
$this->title = 'Stato processo';
$this->registerCssFile("/supercraftcss/css/dashboard.css");
?>

<div class="processo-aziendale-index">

    <p>
        <?php if ($fl == 1) Yii::$app->session->setFlash('error', 'Devi prima creare la fase per visualizzarne il contenuto!') ?>
        <?= Html::a('I Miei progetti', ['dashboard', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Opportunità', ['opportunita', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('In Corso', ['incorso', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Archiviati', ['archiviati', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=

    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],

            [
                'header' => 'Fase',
                'attribute' => 'nome_processo',
                'format' => 'text',
            ],
            'data_inizio',
            'data_fine',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'urlCreator' => function ($action, $model1, $key, $index) use ($id_processo_aziendale) {
                    if ($action === 'view') {
                        $url = 'viewazioni?id_fase_reale=' . $model1['id_fase_reale'] . '&id_processo_aziendale=' . $id_processo_aziendale;
                        return $model1['data_inizio'] != '' ? $url : 'view?id_processo_aziendale=' . $id_processo_aziendale . '&fl=1';
                    }
                }
            ],
        ],
    ]); ?>

</div>
