<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\supercraft\models\ProcessoAziendale */

$this->title = 'Update Processo Aziendale: ' . $model->id_processo_aziendale;
$this->params['breadcrumbs'][] = ['label' => 'Processo Aziendales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_processo_aziendale, 'url' => ['view', 'id_processo_aziendale' => $model->id_processo_aziendale]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="processo-aziendale-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
