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
 * @package    arter\amos\best\practice\views\bestpractice
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\attachments\components\AttachmentsInput;
use arter\amos\attachments\components\AttachmentsList;
use arter\amos\best\practice\models\BestPractice;
use arter\amos\best\practice\Module;
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\core\forms\RequiredFieldsTipWidget;
use arter\amos\core\forms\TextEditorWidget;
use arter\amos\core\helpers\Html;
use arter\amos\workflow\widgets\WorkflowTransitionButtonsWidget;
use arter\amos\workflow\widgets\WorkflowTransitionStateDescriptorWidget;

/**
 * @var yii\web\View $this
 * @var arter\amos\best\practice\\models\Bestpractice $model
 * @var yii\widgets\ActiveForm $form
 */
$dateErrorMessage = Module::t('error', "Controllare data");

$todayDate = date('d-m-Y');
$tomorrowDate = (new DateTime('tomorrow'))->format('d-m-Y');


$js2 = <<<JS
    $(document).ready(function () {

        if($("#news_categorie_id-id option").length == 2){
            $($("#news_categorie_id-id option").parent().parent().parent()).hide();
        }

    });

JS;

$this->registerJs($js2);
?>

<?php
$form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'] // important
]);
$customView = Yii::$app->getViewPath() . '/imageField.php';
?>

<?= WorkflowTransitionStateDescriptorWidget::widget([
    'form' => $form,
    'model' => $model,
    'workflowId' => BestPractice::BESTPRACTICE_WORKFLOW,
    'classDivIcon' => '',
    'classDivMessage' => 'message',
    'viewWidgetOnNewRecord' => false
]); ?>

<div class="news-form col-xs-12 nop">
    <div class="row">
        <div class="col-xs-12">
            <?=
            Html::tag('h2', Module::t('amosbestpractice', '#settings_general_title') .
                CreatedUpdatedWidget::widget(['model' => $model, 'isTooltip' => true]), ['class' => 'subtitle-form'])
            ?>
        </div>
        <div class="col-md-8 col-xs-12">
            <?=
            $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => Module::t('amosbestpractice', '#title_field')])
            ?>
            <?=
            $form->field($model, 'synthesis')->widget(TextEditorWidget::className(),
                [
                    'clientOptions' => [
                        'placeholder' => Module::t('amosbestpractice', 'Synthesis'),
                        'lang' => substr(Yii::$app->language, 0, 2)
                    ]
                ])
            ?>

            <?=
            $form->field($model, 'facilitator_text')->textInput(['maxlength' => true, 'placeholder' => Module::t('amosbestpractice', 'Facilitator_text')])
            ?>
            <?=
            $form->field($model, 'facilitator_organization_text')->textInput(['maxlength' => true, 'placeholder' => Module::t('amosbestpractice', 'Facilitator_organization_text')])
            ?>
            <?=
            $form->field($model, 'users_text')->textInput(['maxlength' => true, 'placeholder' => Module::t('amosbestpractice', 'Users Text')])
            ?>
            <?=
            $form->field($model, 'tr_doc_link')->textInput(['maxlength' => true, 'placeholder' => Module::t('amosbestpractice', '#tr_doc_link')])
            ?>

            <!--    </div>-->

            <div class="col-xs-12">
                <div class="col-xs-12 receiver-section">
                    <div class="tag-section">

                        <?php

                        $moduleTag = \Yii::$app->getModule('tag');
                        if (isset($moduleTag) && in_array(get_class($model), $moduleTag->modelsEnabled) && $moduleTag->behaviors) {
                            echo \arter\amos\tag\widgets\TagWidget::widget([
                                'model' => $model,
                                'attribute' => 'tagValues',
                                'form' => \yii\base\Widget::$stack[0]
                            ]);
                        }

                        ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="col-xs-12 attachment-section nop">
                <div class="col-xs-12">
                    <?= Html::tag('h2', Module::t('amosbestpractice', '#attachments_title')) ?>
                    <?=
                    $form->field($model, 'bestPracticeAttachments')->widget(AttachmentsInput::classname(),
                        [
                            'options' => [// Options of the Kartik's FileInput widget
                                'multiple' => true, // If you want to allow multiple upload, default to false
                            ],
                            'pluginOptions' => [// Plugin options of the Kartik's FileInput widget
                                'maxFileCount' => 100, // Client max files
                                'showPreview' => false
                            ]
                        ])->label(Module::t('amosbestpractice', '#attachments_field'))->hint(Module::t('amosbestpractice',
                        '#attachments_field_hint'))
                    ?>

                    <?=
                    AttachmentsList::widget([
                        'model' => $model,
                        'attribute' => 'bestPracticeAttachments'
                    ])
                    ?>
                </div>
            </div>
        </div>

    </div>

    <div class="col-xs-12">
        <?= RequiredFieldsTipWidget::widget() ?>
        <?= CreatedUpdatedWidget::widget(['model' => $model]) ?>
    </div>
    <?php
    $statusToRenderToHide = $model->getStatusToRenderToHide();
    ?>
    <?=
    WorkflowTransitionButtonsWidget::widget([
        'form' => $form,
        'model' => $model,
        'workflowId' => BestPractice::BESTPRACTICE_WORKFLOW,
        'viewWidgetOnNewRecord' => true,
        'closeButton' => Html::a(Module::t('amosbestpractice', 'Annulla'), Yii::$app->session->get('previousUrl'), ['class' => 'btn btn-secondary']),
        'initialStatusName' => "DRAFT",
        'initialStatus' => BestPractice::BESTPRACTICE_WORKFLOW_STATUS_DRAFT,
        'statusToRender' => $statusToRenderToHide['statusToRender'],
        //POII-1147 gli utenti validatore/facilitatore o ADMIN possono sempre salvare la news => parametro a false
        //altrimenti se stato VALIDATO => pulsante salva nascosto
        'hideSaveDraftStatus' => $statusToRenderToHide['hideDraftStatus'],
        'draftButtons' => [
            BestPractice::BESTPRACTICE_WORKFLOW_STATUS_TOVALIDATE => [
                'button' => Html::submitButton(Module::t('amosbestpractice', 'save'), ['class' => 'btn btn-workflow']),
                'description' => 'le modifiche e mantieni la best practice in "richiesta di pubblicazione"'
            ],
            BestPractice::BESTPRACTICE_WORKFLOW_STATUS_VALIDATED => [
                'button' => Html::submitButton(Module::t('amosbestpractice', 'save'), ['class' => 'btn btn-workflow']),
                'description' => Module::t('amosbestpractice', 'le modifiche e mantieni la best practice "pubblicata"'),
            ],
            'default' => [
                'button' => Html::submitButton(Module::t('amosbestpractice', 'save draft'), ['class' => 'btn btn-workflow']),
                'description' => Module::t('amosbestpractice', 'potrai richiedere la pubblicazione in seguito'),
            ]
        ]
    ]);
    ?>
</div>
<?php ActiveForm::end(); ?>
