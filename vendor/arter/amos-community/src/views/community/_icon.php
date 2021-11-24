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
 * @package    arter\amos\community\views\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
use arter\amos\community\AmosCommunity;
use arter\amos\community\widgets\JoinCommunityWidget;
use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\notificationmanager\forms\NewsWidget;
use arter\amos\community\models\CommunityUserMm;
use arter\amos\core\user\User; 

/**
 * @var \arter\amos\community\models\Community $model
 */
$communityModule    = Yii::$app->getModule('community');
$fixedCommunityType = !is_null($communityModule->communityType);
$bypassWorkflow     = $communityModule->forceWorkflow($model);

$loggedUserId  = Yii::$app->getUser()->getId();
$userCommunity = CommunityUserMm::findOne(['community_id' => $model->id, 'user_id' => $loggedUserId]);
$userProfile   = User::findOne($loggedUserId)->getProfile();
if (!empty($userProfile) && $userProfile->validato_almeno_una_volta && !is_null($userCommunity) && !in_array($userCommunity->status,
        [CommunityUserMm::STATUS_WAITING_OK_COMMUNITY_MANAGER, CommunityUserMm::STATUS_WAITING_OK_USER])) {
    $viewUrl = '/community/join?id='.$model->id;
} else {
    $viewUrl = '/community/community/view?id='.$model->id;
}
?>

<div class="card-container community-card-container col-xs-12 nop">
    <div class="col-xs-12 nop icon-header">
        <?php /*
        ContextMenuWidget::widget([
            'model' => $model,
            'actionModify' => "/community/community/update?id=".$model->id,
            'actionDelete' => "/community/community/delete?id=".$model->id,
            'mainDivClasses' => '',
            'optionsDelete' => ['class' => 'delete-community-btn']
        ]);*/
        ?>
        <?=
        $newsWidget = NewsWidget::widget([
            'model' => $model,
            'css_class' => 'badge'
        ])
        ?>
        <div class="community-image">
            <?php
            $url        = '/img/img_default.jpg';
            if (!is_null($model->communityLogo)) {
                $url = $model->communityLogo->getUrl('item_community', false, true);
            }
            $logo       = Html::img($url,
                    [
                    'class' => 'img-responsive',
                    'alt' => $model->getAttributeLabel('communityLogo')
            ]);
            ?>
            <?= Html::a($logo, $viewUrl, ['title' => $model->name]); ?>
        </div>
    </div>
    <div class="col-xs-12 nop icon-body">
        <h3 class="title">
            <?=
            Html::a($model->name, $viewUrl,
                ['title' => AmosCommunity::t('amoscommunity', '#icon_title_link').' '.$model->name]);
            ?>
        </h3>
    </div>
    <!--div class="col-xs-12 nop icon-footer">
        <?php /*
        $accessType = '';

        if (!$fixedCommunityType) {
            $accessType = AmosCommunity::t('amoscommunity', 'Access type: ').AmosCommunity::t('amoscommunity',
                    $model->getCommunityTypeName());
        }

        $content = '';
        $content .= Html::tag('p', $accessType);

        if (!empty($accessType)) {
            echo Html::tag('div', AmosIcons::show('info-circle', [], 'dash'),
                [
                'class' => 'amos-tooltip pull-left',
                'data-toggle' => 'tooltip',
                'data-html' => 'true',
                'title' => $content]
            );
        } */
        ?>
<?php // JoinCommunityWidget::widget(['model' => $model, 'divClassBtnContainer' => 'pull-right']) ?>
    </div-->
</div>
