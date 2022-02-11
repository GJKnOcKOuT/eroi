<?php
/**
 * @User GJKnOcKOuT
 * @Project eroi
 * @Date 10/02/2022
 */

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $controller backend\modules\supercraft\controllers\PaController */
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\supercraft\models\PaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $this yii\web\View */
/* @var $model backend\modules\supercraft\models\ProcessoAziendale */

$this->title = 'Processi Aziendali';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="processo-aziendale-index">


    <p>
        <?= Html::a('I Miei progetti', ['dashboard', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Opportunità', ['opportunita', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-danger']) ?>
        <?= Html::a('Crea Processo Aziendale', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_processo_aziendale',
            //'id_processo_innovativo',
            'nome',
            'id_azienda',
            'data_inizio',
            //'data_fine',
            'descrizione:ntext',
            //'copertina',
            //'id_fase_attuale',

            ['class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url = 'eroi/supercraft/pa/view?id_processo_aziendale=' . print_r($model);
                        return $url;
                    }

                    if ($action === 'update') {
                        $url = 'eroi/supercraft/pa/update?id_processo_aziendale=' . $model->id_processo_aziendale;
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url = 'eroi/supercraft/pa/delete?id_processo_aziendale=' . $model->id_processo_aziendale;
                        return $url;
                    }
                    return null;
                }
            ],
        ],
    ]); ?>


</div>
