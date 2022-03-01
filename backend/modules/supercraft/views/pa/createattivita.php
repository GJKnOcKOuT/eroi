<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\supercraft\models\AttivitaReale */

$this->title = 'Crea una Attività';
$this->params['breadcrumbs'][] = ['label' => 'Attivita Reale', 'url' => ['pa/dashboard/']];
?>
<div class="processo-aziendale-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formattivita', [
        'model' => $model,
    ]) ?>

</div>
