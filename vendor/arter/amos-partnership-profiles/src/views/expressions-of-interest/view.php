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
 * @package    arter\amos\partnershipprofiles\views\expressions-of-interest
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\helpers\Html;
use arter\amos\partnershipprofiles\controllers\ExpressionsOfInterestController;
use arter\amos\partnershipprofiles\models\ExpressionsOfInterest;
use arter\amos\partnershipprofiles\Module;
use arter\amos\workflow\widgets\WorkflowTransitionButtonsWidget;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var arter\amos\partnershipprofiles\models\ExpressionsOfInterest $model
 */

$this->title = Module::t('amospartnershipprofiles', '#view_expr_of_int');
$this->params['breadcrumbs'][] = $this->title;

/** @var ExpressionsOfInterestController $appController */
$appController = Yii::$app->controller;

?>

<?php $form = ActiveForm::begin([
    'options' => [
        'id' => Yii::$app->controller->id . '_' . ((isset($fid)) ? $fid : 0),
        'data-fid' => (isset($fid)) ? $fid : 0,
        'data-field' => ((isset($dataField)) ? $dataField : ''),
        'data-entity' => ((isset($dataEntity)) ? $dataEntity : ''),
        'class' => ((isset($class)) ? $class : ''),
        'errorSummaryCssClass' => 'error-summary alert alert-error'
    ]
]);
?>
<?php
if ($model->status != ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_RELEVANT) {
    echo \arter\amos\workflow\widgets\WorkflowTransitionStateDescriptorWidget::widget([
        'model' => $model,
        'workflowId' => ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW,
        'classDivMessage' => 'message'
    ]);
}
?>

<div class="<?= Yii::$app->controller->id ?>-view col-xs-12">
    <?= $this->render('parts/partnership_profile_title', ['model' => $model]) ?>
    <?= ContextMenuWidget::widget([
        'model' => $model,
        'actionModify' => '/partnershipprofiles/expressions-of-interest/update?id=' . $model->id,
        'actionDelete' => '/partnershipprofiles/expressions-of-interest/delete?id=' . $model->id,
        'mainDivClasses' => 'm-t-0 m-b-15'
    ]) ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    /** @var ExpressionsOfInterest $model */
                    return $model->getWorkflowStatusLabel();
                }
            ],
            'partnership_offered:html',
            'additional_information:html',
            'clarifications:html',
            'user_network_reference' => [
                'label' => $model->getAttributeLabel('userNetworkReference'),
                'value' => function ($model) {
                    /** @var ExpressionsOfInterest $model */
                    $user_network_reference_classname = $model->user_network_reference_classname;
                    if (!empty($user_network_reference_classname)) {
                        $record = $user_network_reference_classname::findOne($model->user_network_reference_id);
                        if (!empty($record)) {
                            return $record->name;
                        }
                    }
                    return '';
                }
            ]
        ]
    ]) ?>
    <?= WorkflowTransitionButtonsWidget::widget([
        'form' => $form,
        'model' => $model,
        'workflowId' => ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW,
        'viewWidgetOnNewRecord' => true,
        'closeButton' => Html::a(Module::t('amospartnershipprofiles', 'Annulla'), $appController->getViewCloseUrl(), ['class' => 'btn btn-secondary']),
        'initialStatusName' => "DRAFT",
        'initialStatus' => ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_DRAFT,
    ]); ?>
    <?php ActiveForm::end(); ?>
</div>
