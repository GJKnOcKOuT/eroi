<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="processo-aziendale-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_processo_aziendale') ?>

    <?= $form->field($model, 'id_processo_innovativo') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'id_azienda') ?>

    <?= $form->field($model, 'data_inizio') ?>

    <?php // echo $form->field($model, 'data_fine') ?>

    <?php // echo $form->field($model, 'descrizione') ?>

    <?php // echo $form->field($model, 'copertina') ?>

    <?php // echo $form->field($model, 'id_fase_attuale') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
