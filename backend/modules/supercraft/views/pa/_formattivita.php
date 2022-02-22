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

$fase = Fase::findOne(FasiDiProcesso::findOne(FaseReale::findOne($model['fase_reale_id_fase_reale'])->id_fasi_di_processo));
$cmf = ConfigurazioneModuliPerFase::find()
    ->select(['descrizione'])
    ->where(['=', 'id_fase', $fase])
    ->indexBy('id_modulo_eroi')
    ->column();

?>

<div class="processo-aziendale-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_fase_reale')->dropdownList(
        $cmf,
        ['prompt' => "Scegli l'azione che vuoi creare"]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>