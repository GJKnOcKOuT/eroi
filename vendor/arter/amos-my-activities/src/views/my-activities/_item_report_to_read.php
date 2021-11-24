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
 * @package    arter\amos\myactivities\views\my-activities
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserProfile;
use arter\amos\admin\widgets\UserCardWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\myactivities\AmosMyActivities;

/** @var $model \arter\amos\myactivities\basic\ReportToRead */

$userProfile = UserProfile::find()->andWhere(['user_id' => $model->updated_by])->one();
?>
<?php if (!empty($userProfile)): ?>
    <div class="wrap-activity">
        <div class="col-md-1 col-xs-2 icon-not-plugin">
            <?= AmosIcons::show('flag', [], 'dash') ?>
        </div>
        <div class="col-md-3 col-xs-5 wrap-user">
            <?= UserCardWidget::widget(['model' => $userProfile]) ?>
            <span class="user"><?= $userProfile->getNomeCognome() ?></span>
            <br>
            <?= AmosAdmin::t('amosadmin', $userProfile->workflowStatus->label) ?>
        </div>
        <div class="col-md-5 col-xs-5 wrap-report">
            <div class="col-lg-12 col-xs-12">
                <strong><?= AmosMyActivities::t('amosmyactivities', 'Reporting'); ?></strong>
            </div>
            <div class="col-lg-12 col-xs-12">
                <?= Yii::$app->formatter->asDatetime($model->getUpdatedAt()) ?>
            </div>
            <div class="col-lg-12 col-xs-12 m-t-10">
                <p class="user-report"><?= $userProfile->getNomeCognome() ?></p>
                <?= AmosMyActivities::t('amosmyactivities', ' sent this report'); ?>:
                <?= $model->content ?>
            </div>
            <div class="col-lg-12 col-xs-12">
                <?php
                $url = null;
                if (Yii::$app->hasModule('news') && ($model->classname == \arter\amos\news\models\News::className())) {
                    $url = Yii::$app->urlManager->createUrl([
                        '/news/news/update',
                        'id' => $model->context_id,
                        '#' => 'tab-reports'
                    ]);
                }

                if (Yii::$app->hasModule('discussioni') && ($model->classname == \arter\amos\discussioni\models\DiscussioniTopic::className())) {
                    $url = Yii::$app->urlManager->createUrl([
                        '/discussioni/discussioni-topic/update',
                        'id' => $model->context_id,
                        '#' => 'tab-reports'
                    ]);
                }

                if (Yii::$app->hasModule('documenti') && ($model->classname == \arter\amos\documenti\models\Documenti::className())) {
                    $url = Yii::$app->urlManager->createUrl([
                        '/documenti/documenti/update',
                        'id' => $model->context_id,
                        '#' => 'tab-reports'
                    ]);
                }

                ?>

                <?= Html::a(AmosIcons::show('search', [], 'dash') . ' ' . AmosMyActivities::t('amosmyactivities',
                        'Vedi scheda'),
                    $url
                ) ?>
            </div>
        </div>
        <div class="col-md-3 col-xs-12 wrap-action">
            <?php
            echo Html::a(AmosIcons::show('check') . ' ' . AmosMyActivities::t('amosmyactivities',
                    'Reading confirmation'),
                Yii::$app->urlManager->createUrl([
                    '/report/report/read-confirmation',
                    'id' => $model->id,
                ]),
                [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'confirm' => AmosMyActivities::t('amosmyactivities', 'Do you really want to mark as read?')
                    ]
                ]
            )
            ?>
        </div>
    </div>
    <hr>
<?php endif; ?>
