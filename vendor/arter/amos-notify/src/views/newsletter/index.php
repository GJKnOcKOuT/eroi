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
 * @package    arter\amos\notificationmanager\views\newsletter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\views\DataProviderView;
use arter\amos\notificationmanager\AmosNotify;
use arter\amos\notificationmanager\assets\NotifyAsset;
use arter\amos\notificationmanager\models\Newsletter;
use arter\amos\notificationmanager\widgets\SendNewsletterWidget;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\notificationmanager\models\search\NewsletterSearch $model
 * @var string $currentView
 */

$this->params['breadcrumbs'][] = $this->title;

NotifyAsset::register($this);

$loggedUserIsNewsletterAdminstrator = \Yii::$app->user->can('NEWSLETTER_ADMINISTRATOR');

?>
<div class="newsletter-index">
    <?= $this->render('_search', ['model' => $model]); ?>
    <?= DataProviderView::widget([
        'dataProvider' => $dataProvider,
        'currentView' => $currentView,
        'gridView' => [
            'columns' => [
                'subject',
                'created_at:datetime',
                [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        /** @var Newsletter $model */
                        return $model->getWorkflowStatusLabel();
                    }
                ],
                'send_date_begin:datetime',
                'send_date_end:datetime',
                [
                    'label' => AmosNotify::t('amosnotify', '#total_contents'),
                    'value' => 'totalContentsCount',
                ],
                [
                    'label' => AmosNotify::t('amosnotify', '#can_be_sent') . '?',
                    'format' => 'raw',
                    'value' => function ($model) {
                        /** @var Newsletter $model */
                        if ($model->checkAllContentsPublished()) {
                            return Html::tag('span', BaseAmosModule::t('amoscore', 'Yes'), [
                                'class' => 'newsletter-can-be-sent'
                            ]);
                        } else {
                            return Html::tag('span', BaseAmosModule::t('amoscore', 'No'), [
                                'class' => 'newsletter-cannot-be-sent',
                                'title' => AmosNotify::t('amosnotify', '#check_newsletter')
                            ]);
                        }
                    }
                ],
                [
                    'class' => 'arter\amos\core\views\grid\ActionColumn',
                    'template' => '{reSendNewsletter}{sendNewsletter}{sendTestNewsletter}{stopSendNewsletter}{view}{update}{delete}',
                    'beforeRenderParent' => function ($model, $key, $index, $caller) {
                        return [
                            'allContentsPublished' => $model->checkAllContentsPublished(),
                            'userCanUpdateThisNewsletter' => $model->userCanUpdateThisNewsletter(),
                        ];
                    },
                    'buttons' => [
                        'sendTestNewsletter' => function ($url, $model, $key) {
                            /** @var \arter\amos\notificationmanager\models\Newsletter $model */
                            $btn = '';
                            $beforeRenderParentRes = ($key['beforeRenderParentRes']['allContentsPublished'] &&
                                $key['beforeRenderParentRes']['userCanUpdateThisNewsletter']);
                            if ($model->isDraftNewsletter() && $beforeRenderParentRes) {
                                $btn = SendNewsletterWidget::widget([
                                    'model' => $model,
                                    'buttonType' => SendNewsletterWidget::BTN_SEND_TEST_NEWSLETTER
                                ]);
                            }
                            return $btn;
                        },
                        'sendNewsletter' => function ($url, $model, $key) {
                            /** @var \arter\amos\notificationmanager\models\Newsletter $model */
                            $btn = '';
                            $beforeRenderParentRes = ($key['beforeRenderParentRes']['allContentsPublished'] &&
                                $key['beforeRenderParentRes']['userCanUpdateThisNewsletter']);
                            if ($model->isDraftNewsletter() && $beforeRenderParentRes) {
                                $btn = SendNewsletterWidget::widget([
                                    'model' => $model,
                                    'buttonType' => SendNewsletterWidget::BTN_SEND_NEWSLETTER
                                ]);
                            }
                            return $btn;
                        },
                        'reSendNewsletter' => function ($url, $model, $key) {
                            /** @var \arter\amos\notificationmanager\models\Newsletter $model */
                            $btn = '';
                            $beforeRenderParentRes = ($key['beforeRenderParentRes']['allContentsPublished'] &&
                                $key['beforeRenderParentRes']['userCanUpdateThisNewsletter']);
                            if ($model->isSentNewsletter() && $beforeRenderParentRes) {
                                $btn = SendNewsletterWidget::widget([
                                    'model' => $model,
                                    'buttonType' => SendNewsletterWidget::BTN_RE_SEND_NEWSLETTER
                                ]);
                            }
                            return $btn;
                        },
                        'stopSendNewsletter' => function ($url, $model, $key) use ($loggedUserIsNewsletterAdminstrator) {
                            /** @var \arter\amos\notificationmanager\models\Newsletter $model */
                            $btn = '';
                            if (($model->isWaitSendNewsletter() || $model->isWaitReSendNewsletter()) &&
                                $loggedUserIsNewsletterAdminstrator && $key['beforeRenderParentRes']['allContentsPublished']
                            ) {
                                $btn = SendNewsletterWidget::widget([
                                    'model' => $model,
                                    'buttonType' => SendNewsletterWidget::BTN_STOP_SEND_NEWSLETTER
                                ]);
                            }
                            return $btn;
                        }
                    ]
                ]
            ]
        ]
    ]); ?>
</div>
