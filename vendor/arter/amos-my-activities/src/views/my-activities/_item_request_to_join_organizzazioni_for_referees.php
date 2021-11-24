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
use arter\amos\myactivities\AmosMyActivities;

/**
 * @var \arter\amos\myactivities\basic\RequestToJoinOrganizzazioniForReferees $model
 */

$userProfile = (!is_null($model->user) ? $model->user->userProfile : null);
?>
<?php if (Yii::$app->user->can('CONFIRM_ORGANIZZAZIONI_OR_SEDI_USER_REQUEST', ['model' => $model]) && !empty($userProfile)): ?>
    <?php
    $nomeCognome = $userProfile->getNomeCognome();
    $linkText = AmosIcons::show('search', [], 'dash') . ' ' . AmosMyActivities::t('amosmyactivities', 'View profile');
    ?>
    <div class="wrap-activity">
        <div class="col-md-1 col-xs-2 icon-plugin">
            <?= AmosIcons::show('users', [], 'dash') ?>
        </div>
        <div class="col-md-3 col-xs-5 wrap-user">
            <?= UserCardWidget::widget(['model' => $userProfile]) ?>
            <span class="user"><?= $nomeCognome ?></span>
            <br>
            <?= AmosAdmin::t('amosadmin', $userProfile->workflowStatus->label) ?>
        </div>
        <div class="col-md-5 col-xs-5 wrap-report">
            <div class="col-lg-12 col-xs-12">
                <strong><?= AmosMyActivities::t('amosmyactivities', 'Request for organization membership'); ?></strong>
            </div>
            <div class="col-lg-12 col-xs-12">
                <?= Yii::$app->formatter->asDatetime($model->getUpdatedAt()) ?>
            </div>
            <div class="col-lg-12 col-xs-12">
                <p class="user-report"><?= $nomeCognome ?></p>
                <?= AmosMyActivities::t('amosmyactivities', 'asks you to be accepted as an organization member of the organization:'); ?>
                <?= $model->profilo->name; ?>
            </div>
            <div class="col-lg-12 col-xs-12">
                <?= Html::a($linkText, $userProfile->getFullViewUrl()) ?>
            </div>
        </div>
        <div class="col-md-3 col-xs-12 wrap-action">
            <?= Html::a(AmosIcons::show('check') . ' ' . AmosMyActivities::t('amosmyactivities', 'Validate'),
                Yii::$app->urlManager->createUrl([
                    '/organizzazioni/profilo/accept-user',
                    'profiloId' => $model->profilo_id,
                    'userId' => $model->user_id
                ]),
                ['class' => 'btn btn-primary']
            ) ?>
            <?= Html::a(AmosIcons::show('close') . ' ' . AmosMyActivities::t('amosmyactivities', 'Reject'),
                Yii::$app->urlManager->createUrl([
                    '/organizzazioni/profilo/reject-user',
                    'profiloId' => $model->profilo_id,
                    'userId' => $model->user_id
                ]),
                ['class' => 'btn btn-secondary']
            ) ?>
        </div>
    </div>
    <hr>
<?php endif; ?>
