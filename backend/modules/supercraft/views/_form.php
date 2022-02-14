<?php

use backend\modules\supercraft\models\ProcessoInnovativo;
use yii\data\SqlDataProvider;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\supercraft\models\ProcessoAziendale */
/* @var $form yii\widgets\ActiveForm */

$pi = ProcessoInnovativo::find()
    ->select(['nome'])
    ->indexBy('id_processo_innovativo')
    ->column();

?>

<div class="processo-aziendale-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_processo_innovativo')->dropdownList(
        $pi,
        ['prompt'=>'Scegli il tipo di processo']
    ); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>







    <?= $form->field($model, 'descrizione')->textarea(['rows' => 6]) ?>

    <?= //$form->field($model, 'copertina')->textInput(['maxlength' => true])  ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php
    $count = Yii::$app->db->createCommand(' SELECT COUNT(*) FROM processo_aziendale WHERE id_azienda = 1');
    $sql = (new \yii\db\Query())
        ->from('fase')
        ->where(['id_processo_innovativo' => $model->id_processo_innovativo])
        ->all();

    $dataProvider = new SqlDataProvider([
        'sql' => $sql,
        'totalCount' => $count
    ]);
    $position = 1;
    ?>
    <?php ActiveForm::end(); ?>

</div>
