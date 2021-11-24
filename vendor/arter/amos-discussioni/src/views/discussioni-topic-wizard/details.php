<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\discussioni\views\discussioni-topic-wizard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\attachments\components\AttachmentsInput;
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\WizardPrevAndContinueButtonWidget;
use arter\amos\discussioni\AmosDiscussioni;
use yii\redactor\widgets\Redactor;

/**
 * @var yii\web\View $this
 * @var arter\amos\discussioni\models\DiscussioniTopic $model
 * @var yii\widgets\ActiveForm $form
 */

$this->title = AmosDiscussioni::t('amosdiscussioni', '#discussions_wizard_page_title');

?>

<div class="discussioni-topic-wizard-details">
    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'discussioni-topic-wizard-form',
            'class' => 'form',
            'enctype' => 'multipart/form-data', // To load images
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
    ]); ?>
    <?= $form->errorSummary($model, ['class' => 'alert-danger alert fade in', 'role' => 'alert']); ?>
    <section>
        <div class="row">
            <div class="col-lg-8 col-sm-8">
                <?= $form->field($model, 'titolo')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4 col-sm-4">
                <div class="col-lg-8 col-sm-8 pull-right">
                    <?= $form->field($model, 'discussionsTopicImage')->widget(AttachmentsInput::classname(), [
                        'options' => [
                            'multiple' => false,
                            'accept' => "image/*",
                        ],
                        'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget
                            'maxFileCount' => 1, // Client max files
                            'showRemove' => false,
                            'indicatorNew' => false,
                            'allowedPreviewTypes' => ['image'],
                            'previewFileIconSettings' => false,
                            'overwriteInitial' => false,
                            'layoutTemplates' => false
                        ]
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <?= $form->field($model, 'testo')->widget(Redactor::className(), [
                    'clientOptions' => [
                        'placeholder' => AmosDiscussioni::t('amosdiscussioni', '#discussions_text_placeholder'),
                        'buttonsHide' => [
                            'image',
                            'file'
                        ],
                        'lang' => substr(Yii::$app->language, 0, 2)
                    ]
                ]) ?>
            </div>
        </div>
        <div class="col-xs-12 note_asterisk nop">
            <p><?= AmosDiscussioni::t('amosdiscussioni', 'I campi') ?> <span class="red">*</span> <?= AmosDiscussioni::t('amosdiscussioni', 'sono obbligatori') ?>.</p>
        </div>
    </section>
    
    <?= WizardPrevAndContinueButtonWidget::widget([
        'model' => $model,
        'previousUrl' => Yii::$app->getUrlManager()->createUrl(['/discussioni/discussioni-topic-wizard/introduction', 'id' => $model->id]),
        'cancelUrl' => Yii::$app->session->get(AmosDiscussioni::beginCreateNewSessionKey())
    ]) ?>
    <?php ActiveForm::end(); ?>
</div>
