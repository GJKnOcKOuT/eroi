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
 * @package    arter\amos\partnershipprofiles\views\partnership-profiles\boxes
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use backend\modules\aster_partnership_profiles\models\PartnershipProfiles;
use backend\modules\aster_partnership_profiles\utility\PartnershipProfilesUtility;
use arter\amos\core\helpers\Html;
use arter\amos\partnershipprofiles\controllers\PartnershipProfilesController;
use arter\amos\partnershipprofiles\Module;
use arter\amos\partnershipprofiles\rules\ReadAllExprOfIntRule;
use arter\amos\partnershipprofiles\widgets\ExpressYourInterestWidget;

/**
 * @var yii\web\View $this
 * @var arter\amos\partnershipprofiles\models\PartnershipProfiles $model
 */

$statesCounter = $model->getExpressionsOfInterestStatesCounter();

/** @var PartnershipProfilesController $appController */
$appController = Yii::$app->controller;

?>
<div class="sidebar col-sm-5 col-xs-12">
    <div class="row">
        <h4 class="col-md-6 title">
            <?= $statesCounter['notdraft'] ?>
            <?= (($statesCounter['notdraft'] == 1) ?
                ucfirst(Module::t('amospartnershipprofiles', '#expression_of_interest_sidebar')) :
                ucfirst(Module::t('amospartnershipprofiles', '#expressions_of_interest_sidebar'))
            ) ?>
            <?php if (Yii::$app->user->can('EXPRESSIONS_OF_INTEREST_ADMINISTRATOR') || \Yii::$app->user->can(ReadAllExprOfIntRule::className(), ['model' => $model])): ?>
                <?= '(' . Html::a(
                    Module::tHtml('amospartnershipprofiles', 'view all'),
                    ['/partnershipprofiles/expressions-of-interest/all', 'partnership_profile_id' => $model->id],
                    ['class' => ' ']
                ) . ')'; ?>
            <?php endif; ?>
        </h4>
        <?php if (PartnershipProfilesUtility::userCanCloseChallenge($model, Yii::$app->user->id)): ?>
            <?php
            $closeTitle = Module::t('amospartnershipprofiles', '#close_challenge');
            ?>
            <div class="col-md-6 text-right">
                <?= Html::a(
                    $closeTitle,
                    ['/partnershipprofiles/partnership-profiles/close-partnership-profile', 'id' => $model->id],
                    [
                        'class' => 'btn btn-navigation-primary',
                        'title' => $closeTitle,
                        'data-confirm' => Module::t('amospartnershipprofiles', '#ask_close_challenge')
                    ]
                ); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="container-sidebar">
        <div class="box">
            <div class="media">
                <div class="media-left">
                    <p class="number-participants"><?= $statesCounter['active'] ?></p>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?= Module::tHtml('amospartnershipprofiles', '#active_sidebar') ?></h4>
                    <?= Module::tHtml('amospartnershipprofiles', 'Number of submitted expressions of interest') ?>
                </div>
            </div>

            <div class="media">
                <div class="media-left">
                    <p class="number-participants"><?= $statesCounter['tovalidate'] ?></p>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?= Module::tHtml('amospartnershipprofiles', '#in_assessment_sidebar') ?></h4>
                    <?= Module::tHtml('amospartnershipprofiles', 'Number of expressions of interest in assessment') ?>
                </div>
            </div>

            <div class="media">
                <div class="media-left">
                    <p class="number-participants"><?= $statesCounter['relevant'] ?></p>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?= Module::tHtml('amospartnershipprofiles', '#relevant_sidebar') ?></h4>
                    <?= Module::tHtml('amospartnershipprofiles', 'Number of relevant expressions of interest') ?>
                </div>
            </div>

            <div class="media">
                <div class="media-left">
                    <p class="number-participants"><?= $statesCounter['rejected'] ?></p>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?= Module::tHtml('amospartnershipprofiles', '#rejected_sidebar') ?></h4>
                    <?= Module::tHtml('amospartnershipprofiles', 'Number of rejected expressions of interest') ?>
                </div>
            </div>
        </div>
        <?php
        $widgetParams = ['model' => $model];
        if (isset($ownInterestPartnershipProfileIds)) {
            $widgetParams['allowedPartnershipProfileIds'] = $ownInterestPartnershipProfileIds;
        }
        ?>
        <?= ExpressYourInterestWidget::widget($widgetParams); ?>
        <?php if ($appController->viewCreateProjectGroupBtn($model)): ?>
            <div class="footer_sidebar col-xs-12 text-right">
                <?= Html::a(Module::t('amospartnershipprofiles', 'Create project group'), ['/partnershipprofiles/partnership-profiles/create-project-group', 'id' => $model->id], ['class' => 'btn btn-navigation-primary']); ?>
            </div>
        <?php endif; ?>
        <?php if ($appController->viewAccessProjectGroupBtn($model)): ?>
            <div class="footer_sidebar col-xs-12 text-right">
                <?= Html::a(Module::t('amospartnershipprofiles', 'Access the project group'), ['/community/join/index', 'id' => $model->community_id], ['class' => 'btn btn-navigation-primary']); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
