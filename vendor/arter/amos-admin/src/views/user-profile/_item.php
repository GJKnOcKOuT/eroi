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
use arter\amos\admin\utility\UserProfileUtility;
use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\interfaces\OrganizationsModuleInterface;
use arter\amos\core\user\User;
use arter\amos\core\utilities\ModalUtility;

/**
 * @var yii\web\View $this
 * @var \arter\amos\admin\models\UserProfile $model
 */

/** @var AmosAdmin $adminModule */
$adminModule = Yii::$app->getModule(AmosAdmin::getModuleName());

/** @var OrganizationsModuleInterface $organizationsModule */
$organizationsModule = Yii::$app->getModule($adminModule->getOrganizationModuleName());

if ($model instanceof User) {
    $model = $model->getProfile();
}
$nomeCognome = '';
if ($adminModule->confManager->isVisibleBox('box_informazioni_base', ConfigurationManager::VIEW_TYPE_VIEW)) {
    if ($adminModule->confManager->isVisibleField('nome', ConfigurationManager::VIEW_TYPE_VIEW)) {
        $nomeCognome .= $model->nome;
    }
    if ($adminModule->confManager->isVisibleField('cognome', ConfigurationManager::VIEW_TYPE_VIEW)) {
        $nomeCognome .= ' ' . $model->cognome;
    }
}

$isVisibleEmail = (($adminModule->confManager->isVisibleBox('box_informazioni_base', ConfigurationManager::VIEW_TYPE_VIEW)) &&
    ($adminModule->confManager->isVisibleField('nome', ConfigurationManager::VIEW_TYPE_VIEW)) &&
    ($adminModule->confManager->isVisibleField('cognome', ConfigurationManager::VIEW_TYPE_VIEW)) &&
    $model->user->email && (Yii::$app->user->can('ADMIN') || Yii::$app->user->can('AMMINISTRATORE_UTENTI')));

$confirmText = AmosAdmin::t('amosadmin', 'You have selected') . " " . $model->getNomeCognome() . " " . AmosAdmin::t('amosadmin', 'as your facilitator. To confirm click on the CONFIRM button. At the confirm the facilitator will be bound to the user profile.');

$isAssociateFacilitator = (Yii::$app->controller->action->id == 'associate-facilitator') || (Yii::$app->controller->action->id == 'send-request-external-facilitator');
$urlConfirmBtn = Yii::$app->controller->action->id == 'send-request-external-facilitator'
    ?  '/admin/user-profile/send-request-external-facilitator?idToAssign='.$model->id .'&id='.\Yii::$app->request->get('id')
    : null;

if ($isAssociateFacilitator) {
    ModalUtility::createConfirmModal([
        'id' => 'confirmPopup' . $model->id,
        'modalDescriptionText' => $confirmText,
        'confirmBtnOptions' => ['id' => 'confirm-associate-facilitator', 'class' => 'btn btn-primary confirmBtn', 'data' => ['model_id' => $model->id]],
        'confirmBtnLink' => $urlConfirmBtn
    ]);
}

$modelFullViewUrl = $model->getFullViewUrl();

?>

<div class="list-horizontal-element col-xs-12 nop">

    <div class="list-element-left">
        <?php if (($adminModule->confManager->isVisibleBox('box_foto', ConfigurationManager::VIEW_TYPE_VIEW)) &&
            ($adminModule->confManager->isVisibleField('userProfileImage', ConfigurationManager::VIEW_TYPE_VIEW))
        ): ?>
            <?php
            Yii::$app->imageUtility->methodGetImageUrl = "getAvatarUrl";
            $logo = Html::tag('div', Html::img($model->getAvatarUrl('square_small'), [
                'class' => Yii::$app->imageUtility->getRoundImage($model)['class'],
                'style' => "margin-left: " . Yii::$app->imageUtility->getRoundImage($model)['margin-left'] . "%; margin-top: " . Yii::$app->imageUtility->getRoundImage($model)['margin-top'] . "%;",
                'alt' => $model->getNomeCognome(),
                'title' => $model->getNomeCognome(),
            ]),
                ['class' => 'container-round-img-lg']);
            ?>
            <div class="grow-pict">
                <?php if ($isAssociateFacilitator): ?>
                    <?= $logo ?>
                <?php else: ?>
                    <?= Html::a($logo, $modelFullViewUrl); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="list-element-right">
        <?php if (!$isAssociateFacilitator): ?>
            <?= ContextMenuWidget::widget([
                'model' => $model,
                'mainDivClasses' => 'pull-right',
                'actionModify' => '/admin/user-profile/update?id=' . $model->id,
                'disableDelete' => true
            ]) ?>
        <?php endif; ?>
        <div class="list-element-body">
            <?php if (($adminModule->confManager->isVisibleBox('box_informazioni_base', ConfigurationManager::VIEW_TYPE_VIEW)) &&
                ($adminModule->confManager->isVisibleField('nome', ConfigurationManager::VIEW_TYPE_VIEW)) &&
                ($adminModule->confManager->isVisibleField('cognome', ConfigurationManager::VIEW_TYPE_VIEW))
            ): ?>
                <h3>
                    <?php if ($isAssociateFacilitator): ?>
                        <?= $nomeCognome ?>
                    <?php else: ?>
                        <?= Html::a($nomeCognome, $modelFullViewUrl, ['title' => AmosAdmin::t('amosadmin', '#icon_name_title_link') . ' ' . $model->getNomeCognome(), 'data-test' => 'list-view-profiles']); ?>
                    <?php endif; ?>
                </h3>
            <?php endif; ?>
            <?php if ($isVisibleEmail): ?>
                <p>
                    <?= AmosIcons::show('email'); ?>
                    <span><?= $model->user->email; ?></span>
                </p>
            <?php endif; ?>
            <?php if (($adminModule->confManager->isVisibleBox('box_informazioni_base', ConfigurationManager::VIEW_TYPE_VIEW)) &&
                ($adminModule->confManager->isVisibleField('presentazione_breve', ConfigurationManager::VIEW_TYPE_VIEW))
            ): ?>
                <br>
                <p>
                    <span><?= ($model->presentazione_breve ? $model->presentazione_breve : ''); ?></span>
                </p>
            <?php endif; ?>
            <?php if (($adminModule->confManager->isVisibleBox('box_presentazione_personale', ConfigurationManager::VIEW_TYPE_VIEW)) &&
                ($adminModule->confManager->isVisibleField('presentazione_personale', ConfigurationManager::VIEW_TYPE_VIEW))
            ): ?>
                <br>
                <p>
                    <span><?= ($model->presentazione_personale ? $model->presentazione_personale : ''); ?></span>
                </p>
            <?php endif; ?>
            <?php if (($adminModule->confManager->isVisibleBox('box_prevalent_partnership', ConfigurationManager::VIEW_TYPE_VIEW)) &&
                ($adminModule->confManager->isVisibleField('prevalent_partnership_id', ConfigurationManager::VIEW_TYPE_VIEW)) &&
                ((Yii::$app->controller->action->id == 'facilitator-users') || $isAssociateFacilitator)
            ): ?>
                <?php if (!is_null($model->prevalentPartnership)): ?>
                    <br>
                    <div class="text-uppercase bold"><?= AmosAdmin::t('amosadmin', 'Prevalent partnership') . ':' ?></div>
                    <p>
                        <?php
                        $organizationsCardWidgetClassName = $organizationsModule->getOrganizationCardWidgetClass();
                        ?>
                        <?= $organizationsCardWidgetClassName::widget(['model' => $model->prevalentPartnership]); ?>
                    </p>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($adminModule->confManager->isVisibleBox('box_facilitatori', ConfigurationManager::VIEW_TYPE_FORM) &&
                $adminModule->confManager->isVisibleField('facilitatore_id', ConfigurationManager::VIEW_TYPE_FORM) &&
                $isAssociateFacilitator
            ): ?>
                <?= Html::a(
                    AmosIcons::show('square-check', ['class' => 'm-r-5'], 'dash') . AmosAdmin::t('amosadmin', 'Set as facilitator'),
                    null,
                    [
                        'class' => 'btn btn-navigation-primary set-facilitator-btn',
                        'data-model_id' => $model->id,
                        'data-model_name' => $model->nome,
                        'data-model_surname' => $model->cognome,
                        'data-target' => '#confirmPopup' . $model->id,
                        'data-toggle' => 'modal',
//                            'data-confirm' => $confirmText,
//                            'data-pjax' => 0
                    ]
                ); ?>
            <?php endif; ?>
            <?php $communityModule = Yii::$app->getModule('community'); ?>
            <?php if (!is_null($communityModule) && (Yii::$app->controller->action->id == 'community-manager-users')): ?>
                <?php /** @var \arter\amos\community\AmosCommunity $communityModule */ ?>
                <?php $userCommunities = UserProfileUtility::getCommunitiesForManagers($communityModule, $model->user_id); ?>
                <?php if (count($userCommunities)): ?>
                    <br>
                    <div>
                        <span class="text-uppercase bold"><?= AmosAdmin::t('amosadmin', 'Community manager for') . ':' ?></span>
                        <?php foreach ($userCommunities as $userCommunity): ?>
                            <?php /** @var \arter\amos\community\models\Community $userCommunity */ ?>
                            <div><?= $userCommunity->name ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
