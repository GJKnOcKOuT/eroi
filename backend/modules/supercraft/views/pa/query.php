<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\controllers\PaController;

/* @var $this yii\web\View */
/* @var $model app\models\QueryForm */
/* @var $form ActiveForm */
/* @var $pa PaController*/
?>

    <?php
     if (Yii::$app->session->hasFlash('Success')){
        echo Yii::$app->session->getFlash('success');
    }?>
<div class="Pa-query">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'id_processo_aziendale') ?>
        <?= $form->field($model, 'id_azienda') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- Pa-query -->
