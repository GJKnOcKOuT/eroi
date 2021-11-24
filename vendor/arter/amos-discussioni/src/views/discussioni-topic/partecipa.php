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
 * @package    arter\amos\discussioni\views\discussioni-topic
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\widgets\UserCardWidget;
use arter\amos\attachments\components\AttachmentsTableWithPreview;
use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\forms\ItemAndCardHeaderWidget;
use arter\amos\core\forms\PublishedByWidget;
use arter\amos\core\forms\ShowUserTagsWidget;
use arter\amos\core\forms\Tabs;
use arter\amos\core\helpers\Html;
use arter\amos\discussioni\AmosDiscussioni;
use arter\amos\core\views\toolbars\StatsToolbar;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\core\icons\AmosIcons;
use arter\amos\attachments\components\AttachmentsList;
use arter\amos\core\forms\InteractionMenuWidget;
use \arter\amos\discussioni\models\DiscussioniTopic;

/**
 * @var yii\web\View $this
 * @var arter\amos\discussioni\models\DiscussioniTopic $model
 * @var yii\widgets\ActiveForm $form
 */

$this->title = $model->titolo;
$this->params['breadcrumbs'][] = ['label' => Yii::$app->session->get('previousTitle'), 'url' => Yii::$app->session->get('previousUrl')];
$this->params['breadcrumbs'][] = $model->titolo;

if($model->status != DiscussioniTopic::DISCUSSIONI_WORKFLOW_STATUS_ATTIVA) {
    echo \arter\amos\workflow\widgets\WorkflowTransitionStateDescriptorWidget::widget([
        'model' => $model,
        'workflowId' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
        'classDivMessage' => 'message',
        'viewWidgetOnNewRecord' => true
    ]);
}

$module = \Yii::$app->getModule('discussioni');
?>

<div class="discussioni-topic-view col-xs-12 nop">
    <div class="col-md-8 col-xs-12">
        <div class="col-xs-12 header-widget nop">
            <?= ItemAndCardHeaderWidget::widget([
                    'model' => $model,
                    'publicationDateField' => 'created_at',
                    'showPrevalentPartnershipAndTargets' => true,
                ]
            ) ?>
            <?= ContextMenuWidget::widget([
                'model' => $model,
                'actionModify' => "/discussioni/discussioni-topic/update?id=" . $model->id,
                'actionDelete' => "/discussioni/discussioni-topic/delete?id=" . $model->id,
                'modelValidatePermission' => 'DiscussionValidate'
            ]) ?>
            <?= CreatedUpdatedWidget::widget(['model' => $model, 'isTooltip' => true]) ?>
            <?=
            \arter\amos\report\widgets\ReportFlagWidget::widget([
                'model' => $model,
            ])
            ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-8 col-xs-12">
        <div class="header col-xs-12 nop">
            <?php
            $url = '/img/img_default.jpg';
            if (!is_null($model->discussionsTopicImage)) {
                $url = $model->discussionsTopicImage->getUrl('original', false, true);
                ?>
                <?= Html::img($url, [
                    'class' => 'img-responsive',
                    'alt' => AmosDiscussioni::t('amosdiscussioni', 'Immagine della discussione')
                ]); ?>
                <?php
            }
            ?>
            <div class="title col-xs-12">
                <h2 class="title-text"><?= $model->titolo ?></h2>
            </div>
        </div>
        <div class="text-content col-xs-12 nop">
            <?= $model->testo ?>
        </div>
        <div class="widget-body-content col-xs-12 nop">
          <?php
      echo \arter\amos\core\forms\editors\likeWidget\LikeWidget::widget([
          'model' => $model,
        ]);
      ?>
            <?= \arter\amos\report\widgets\ReportDropdownWidget::widget([
                'model' => $model
            ])
            ?>
            <?php $baseUrl = (!empty(\Yii::$app->params['platform']['backendUrl']) ? \Yii::$app->params['platform']['backendUrl'] : '') ?>
            <?= \arter\amos\core\forms\editors\socialShareWidget\SocialShareWidget::widget([
                'mode' => \arter\amos\core\forms\editors\socialShareWidget\SocialShareWidget::MODE_DROPDOWN,
                'configuratorId' => 'socialShare',
                'model' => $model,
                'url' => \yii\helpers\Url::to($baseUrl . '/discussioni/discussioni-topic/public?id=' . $model->id, true),
                'title' => $model->titolo,
                'description' => $model->getDescription(true),
//                'imageUrl'      => !empty($model->getDiscussionsTopicImage()) ? $model->getDiscussionsTopicImage()->getWebUrl('square_small') : '',
            ]); ?>
        </div>
        
        <?php if ((isset($module->disableComments) && $module->disableComments) && $model->close_comment_thread): ?>
        <div class="closed-label col-xs-12">
                <?= AmosDiscussioni::t('amosdiscussioni', '#discussion_closed') ?>
        </div>
        <?php endif; ?>
        
    </div>
    <div class="col-md-4 col-xs-12 nop">
        <div class="col-xs-12 attachment-section-sidebar nop" id="section-attachments">
            <?= Html::tag('h2', AmosIcons::show('paperclip', [], 'dash') . AmosDiscussioni::t('amosdiscussioni', '#attachments_title')) ?>
            <div class="col-xs-12">
                <?= AttachmentsList::widget([
                    'model' => $model,
                    'attribute' => 'discussionsAttachments',
                    'viewDeleteBtn' => false,
                    'viewDownloadBtn' => true,
                    'viewFilesCounter' => true,
                ]) ?>
            </div>
        </div>
        <div class="tags-section-sidebar col-xs-12 nop" id="section-tags">
            <?= Html::tag('h2', AmosIcons::show('tag', [], 'dash') . AmosDiscussioni::t('amosdiscussioni', '#tags_title')) ?>
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
