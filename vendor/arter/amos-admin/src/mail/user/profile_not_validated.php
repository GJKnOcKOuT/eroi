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
 * @package    arter\amos\notificationmanager\views\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\cwh\base\ModelContentInterface;
use arter\amos\notificationmanager\AmosNotify;
use arter\amos\core\helpers\Html;
 if(!empty($validator)) {
    $this->params['profile'] = $validator;
}
?>

<div>

    <div style="box-sizing:border-box;color:#000000;">
        <div style="padding:5px 10px;background-color: #F2F2F2;text-align:center;">
            <h1 style="color:#297A38;font-size:1.5em;margin:0;">
                <?= AmosNotify::t('amosnotify', '#validated_email_1') . ' ' . $model->getGrammar()->getArticleSingular() . ' ' . $model->getGrammar()->getModelSingularLabel() ?>
            </h1>
        </div>
    </div>
    <div style="border:1px solid #cccccc;padding:10px;margin-bottom: 10px;background-color: #ffffff;margin-top: 20px;">
        <div>
            <h2 style="font-size:2em;line-height: 1;"><?= Html::a($model->getTitle(), \Yii::$app->urlManager->createAbsoluteUrl($model->getFullViewUrl()), ['style' => 'color: #297A38;']) ?></h2>
        </div>
        <div style="box-sizing:border-box;">
            <div style="box-sizing:border-box;padding:0;font-weight:bold;color:#000000;font-weight: normal;">
                <?php
                if (!$model instanceof \arter\amos\admin\models\UserProfile) {
                    echo $model->getDescription(false);
                }
                ?>
            </div>
        </div>

       
        <div style="margin-top:20px; display: flex; padding: 10px;">
            <div
                style="width: 50px; height: 50px; overflow: hidden;-webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%;float: left;">
                <?php
                $layout = '{publisher}';
                if ($model instanceof ModelContentInterface) {
                    $layout = '{publisher}{publishingRules}{targetAdv}';
                }
                ?>
                <?php
                $user = $model->getCreatedUserProfile()->one();
                if(!is_null($user)) {
                    echo \arter\amos\admin\widgets\UserCardWidget::widget([
                        'model' => $user,
                        'onlyAvatar' => true,
                        'absoluteUrl' => true
                    ]);
                }
                ?>
            </div>

            <div style="margin-left: 20px;">
                <?= \arter\amos\core\forms\PublishedByWidget::widget([
                    'model' => $model,
                    'layout' => $layout,
                ]) ?>

                <div style="margin-top:20px; display: flex; padding: 10px;">
                    <div
                        style="width: 50px; height: 50px; overflow: hidden;-webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%;float: left;">
                        <?= \arter\amos\admin\widgets\UserCardWidget::widget([
                            'model' => $validator,
                            'onlyAvatar' => true,
                            'absoluteUrl' => true
                        ]) ?>
                    </div>

                    <div style="margin: 15px 0 0 20px;">
                        <?= AmosNotify::t('amosnotify', '#validated_by') . ' ' . $validator->nomeCognome ?>
                    </div>
                </div>

            </div>
        </div>

        <?php if(isset($comment)): ?>
            <h1 style="color:#297a38;font-size:1.3em;">
                <?= AmosNotify::t('amosnotify', '#with_comment') ?>
            </h1>
            <div style="box-sizing:border-box;padding:0;font-weight:bold;color:#000000;font-weight:normal">
                <?= $comment ?>
            </div>
        <?php endif; ?>
        <p><?= \Yii::t('app','Il Facilitatore di Staff Finlombarda <strong>{nomeCognomeValidator}</strong> ha validato il tuo profilo.<br> Da questo momento puoi contribuire alla creazione di contenuti in piattaforma.',[
                'nomeCognomeValidator'=> $validator->nomeCognome
            ])?></p>

        <p>
            <?= AmosNotify::t('amosnotify', '#validated_email_footer') ?>
        </p>

    </div>
</div>
