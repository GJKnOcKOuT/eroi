<?php
/**
 * @User GJKnOcKOuT
 * @Project eroi
 * @Date 14/02/2022
 */

use backend\modules\supercraft\models\FaseReale;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $controller backend\modules\supercraft\controllers\PaController */
/* @var $searchModel backend\modules\supercraft\models\PaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $this yii\web\View */
/* @var $model backend\modules\supercraft\models\ProcessoAziendale */
/* @var $dashboard backend\modules\supercraft\models\dashboard */
/* @var $actionColum yii\grid\ActionColumn */
/* @var $fl */
/* @var $fase_reale */
$this->title = 'Stato processo';
$this->registerCssFile("/supercraftcss/css/dashboard.css");
?>

<div class="processo-aziendale-index">

    <p>
        <?= Html::a('I Miei progetti', ['dashboard', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Opportunità', ['opportunita', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('In Corso', ['incorso', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Archiviati', ['archiviati', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?php if ((FaseReale::findOne($fase_reale)->data_fine) == '') echo Html::a('Crea una attività', ['createattivita', 'id_fase_reale' => $fase_reale, 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-success rosso']) ?>
        <?php if ((FaseReale::findOne($fase_reale)->data_fine) == '') echo Html::a('Fine Fase', ['finefase', 'id_fase_reale' => $fase_reale], ['class' => 'btn btn-danger rosso']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=

    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],

            [
                'header' => 'Attivita',
                'attribute' => 'descrizione',
                'format' => 'text',
            ],
            'data_inizio',
            'data_fine',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        $model['data_fine'] = date("Y-m-d H:i:s");
                        $model->update();
                        return Html::button('<span class="fas fa-calendar-check"></span>', ['class' => 'btn btn-default btn-xs']);
                    }
                ],
                'urlCreator' => function ($action, $model1, $key, $index) use ($model) {
                    if ($action === 'view') {
                        return 'viewazioni?id_processo_reale=' . $model1['id_processo_reale'] . '&id_processo_aziendale=' . $model->id_processo_aziendale;
                    }
                    if ($action === 'delete') {
                        return Url::current();
                    }
                }
            ],
        ],
    ]); ?>

</div>
