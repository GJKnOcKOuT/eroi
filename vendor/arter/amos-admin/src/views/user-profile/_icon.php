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
 * @package    arter\amos\admin\views\user-profile
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\base\ConfigurationManager;
use arter\amos\admin\widgets\ConnectToUserWidget;
use arter\amos\admin\widgets\SendMessageToUserWidget;
use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;

/**
 * @var yii\web\View $this
 * @var \arter\amos\admin\models\UserProfile $model
 */

$userId = $model->user_id;
/** @var \arter\amos\admin\controllers\UserProfileController $appController */
$appController = Yii::$app->controller;
$appController->setCwhScopeNetworkInfo($userId);

/** @var AmosAdmin $adminModule */
$adminModule = AmosAdmin::instance();

$nomeCognome = '';
if ($adminModule->confManager->isVisibleBox('box_informazioni_base', ConfigurationManager::VIEW_TYPE_VIEW)) {
    if ($adminModule->confManager->isVisibleField('nome', ConfigurationManager::VIEW_TYPE_VIEW)) {
        $nomeCognome .= $model->nome;
    }
    if ($adminModule->confManager->isVisibleField('cognome', ConfigurationManager::VIEW_TYPE_VIEW)) {
        $nomeCognome .= ' ' . $model->cognome;
    }
}

$viewUrl = "/admin/user-profile/view?id=" . $model->id;

$prevalentPartnershipTruncated = '';
$prevalentPartnershipName = '';
if (!is_null($model->prevalentPartnership)) {
    $prevalentPartnershipTruncated = $model->prevalentPartnership;
    $prevalentPartnershipName = $model->prevalentPartnership->name;
}

?>

<div class="card-container admin-card-container col-xs-12 nop">
    <div class="col-xs-12 nop icon-header">
        <?= ContextMenuWidget::widget([
            'model' => $model,
            'actionModify' => '/admin/user-profile/update?id=' . $model->id,
            'disableDelete' => true
        ]) ?>
        <?php if (($adminModule->confManager->isVisibleBox('box_foto', ConfigurationManager::VIEW_TYPE_VIEW)) &&
            ($adminModule->confManager->isVisibleField('userProfileImage', ConfigurationManager::VIEW_TYPE_VIEW))
        ): ?>
            <div class="container-round-img">
                <?php
                $url = $model->getAvatarUrl('card_users');
                Yii::$app->imageUtility->methodGetImageUrl = 'getAvatarUrl';
                $logoOptions = [
                    'class' => Yii::$app->imageUtility->getRoundImage($model)['class'],
                    //'style' => "margin-left: " . Yii::$app->imageUtility->getRoundImage($model)['margin-left'] . "%; margin-top: " . Yii::$app->imageUtility->getRoundImage($model)['margin-top'] . "%;",
                    'alt' => $model->getNomeCognome(),
                ];
                $options = [];
                if (strlen($nomeCognome) > 0) {
                    $logoOptions['alt'] = $nomeCognome;
                    $options['title'] = $nomeCognome;
                }
                $logo = Html::img($url, $logoOptions);
                ?>
                <?= Html::a($logo, $viewUrl, $options); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-xs-12 nop icon-body">
        <?= \arter\amos\notificationmanager\forms\NewsWidget::widget([
            'model' => $model,
            'css_class' => 'badge badge-left'
        ]); ?>
        <h3 class="title">
            <?= Html::a($model->getNomeCognome(), $viewUrl, ['title' => AmosAdmin::t('amosadmin', '#icon_name_title_link') . ' ' . $model->getNomeCognome(), 'data-gui' => 'icon-view-profiles']); ?>
        </h3>
        <?php
        if (
            ($adminModule->confManager->isVisibleBox('box_prevalent_partnership', ConfigurationManager::VIEW_TYPE_VIEW)) &&
            ($adminModule->confManager->isVisibleField('prevalent_partnership_id', ConfigurationManager::VIEW_TYPE_VIEW))
        ): ?>
            <div class="col-xs-12 nop">
                <span class="prevalent-partnership"><?= (!empty($prevalentPartnershipTruncated)) ? AmosIcons::show('briefcase', [], 'dash') . $prevalentPartnershipTruncated : ''; ?></span>
            </div>
        <?php endif; ?>
        <?php
        if (isset($this->params['role'])) {
            $role = $this->params['role'];
            echo Html::tag('p', $role);
        }
        if (isset($this->params['status'])) {
            $status = $this->params['status'];
            echo Html::tag('p', AmosAdmin::t('amosadmin', 'Status:') . ' ' . $status);
        }
        ?>

    </div>
    <div class="col-xs-12 nop icon-footer">
        <?php
        // draws google Icon if the userprofile is google contact of logged user
        $googleContactIcon = '';
        $googleContactIcon = \arter\amos\admin\widgets\GoogleContactWidget::widget(['model' => $model]);
        $googleContactTooltip = (!empty($googleContactIcon)) ? AmosAdmin::t('amosadmin', '#google_contact_tooltip') : '';

        $isValidated = '';
        if ($model->status == \arter\amos\admin\models\UserProfile::USERPROFILE_WORKFLOW_STATUS_VALIDATED) {
            $isValidated = AmosAdmin::t('amosadmin', 'Profile Validated');
        }
        $isFacilitator = '';
        if (
            ($adminModule->confManager->isVisibleBox('box_facilitatori', ConfigurationManager::VIEW_TYPE_VIEW)) &&
            ($adminModule->confManager->isVisibleField('facilitatore_id', ConfigurationManager::VIEW_TYPE_VIEW))
        ) {
            $facilitatorUserIds = Yii::$app->getAuthManager()->getUserIdsByRole("FACILITATOR");
            if (in_array($model->user_id, $facilitatorUserIds)) {
                $isFacilitator = AmosAdmin::t('amosadmin', 'Facilitator');
            }
        }
        $content = '';
        $content .= Html::tag('p', $isValidated);
        $content .= Html::tag('p', $isFacilitator);
        $content .= Html::tag('p', $googleContactTooltip);

//        if (!empty($isValidated) || !empty($isFacilitator)) {
//            echo Html::tag('div', AmosIcons::show('info-circle', [], 'dash'), [
//                'class' => 'amos-tooltip pull-left',
//                'data-toggle' => 'tooltip',
//                'data-html' => 'true',
//                'title' => $content
//            ]);
//        }

        ?>
        <?= $googleContactIcon; ?>
        <?php if (Yii::$app->user->id != $model->user_id): ?>
            <div class="col-xs-12 icon-btn-action">
                <?php if ($adminModule->enableUserContacts && !$adminModule->enableSendMessage): ?>
                    <?= ConnectToUserWidget::widget(['model' => $model, 'divClassBtnContainer' => '']) ?>
                <?php endif; ?>
                <?php if (!$adminModule->enableUserContacts && $adminModule->enableSendMessage): ?>
                    <?= SendMessageToUserWidget::widget(['model' => $model, 'divClassBtnContainer' => '']) ?>
                <?php endif; ?>
                <?php if ($adminModule->enableInviteUserToEvent): ?>
                    <?php
                    /** @var \arter\amos\events\AmosEvents $eventsModule */
                    $eventsModule = Yii::$app->getModule('events');
                    ?>
                    <?php if (!is_null($eventsModule) && $eventsModule->hasMethod('getInviteUserToEventWidget')): ?>
                        <?= $eventsModule->getInviteUserToEventWidget($model) ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
