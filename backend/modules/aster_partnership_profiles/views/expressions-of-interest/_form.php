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
 * @package    backend\modules\aster_partnership_profiles\views\expressions-of-interest
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\core\forms\editors\Select;
use arter\amos\core\forms\RequiredFieldsTipWidget;
use arter\amos\core\helpers\Html;
use arter\amos\partnershipprofiles\controllers\ExpressionsOfInterestController;
use arter\amos\partnershipprofiles\models\ExpressionsOfInterest;
use arter\amos\partnershipprofiles\Module;
use arter\amos\partnershipprofiles\utility\ExpressionsOfInterestUtility;
use arter\amos\workflow\widgets\WorkflowTransitionButtonsWidget;
use arter\amos\workflow\widgets\WorkflowTransitionStateDescriptorWidget;
use yii\redactor\widgets\Redactor;

/**
 * @var yii\web\View $this
 * @var arter\amos\partnershipprofiles\models\ExpressionsOfInterest $model
 * @var arter\amos\partnershipprofiles\models\PartnershipProfiles $partnershipProfile
 * @var yii\widgets\ActiveForm $form
 * @var string|null $fid
 */

// Tab ids
$idTabCard = 'tab-card';

/** @var ExpressionsOfInterestController $appController */
$appController = Yii::$app->controller;
$module = \Yii::$app->getModule('partnershipprofiles');
$onlyOneOrganization = $module->enableOnlyOneOrganization;

?>

<?php $form = ActiveForm::begin([
    'options' => [
        'id' => 'expressions-of-interest_' . ((isset($fid)) ? $fid : 0),
        'data-fid' => (isset($fid)) ? $fid : 0,
        'data-field' => ((isset($dataField)) ? $dataField : ''),
        'data-entity' => ((isset($dataEntity)) ? $dataEntity : ''),
        'class' => ((isset($class)) ? $class : ''),
        'enctype' => 'multipart/form-data', // To load images
        'errorSummaryCssClass' => 'error-summary alert alert-error'
    ]
]);
?>

<?= WorkflowTransitionStateDescriptorWidget::widget([
    'form' => $form,
    'model' => $model,
    'workflowId' => ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW,
    'classDivIcon' => '',
    'classDivMessage' => 'message',
    'viewWidgetOnNewRecord' => false
]);
?>

<div class="<?= Yii::$app->controller->id ?>-form col-xs-12 nop">
    <?php // $form->errorSummary($model, ['class' => 'alert-danger alert fade in']); ?>
    <?= $this->render('parts/partnership_profile_title', ['model' => $model]) ?>
    <div class="row">
        <div class="col-xs-12">
            <?= $form->field($model, 'partnership_offered')->widget(Redactor::className(), [
                'clientOptions' => [
                    'plugins' => ['clips', 'fontcolor', 'imagemanager'],
                    'buttonsHide' => [
                        'image',
                        'file'
                    ],
                    'lang' => substr(Yii::$app->language, 0, 2)
                ]
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?= $form->field($model, 'additional_information')->widget(Redactor::className(), [
                'clientOptions' => [
                    'plugins' => ['clips', 'fontcolor', 'imagemanager'],
                    'buttonsHide' => [
                        'image',
                        'file'
                    ],
                    'lang' => substr(Yii::$app->language, 0, 2)
                ]
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?= $form->field($model, 'clarifications')->widget(Redactor::className(), [
                'clientOptions' => [
                    'plugins' => ['clips', 'fontcolor', 'imagemanager'],
                    'buttonsHide' => [
                        'image',
                        'file'
                    ],
                    'lang' => substr(Yii::$app->language, 0, 2)
                ]
            ]) ?>
        </div>
    </div>
    <div class="clearfix"></div>
    
    <?= RequiredFieldsTipWidget::widget() ?>
    <?= CreatedUpdatedWidget::widget(['model' => $model]) ?>
    
    <?php
    $statusToRenderToHide = $model->getStatusToRenderToHide();
    ?>
    
    <?=
    WorkflowTransitionButtonsWidget::widget([
        'form' => $form,
        'model' => $model,
        'workflowId' => ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW,
        'viewWidgetOnNewRecord' => true,
        //'closeSaveButtonWidget' => CloseSaveButtonWidget::widget($config),
        'closeButton' => Html::a(Module::t('amospartnershipprofiles', 'Annulla'), \Yii::$app->session->get('previousUrl'), ['class' => 'btn btn-secondary']),
        'initialStatusName' => "DRAFT",
        'initialStatus' => ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_DRAFT,
        'statusToRender' => $statusToRenderToHide['statusToRender'],
        'hideSaveDraftStatus' => $statusToRenderToHide['hideDraftStatus'],
        'draftButtons' => [
            ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_TOVALIDATE => [
                'button' => Html::submitButton(Module::t('amospartnershipprofiles', 'Salva'), ['class' => 'btn btn-workflow']),
                'description' => 'le modifiche e mantieni la notizia in "richiesta di pubblicazione"'
            ],
            ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_RELEVANT => [
                'button' => \arter\amos\core\helpers\Html::submitButton(Module::t('amospartnershipprofiles', 'Salva'), ['class' => 'btn btn-workflow']),
                'description' => Module::t('amospartnershipprofiles', 'le modifiche e mantieni la soluzione "pubblicata"'),
            ],
            'default' => [
                'button' => Html::submitButton(Module::t('amospartnershipprofiles', 'Salva in bozza'), ['class' => 'btn btn-workflow']),
                'description' => Module::t('amospartnershipprofiles', 'potrai richiedere la pubblicazione in seguito'),
            ]
        ]
    ]);
    ?>
</div>
<?php ActiveForm::end(); ?>
