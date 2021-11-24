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
 * @package    arter\amos\comments\views\comment\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\interfaces\BaseContentModelInterface;
use arter\amos\core\interfaces\ViewModelInterface;
use arter\amos\cwh\base\ModelContentInterface;

/**
 * @var \arter\amos\core\record\Record $contextModel
 * @var \arter\amos\core\record\Record $model
 * @var \arter\amos\core\record\Record $model_reply
 */

if (!empty($user)) {
    $this->params['profile'] = $user->userProfile;
}

$link = '#comments_anchor';
$linkText = $contextModel->__toString();
$description = '-';

if (($contextModel instanceof BaseContentModelInterface) || $contextModel->hasMethod('getTitle')) {
    $linkText = $contextModel->getTitle();
}

if ($contextModel instanceof ViewModelInterface) {
    $link = \Yii::$app->urlManager->createAbsoluteUrl($contextModel->getFullViewUrl()) . "#comments_anchor";
}

if (($contextModel instanceof BaseContentModelInterface) || $contextModel->hasMethod('getDescription')) {
    $description = $contextModel->getDescription(true);
}

?>
<div style="border:1px solid #cccccc;padding:10px;margin-bottom: 10px;background-color: #ffffff;margin-top:20px">
    <div style="color:#000000;">
        <h2 style="font-size:2em;line-height: 1;margin:0;padding:10px 0;">
            <?= Html::a($linkText, $link, ['style' => 'color: green;']); ?>
        </h2>
    </div>

    <div style="box-sizing:border-box;font-size:13px;font-weight:normal;">
        <?= $description; ?>
    </div>
    <div style="box-sizing:border-box;padding-bottom: 5px;color:#000000;">
        <div style="margin-top:20px;">
            <div style="display: flex;width: 100%;">
                <div style="width: 50px; height: 50px; overflow: hidden;-webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%;float: left;">
                    <?php
                    $layout = '{publisher}';
                    if ($model instanceof ModelContentInterface) {
                        $layout = '{publisher}{publishingRules}{targetAdv}';
                    }
                    ?>
                    <?php if ($model->getCreatedUserProfile() != null): ?>
                        <?= \arter\amos\admin\widgets\UserCardWidget::widget([
                            'model' => $model->getCreatedUserProfile()->one(),
                            'onlyAvatar' => true,
                            'absoluteUrl' => true
                        ])
                        ?>
                    <?php endif; ?>
                </div>

                <div style="margin-left: 20px;">
                    <?= \arter\amos\core\forms\PublishedByWidget::widget([
                        'model' => $model,
                        'modelContext' => $contextModel,
                        'layout' => $layout,
                    ]) ?>
                    <span style="font-weight:normal;"><?= $model->comment_text ?></span>

                    <?php if ($model_reply) { ?>
                        <div style="box-sizing:border-box;padding-bottom: 5px;">
                            <div style="margin-top:20px;">
                                <div style="display: flex;width: 100%;">
                                    <div style="width: 50px; height: 50px; overflow: hidden;-webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%;float: left;">
                                        <?php
                                        $layout = '{publisher}';
                                        if ($model_reply instanceof ModelContentInterface) {
                                            $layout = '{publisher}{publishingRules}{targetAdv}';
                                        }
                                        $modelReplyCreatedUserProfile = $model_reply->createdUserProfile;
                                        ?>
                                        <?php if ($modelReplyCreatedUserProfile != null): ?>
                                            <?= \arter\amos\admin\widgets\UserCardWidget::widget([
                                                'model' => $modelReplyCreatedUserProfile,
                                                'onlyAvatar' => true,
                                                'absoluteUrl' => true
                                            ])
                                            ?>
                                        <?php endif; ?>
                                    </div>
                                    <div style="margin-left: 20px;">
                                        <?= \arter\amos\core\forms\PublishedByWidget::widget([
                                            'model' => $model_reply,
                                            'layout' => $layout,
                                        ]) ?>
                                        <span style="font-weight:normal;"><p><?= $model_reply->comment_reply_text ?></p></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
