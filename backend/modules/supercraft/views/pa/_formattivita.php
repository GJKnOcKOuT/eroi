<?php

use backend\modules\supercraft\models\FaseReale;
use backend\modules\supercraft\models\FasiDiProcesso;
use backend\modules\supercraft\models\ProcessoInnovativo;
use yii\data\SqlDataProvider;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\supercraft\models\AttivitaReale */
/* @var $form yii\widgets\ActiveForm */
/* @var $fasi FasiDiProcesso */

$fr = FaseReale::find()
    ->select(['descrizione'])
    ->indexBy('id_fase_reale')
    ->column();

?>

<div class="processo-aziendale-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_fase_reale')->dropdownList(
        $fr,
        ['prompt' => "Scegli l'azione che vuoi creare"]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>