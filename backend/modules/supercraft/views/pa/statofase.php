<?php
/**
 * @User GJKnOcKOuT
 * @Project eroi
 * @Date 14/02/2022
 */

use backend\modules\supercraft\models\FaseReale;
use backend\modules\supercraft\models\ProcessoAziendale;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $controller backend\modules\supercraft\controllers\PaController */
/* @var $searchModel backend\modules\supercraft\models\PaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $this yii\web\View */
/* @var $model */
/* @var $dashboard backend\modules\supercraft\models\dashboard */
/* @var $actionColum yii\grid\ActionColumn */
/* @var $fl */
/* @var $fase_reale */
$this->title = $model->nome . ' - ' . FaseReale::findOne($fase_reale)->descrizione . ' - Stato Azioni';
$this->registerCssFile("/supercraftcss/css/dashboard.css");
?>

<div class="processo-aziendale-index">

    <p>
        <?php if ($fl == 1) Yii::$app->session->setFlash('error', "l'attività si è gia conclusa!") ?>
        <?= Html::a('Torna indetro', ['view', 'id_processo_aziendale' => $model->id_processo_aziendale, 'fl' => 0], ['class' => 'btn btn-primary']) ?>
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
                'urlCreator' => function ($action, $model1, $key, $index) use ($model) {
                    if ($action === 'view') {
                        return '';
                    }
                    if ($action === 'delete') {
                        if ($model1['data_fine'] == '') $url = 'fineattivita?id_attivita_reale=' . $model1['id_attivita_reale'] . '&id_processo_aziendale=' . $model->id_processo_aziendale;
                        else $url = 'viewazioni?id_processo_aziendale=' . $model->id_processo_aziendale . '&id_fase_reale=' . $model1['fase_reale_id_fase_reale'] . '&fl=1';

                        return $url;
                    }
                }
            ],
        ],
    ]); ?>

</div>
