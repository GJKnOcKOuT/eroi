<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_organizzazioni\views\profilo-sedi
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\CloseSaveButtonWidget;
use arter\amos\core\forms\editors\Select;
use arter\amos\core\forms\RequiredFieldsTipWidget;
use arter\amos\core\forms\Tabs;
use arter\amos\organizzazioni\Module;
use arter\amos\organizzazioni\utility\OrganizzazioniUtility;
use arter\amos\organizzazioni\widgets\maps\PlaceWidget;

/**
 * @var yii\web\View $this
 * @var arter\amos\organizzazioni\models\ProfiloSedi $model
 * @var yii\widgets\ActiveForm $form
 */

$types = OrganizzazioniUtility::getProfiloSediTypesReadyForSelect();
$profiloSediTypeId = $model->profilo_sedi_type_id;
if ($model->isNewRecord && (count($types) == 1)) {
    $typeIds = array_keys($types);
    $profiloSediTypeId = reset($typeIds);
}

/** @var Module $organizzazioniModule */
$organizzazioniModule = Yii::$app->getModule(Module::getModuleName());

?>

<div class="profilo-sedi-form col-xs-12 nop">
    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data', // To load images
            'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
    ]); ?>
    <?php $this->beginBlock('general'); ?>
    <div class="row">
        <div class="col-lg-8 col-sm-8">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4 col-sm-4 hidden">
            <?= $form->field($model, 'profilo_sedi_type_id')->widget(Select::className(), [
                'data' => $types,
                'options' => [
                    'lang' => substr(Yii::$app->language, 0, 2),
                    'multiple' => false,
                    'placeholder' => Module::t('amosorganizzazioni', 'Select/Chooes') . '...',
                    'value' => 2,
                    'class' => 'hidden'
                ]
            ])->label($model->getAttributeLabel('profiloSediType')) ?>
        </div>
    </div>
    <div class="row">
        <?php if (!$organizzazioniModule->oldStyleAddressEnabled): ?>
            <div class="col-xs-12">
                <?= $form->field($model, 'address')->widget(
                    PlaceWidget::className(), [
                        'placeAlias' => 'sedeIndirizzo'
                    ]
                ); ?>
            </div>
        <?php else: ?>
            <?= $this->render('@vendor/arter/amos-organizzazioni/src/views/profilo-sedi/_old_style_address_fields', ['form' => $form, 'modelSedi' => $model]); ?>
        <?php endif; ?>
    </div>
    <div class="clearfix"></div>
    <?php $this->endBlock(); ?>

    <?php $itemsTab[] = [
        'label' => Module::t('amosorganizzazioni', 'Generale'),
        'content' => $this->blocks['general'],
    ];
    ?>

    <?= Tabs::widget([
        'encodeLabels' => false,
        'items' => $itemsTab
    ]); ?>

    <?= RequiredFieldsTipWidget::widget() ?>
    <?= CloseSaveButtonWidget::widget([
        'model' => $model,
        'urlClose' => ['/organizzazioni/profilo/update', 'id' => $model->profilo_id],
        'closeButtonLabel' => Module::t('amosorganizzazioni', '#go_back')
    ]); ?>
    <?php ActiveForm::end(); ?>
</div>
