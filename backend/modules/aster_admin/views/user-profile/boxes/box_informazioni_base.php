<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\admin\views\user-profile\boxes
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\base\ConfigurationManager;
use kartik\datecontrol\DateControl;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var arter\amos\core\forms\ActiveForm $form
 * @var arter\amos\admin\models\UserProfile $model
 * @var arter\amos\core\user\User $user
 * @var string $idTabInsights
 */

/** @var AmosAdmin $adminModule */
$adminModule = Yii::$app->controller->module;

$js = "
$('#extended-presentation-link').click(function(event) {
    event.preventDefault();
    $('a[href=\"' + $(this).attr('href') + '\"]').tab('show');
});
";
$this->registerJs($js, View::POS_READY);
?>

<section>
    <div class="row">
        <?php if ($adminModule->confManager->isVisibleField('nome', ConfigurationManager::VIEW_TYPE_FORM)): ?>
            <div class="col-xs-12 col-md-6">
                <?= $form->field($model, 'nome')->textInput(['maxlength' => 255, 'readonly' => false]) ?>
            </div>
        <?php endif; ?>
        <?php if ($adminModule->confManager->isVisibleField('cognome', ConfigurationManager::VIEW_TYPE_FORM)): ?>
            <div class="col-xs-12 col-md-6">
                <?= $form->field($model, 'cognome')->textInput(['maxlength' => 255, 'readonly' => false]) ?>
            </div>
        <?php endif; ?>
        <?php if ($adminModule->confManager->isVisibleField('nascita_data', ConfigurationManager::VIEW_TYPE_FORM)): ?>
            <div class="col-lg-6 col-sm-6">
                <?= $form->field($model, 'nascita_data')->widget(DateControl::classname(), [
                    'autoWidget' => false,
                    'type' => DateControl::FORMAT_DATE,
                    'widgetOptions' => [
                        'mask' => '99-99-9999',
                    ],
                    'options' => [
                        'disabled' => false,
                    ],
                    'saveOptions' => [
                        'type' => 'text',
                        'class' => 'sr-only',
                        'label' => '<label for="nascita_data-disp" class="sr-only">' . AmosAdmin::t('amosadmin', 'Born Date') . '</label>'
                    ]
                ]); ?>
            </div>
        <?php endif; ?>
    </div>
    <?php if ($adminModule->confManager->isVisibleField('presentazione_breve', ConfigurationManager::VIEW_TYPE_FORM)): ?>
        <div class="row">
            <div class="col-xs-12 m-b-20">

                <?= $form->field($model, 'presentazione_breve')->limitedCharsTextArea([
                    'rows' => 6,
                    'readonly' => false,
                    'placeholder' => AmosAdmin::t('amosadmin', '#short_presentation_placeholder'),
                    'maxlength' => 140
                ]); ?>
            </div>
        </div>
    <?php endif; ?>
</section>
