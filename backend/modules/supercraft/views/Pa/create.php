<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProcessoAziendale */

$this->title = 'Create Processo Aziendale';
$this->params['breadcrumbs'][] = ['label' => 'Processo Aziendales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="processo-aziendale-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
