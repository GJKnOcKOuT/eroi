<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\supercraft\models\ProcessoAziendale */

$this->title = 'Crea un nuovo Processo Aziendale';
$this->params['breadcrumbs'][] = ['label' => 'Processo Aziendales', 'url' => ['index']];
?>
<div class="processo-aziendale-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
