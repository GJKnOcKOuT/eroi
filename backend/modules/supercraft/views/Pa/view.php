<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProcessoAziendale */

$this->title = $model->id_processo_aziendale;
$this->params['breadcrumbs'][] = ['label' => 'Processo Aziendales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="processo-aziendale-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_processo_aziendale' => $model->id_processo_aziendale], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_processo_aziendale',
            'id_processo_innovativo',
            'nome',
            'id_azienda',
            'data_inizio',
            'data_fine',
            'descrizione:ntext',
            'copertina',
            'id_fase_attuale',
        ],
    ]) ?>

</div>
