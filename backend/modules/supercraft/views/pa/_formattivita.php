<?php

use backend\modules\supercraft\models\AttivitaReale;
use backend\modules\supercraft\models\ConfigurazioneModuliPerFase;
use backend\modules\supercraft\models\Fase;
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

$fase = FasiDiProcesso::findOne(FaseReale::findOne($model['fase_reale_id_fase_reale'])->id_fasi_di_processo)->id_fase;
$cmf = ConfigurazioneModuliPerFase::find()
    ->select(['descrizione'])
    ->indexBy('id_modulo_eroi')
    ->column();

?>

<div class="attivita-reale-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_modulo_eroi')->dropdownList(
        $cmf,
        ['prompt' => "Scegli l'azione che vuoi creare"]
    ); ?>

    <?= $form->field($model, 'descrizione')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>


</div>