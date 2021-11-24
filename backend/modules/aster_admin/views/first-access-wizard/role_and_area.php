<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\admin\views\first-access-wizard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\controllers\FirstAccessWizardController;
use arter\amos\admin\models\UserProfileRole;
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\editors\Select;
use arter\amos\core\forms\WizardPrevAndContinueButtonWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use yii\web\View;

/**
 * @var \yii\web\View $this
 * @var \backend\modules\aster_admin\models\UserProfile $model
 */

/** @var FirstAccessWizardController $appController */
$appController = Yii::$app->controller;

$roleId = Html::getInputId($model, 'user_profile_role_id');
$otherRoleId = Html::getInputId($model, 'user_profile_role_other');

$js = "
$('#$roleId').on('change', function(event) {
    if ($(this).val() != " . UserProfileRole::OTHER . ") {
        $('#" . $otherRoleId . "').attr('disabled', true).val('');
        $('#" . $otherRoleId . "').hide();
    } else {
        $('#" . $otherRoleId . "').attr('disabled', false);
        $('#" . $otherRoleId . "').show();
    }
});

if($('#$roleId').val() == " . UserProfileRole::OTHER . ") {
    $('#" . $otherRoleId . "').show();
}

";

$this->registerJs($js, View::POS_READY);

$this->registerCss("
    #" . $otherRoleId . " {
        display:none;
    }
");

?>

<div class="first-access-wizard-role-and-area">
    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'first-access-wizard-form',
            'class' => 'form',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
    ]); ?>
    
    <?= $form->errorSummary($model, ['class' => 'alert-danger alert fade in', 'role' => 'alert']); ?>
    <?= $this->render('parts/header', ['model' => $model]) ?>

    <section>
        <div class="row">
            <div class="col-xs-12">
                <h4><?= AmosAdmin::t('amosadmin', '#faw_rea_text', [
                        'appName' => Yii::$app->name
                    ]) ?></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <?= $form->field($model, 'presentazione_personale')->limitedCharsTextArea([
                    'rows' => 6,
                    'readonly' => false,
                    'maxlength' => 600,
                    'placeholder' => AmosAdmin::t('amosadmin', 'Enter a more detailed professional introduction up to 600 characters') . '.'
                ])->label(AmosAdmin::t('amosadmin', 'Professional introduction'), ['class' => 'bold']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?= $form->field($model, 'user_profile_role_id', [
                    'template' => "{label}\n{hint}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}",
                ])->widget(Select::classname(), [
                    'options' => ['placeholder' => AmosAdmin::t('amosadmin', 'Select/Choose') . '...', 'disabled' => false],
                    'data' => $appController->getRoles()
                ])->label($model->getAttributeLabel('role') . ' ' . AmosIcons::show('lock', ['title' => AmosAdmin::t('amosadmin', '#confidential')]))
                    ->hint($model->getAttributeHint('role'), ['class' => 'text-danger clearfix bold']); ?>
                <?= $form->field($model, 'user_profile_role_other')->textInput([
                    'maxlength' => 255,
                    'readonly' => false,
                    'disabled' => ($model->user_profile_role_id != UserProfileRole::OTHER),
                    'placeholder' => AmosAdmin::t('amosadmin', 'Other Role')
                ])->label(false); ?>
            </div>
        </div>
    </section>
    
    <?= WizardPrevAndContinueButtonWidget::widget([
        'model' => $model,
        'previousUrl' => Yii::$app->getUrlManager()->createUrl(['/admin/first-access-wizard/introducing-myself'])
    ]) ?>
    <?php ActiveForm::end(); ?>

</div>
