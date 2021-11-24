<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use arter\amos\attachments\components\AttachmentsList;
use arter\amos\attachments\components\AttachmentsTableWithPreview;
use arter\amos\best\practice\models\BestPractice;
use arter\amos\best\practice\Module;
use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\core\forms\ItemAndCardHeaderWidget;
use arter\amos\core\icons\AmosIcons;
use arter\amos\workflow\widgets\WorkflowTransitionStateDescriptorWidget;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var arter\amos\best\practice\models\BestPractice $model
 */

$this->title = $model->getTitle();

/** @var \arter\amos\best\practice\controllers\BestPracticeController $controller */
$controller = Yii::$app->controller;
$controller->setNetworkDashboardBreadcrumb();
$this->params['breadcrumbs'][] = $this->title;

if ($model->status != BestPractice::BESTPRACTICE_WORKFLOW_STATUS_VALIDATED) {
    echo WorkflowTransitionStateDescriptorWidget::widget([
        'model' => $model,
        'workflowId' => BestPractice::BESTPRACTICE_WORKFLOW,
        'classDivMessage' => 'message',
        'viewWidgetOnNewRecord' => true
    ]);
}

?>

<div class="news-view col-xs-12 nop">
    <div class="col-md-8 col-xs-12">
        <div class="col-xs-12 header-widget nop">
            <?= ItemAndCardHeaderWidget::widget([
                    'model' => $model,
                    'publicationDateField' => 'created_at'
                ]
            ) ?>
            <?= ContextMenuWidget::widget([
                'model' => $model,
                'actionModify' => $model->getFullUpdateUrl(),
                'actionDelete' => $model->getFullDeleteUrl(),
                'labelDeleteConfirm' => Module::t('amosbestpractice', 'Sei sicuro di voler cancellare questa best practice?'),
            ]) ?>
            <?= CreatedUpdatedWidget::widget(['model' => $model, 'isTooltip' => true]) ?>
            <?php
            $reportModule = \Yii::$app->getModule('report');
            if (isset($reportModule) && in_array($model->className(), $reportModule->modelsEnabled)) {
                echo \arter\amos\report\widgets\ReportFlagWidget::widget([
                    'model' => $model,
                ]);
            }
            ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-8 col-xs-12">
        <div class="header col-xs-12 nop">
            <div class="title col-xs-12">
                <h2 class="title-text"><?= $model->getTitle() ?></h2>
            </div>
        </div>
        <div class="text-content col-xs-12 nop">
            <?= $model->getDescription(false); ?>
        </div>
        <div class="post-footer col-xs-12 nop">
            <div class="post-info col-xs-12">
                <div class="published-by">
                    <div class="item">
                        <label><?= $model->getAttributeLabel('facilitator_text') ?>:</label> <?= ($model->facilitator_text ? $model->facilitator_text : ' - ') ?>
                    </div>
                    <div class="item">
                        <label><?= $model->getAttributeLabel('facilitator_organization_text') ?>:</label> <?= ($model->facilitator_organization_text ? $model->facilitator_organization_text : ' - ') ?>
                    </div>
                    <div class="item">
                        <label><?= $model->getAttributeLabel('users_text') ?>:</label> <?=($model->users_text ? $model->users_text : ' - ') ?>
                    </div>
                    <div class="item">
                        <label><?= $model->getAttributeLabel('tr_doc_link') ?>:</label> <?= ($model->tr_doc_link ? \arter\amos\core\helpers\Html::a($model->tr_doc_link, $model->tr_doc_link) : ' - ') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget-body-content col-xs-12 nop">
            <?php
            $reportModule = \Yii::$app->getModule('report');
            if (isset($reportModule) && in_array($model->className(), $reportModule->modelsEnabled)) {
                echo \arter\amos\report\widgets\ReportDropdownWidget::widget([
                    'model' => $model,
                ]);
            }
            ?>
            <?php
            echo \arter\amos\core\forms\editors\socialShareWidget\SocialShareWidget::widget([
                'mode' => \arter\amos\core\forms\editors\socialShareWidget\SocialShareWidget::MODE_DROPDOWN,
                'configuratorId' => 'socialShare',
                'model' => $model,
                'url' => \yii\helpers\Url::to(\Yii::$app->params['platform']['backendUrl'] . '/bestpractice/best-practice/view?id=' . $model->id, true),
                'title' => $model->title,
                'description' => $model->getDescription(false),
            ]);
            ?>
        </div>
    </div>
    <div class="col-md-4 col-xs-12">
        <div class="col-xs-12 attachment-section-sidebar nop" id="section-attachments">
            <?= Html::tag('h2', AmosIcons::show('paperclip',[],'dash') . Module::t('amosbestpractice', '#attachments_title')) ?>
            <div class="col-xs-12">
                <?= AttachmentsList::widget([
                    'model' => $model,
                    'attribute' => 'bestPracticeAttachments',
                    'viewDeleteBtn' => false,
                    'viewDownloadBtn' => true,
                    'viewFilesCounter' => true,
                ]) ?>
            </div>
        </div>
        <div class="tags-section-sidebar col-xs-12 nop" id="section-tags">
            <?= Html::tag('h2', AmosIcons::show('tag', [], 'dash') . Module::t('amosbestpractice', '#tags_title')) ?>
            <div class="col-xs-12">
                <?= \arter\amos\core\forms\ListTagsWidget::widget([
                    'userProfile' => $model->id,
                    'className' => $model->className(),
                    'viewFilesCounter' => true,
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
<?= Html::a(Module::t('amosbestpractice', '#go_back'), (\Yii::$app->request->referrer ?: \Yii::$app->session->get('previousUrl')), [
    'class' => 'btn btn-secondary pull-left m-b-10'
]) ?>
