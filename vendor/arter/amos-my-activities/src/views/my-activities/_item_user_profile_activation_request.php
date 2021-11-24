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
use arter\amos\admin\widgets\UserCardWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\utilities\ModalUtility;
use arter\amos\myactivities\AmosMyActivities;

/** @var $model \arter\amos\myactivities\basic\WaitingContacts */

?>
<div class="wrap-activity">
    <div class="col-md-1 col-xs-2 icon-plugin">
        <?= AmosIcons::show('users', [], 'dash') ?>
    </div>
    <div class="col-md-3 col-xs-5 wrap-user">
        <?= UserCardWidget::widget(['model' => $model]) ?>
        <span class="user"><?= $model->getNomeCognome() ?></span>
        <br>
        <?= AmosAdmin::t('amosadmin', $userProfile->workflowStatus->label) ?>
    </div>
    <div class="col-md-5 col-xs-5 wrap-report">
        <div class="col-lg-12 col-xs-12">
            <strong><?= AmosMyActivities::t('amosmyactivities', 'User reactivation request'); ?></strong>
        </div>
        <div class="col-lg-12 col-xs-12">
            <?= Yii::$app->formatter->asDatetime($model->userProfileReactivationRequest->updated_at) ?>
        </div>
        <div class="col-lg-12 col-xs-12">
            <?= AmosMyActivities::t('amosmyactivities', '#message') . ': ' ?><?= $model->userProfileReactivationRequest->message ?>
        </div>
        <div class="col-lg-12 col-xs-12">
            <?php /** @var \arter\amos\core\interfaces\ViewModelInterface $model */ ?>
            <?= Html::a(AmosIcons::show('search', [], 'dash') . ' <span>' . AmosMyActivities::t('amosmyactivities',
                    'View card') . '</span>', $model->getFullViewUrl()
//            Yii::$app->urlManager->createUrl([
//                '/community/community/view',
//                'id' => $model->id
//            ])
            ) ?>
        </div>
    </div>
    <div class="col-md-3 col-xs-12 wrap-action">
        <?= ModalUtility::addConfirmRejectWithModal([
            'modalId' => 'validate-user-profile-modal-id-' . $model->id,
            'modalDescriptionText' => AmosMyActivities::t('amosmyactivities', '#ACTIVATE_USER_PROFILE'),
            'btnText' => AmosIcons::show('check') . ' ' . AmosMyActivities::t('amosmyactivities', 'Activate'),
            'btnLink' => Yii::$app->urlManager->createUrl([
                '/admin/user-profile/reactivate-account',
                'id' => $model->id
            ]),
            'btnOptions' => [
                'class' => 'btn btn-primary'
            ]
        ]); ?>
        <?php echo ModalUtility::addConfirmRejectWithModal([
            'modalId' => 'reject-user-profile-modal-id-' . $model->id,
            'modalDescriptionText' => AmosMyActivities::t('amosmyactivities', '#REJECT_USER_PROFILE_MODAL_TEXT'),
            'btnText' => AmosIcons::show('close') . ' ' . AmosMyActivities::t('amosmyactivities', 'Reject'),
            'btnLink' => Yii::$app->urlManager->createUrl([
                '/admin/user-profile/reject-reactivation-request',
                'id' => $model->id
            ]),
            'btnOptions' => [
                'class' => 'btn btn-secondary'
            ]
        ]); ?>
    </div>
</div>
<hr>
