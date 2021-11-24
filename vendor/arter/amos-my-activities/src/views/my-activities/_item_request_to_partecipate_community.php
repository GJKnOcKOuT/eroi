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
use arter\amos\community\widgets\JoinCommunityWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\myactivities\AmosMyActivities;

/** @var $model \arter\amos\myactivities\basic\RequestToParticipateCommunityForManager */
//pr($model->getSearchString(), 'CLASSE: ' . $model->className() . ' creato: ' . $model->getCreatedAt());
//\arter\amos\core\views\assets\AmosCoreAsset::register($this);
$userProfile = UserProfile::find()->andWhere(['user_id' => $model->updated_by])->one();
?>
<?php if (!empty($userProfile)): ?>
    <div class="wrap-activity">
        <div class="col-md-1 col-xs-2 icon-plugin">
            <?= AmosIcons::show('users', [], 'dash') ?>
        </div>
        <div class="col-md-3 col-xs-5 wrap-user">
            <?= UserCardWidget::widget(['model' => $userProfile]) ?>
            <span class="user"><?= $userProfile->getNomeCognome() ?></span>
            <br>
            <?= AmosAdmin::t('amosadmin', $userProfile->workflowStatus->label) ?>
        </div>
        <div class="col-md-5 col-xs-5 wrap-report">
            <div class="col-lg-12 col-xs-12">
                <strong><?= AmosMyActivities::t('amosmyactivities', 'Request for community participation'); ?></strong>
            </div>
            <div class="col-lg-12 col-xs-12">
                <?= Yii::$app->formatter->asDatetime($model->getUpdatedAt()) ?>
            </div>
            <div class="col-lg-12 col-xs-12">
                <p class="user-report"><?= $userProfile->getNomeCognome() ?></p>
                <?= AmosMyActivities::t('amosmyactivities',
                    ' asks to accept the invitation to participate you to the community:'); ?>
                <?= $model->community->name; ?>
            </div>
            <div class="col-lg-12 col-xs-12">
                <?= Html::a(AmosIcons::show('search', [], 'dash') . ' ' . AmosMyActivities::t('amosmyactivities',
                        'View card'),
                    Yii::$app->urlManager->createUrl([
                        '/community/community/view',
                        'id' => $model->community_id
                    ])
                ) ?>
            </div>
        </div>
        <div class="col-md-3 col-xs-12 wrap-action">
            <?= JoinCommunityWidget::widget(['model' => $model->community]) ?>
        </div>
    </div>
    <hr>
<?php endif; ?>
