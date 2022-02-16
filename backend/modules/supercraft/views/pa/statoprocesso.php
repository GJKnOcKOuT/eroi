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
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\supercraft\models\PaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $this yii\web\View */
/* @var $model */
/* @var $dashboard backend\modules\supercraft\models\dashboard */
/* @var $actionColum yii\grid\ActionColumn */
/* @var $fl = 0 */
$this->title = $model->nome;
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("/supercraftcss/css/dashboard.css");
?>

<div class="processo-aziendale-index">

    <p>
        <?= Html::a('I Miei progetti', ['dashboard', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Opportunità', ['opportunita', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('In Corso', ['incorso', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Archiviati', ['archiviati', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Crea Processo Aziendale', ['create'], ['class' => 'btn btn-success rosso']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=

    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'nome_processo',
            'data_inizio',
            'data_fine',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'urlCreator' => function ($action, $model1, $key, $index) {
                    // if ($action === 'view') {
                    //     $url = 'view?id_processo_aziendale=' . $model1['id_processo_aziendale'];
                    //     return $url;
                    // }
                }
            ],
        ],
    ]); ?>

</div>
