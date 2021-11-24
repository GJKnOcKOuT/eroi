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
 * @package    arter\amos\comments\views\comment
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
use arter\amos\comments\AmosComments;
use arter\amos\comments\assets\CommentsAsset;
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\AttachmentsWidget;
use arter\amos\core\forms\CloseSaveButtonWidget;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\core\forms\TextEditorWidget;
use arter\amos\core\helpers\Html;

CommentsAsset::register($this);

/**
 * @var yii\web\View $this
 * @var arter\amos\comments\models\Comment $model
 * @var yii\widgets\ActiveForm $form
 * @var string $fid
 */
/** @var AmosComments $commentsModule */
$commentsModule = Yii::$app->getModule(AmosComments::getModuleName());
?>

<div class="comment-form col-xs-12 nop">
    <?php
    $form           = ActiveForm::begin([
            'options' => [
                'id' => 'comment_'.((isset($fid)) ? $fid : 0),
                'data-fid' => (isset($fid)) ? $fid : 0,
                'data-field' => ((isset($dataField)) ? $dataField : ''),
                'data-entity' => ((isset($dataEntity)) ? $dataEntity : ''),
                'class' => ((isset($class)) ? $class : ''),
                'enctype' => 'multipart/form-data'
            ]
    ]);
    ?>

    <div class="row">
        <?php if (!empty($no_attach)) { ?>
            <div class="col-lg-12 col-xs-12">
                <?=
                $form->field($model, 'comment_text')->widget(TextEditorWidget::className(),
                    [
                    'clientOptions' => [
                        'lang' => substr(Yii::$app->language, 0, 2)
                    ]
                ])
                ?>
            </div>
        <?php } else { ?>
            <div class="col-lg-8 col-xs-12">
                <?=
                $form->field($model, 'comment_text')->widget(TextEditorWidget::className(),
                    [
                    'clientOptions' => [
                        'lang' => substr(Yii::$app->language, 0, 2)
                    ]
                ])
                ?>
            </div>
            <div class="col-lg-4 col-xs-12">
                <?=
                AttachmentsWidget::widget([
                    'form' => $form,
                    'model' => $model,
                    'modelField' => 'commentAttachments',
                    'attachInputOptions' => [
                        'multiple' => true
                    ],
                    'attachInputPluginOptions' => [
                        'maxFileCount' => $commentsModule->maxCommentAttachments,
                        'showPreview' => false
                    ],
                ])
                ?>
            </div>
        <?php } ?>
    </div>

    <?php if ($commentsModule->enableUserSendMailCheckbox && (Yii::$app->controller->action->id == 'create')): ?>
        <div class="row">
            <div class="col-xs-12">
                <?=
                Html::checkbox('send-notify-mail', true,
                    ['label' => ' '.AmosComments::t('amoscomments', '#checkbox_send_notify')])
                ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="clearfix"></div>

    <?= CreatedUpdatedWidget::widget(['model' => $model]) ?>
    <?=
    CloseSaveButtonWidget::widget([
        'model' => $model,
        'urlClose' => (!empty($url) ? $url : \Yii::$app->request->referrer)]);
    ?>
    <?php ActiveForm::end(); ?>
</div>
