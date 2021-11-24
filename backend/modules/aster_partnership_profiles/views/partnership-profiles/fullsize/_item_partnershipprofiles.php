<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles\views\partnership-profiles\fullsize
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\forms\ItemAndCardHeaderWidget;
use arter\amos\core\forms\PublishedByWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\views\toolbars\StatsToolbar;
use arter\amos\notificationmanager\forms\NewsWidget;
use arter\amos\partnershipprofiles\Module;

/**
 * @var \arter\amos\partnershipprofiles\models\PartnershipProfiles $model
 */

$statesCounter = $model->getExpressionsOfInterestStatesCounter();

$module = \Yii::$app->getModule('partnershipprofiles');
$moduleCwh = \Yii::$app->getModule('cwh');
$communityConfigurationsId = null;
if (isset($moduleCwh) && !empty($moduleCwh->getCwhScope())) {
    $scope = $moduleCwh->getCwhScope();
    if (isset($scope['community'])) {
        $communityConfigurationsId = 'communityId-' . $scope['community'];
    }
}

$enabledFields = !empty($module->fieldsCommunityConfigurations[$communityConfigurationsId]['fields']) ? $module->fieldsCommunityConfigurations[$communityConfigurationsId]['fields'] : (!empty($module->fieldsConfigurations['fields']) ? $module->fieldsConfigurations['fields'] : []);

?>
<div class="listview-container">
    <div class="<?= Yii::$app->controller->id ?> post-horizonatal">
        <div class="post-header media nop col-xs-12 col-sm-7">
            <?= ItemAndCardHeaderWidget::widget([
                'model' => $model,
                'publicationDateField' => 'updated_at'
            ]) ?>
        </div>
        <div class="col-sm-7 col-xs-12 nop">
            <div class="post-content col-xs-12 nop">
                <div class="post-title col-xs-10">
                    <h2><?= Html::a($model->title, $model->getFullViewUrl()); ?></h2>
                </div>
                <?= NewsWidget::widget(['model' => $model]); ?>
                <?= ContextMenuWidget::widget([
                    'model' => $model,
                    'actionModify' => "/partnershipprofiles/partnership-profiles/update?id=" . $model->id,
                    'actionDelete' => "/partnershipprofiles/partnership-profiles/delete?id=" . $model->id
                ]) ?>
                <div class="clearfix"></div>
                <div class="row nom post-wrap">
                    <div class="post-text col-xs-12">
                        <p>
                            <?php
                            $shortDesc = $model->short_description;
                            if (strlen($model->short_description) > 800) {
                                $stringCut = substr($model->short_description, 0, 800);
                                $shortDesc = substr($stringCut, 0, strrpos($stringCut, ' ')) . '... ';
                            }
                            ?>
                            <?= $shortDesc ?>
                            <?= Html::a(Module::tHtml('amospartnershipprofiles', 'Read all'), $model->getFullViewUrl(), [
                                'class' => 'underline',
                                'title' => Module::t('amospartnershipprofiles', 'Read the partnership profile')
                            ]) ?>
                        </p>
                    </div>
                </div>
                <div class="post-footer col-xs-12 nop">
                    <div class="post-info">
                        <?php if (!empty($enabledFields['expiration_in_months']) && $enabledFields['expiration_in_months'] == true) {
                            $pubblicationDate = '{pubblicationdates}';
                        } else {
                            $pubblicationDate = '{pubblishedfrom}';
                        }
                        ?>
                        <?=
                        PublishedByWidget::widget([
                            'model' => $model,
                            'layout' => '{publisherAdv}{targetAdv}{animator}{status}' . $pubblicationDate,
                            'renderSections' => [
                                '{animator}' => function ($model) {
                                    return Html::tag('label', Module::t('amospartnershipprofiles', '#Animatore')) . ': ' . $model->partnershipProfileFacilitator->nomeCognome . Html::endTag('br');
                                }
                            ]
                        ])
                        ?>
                    </div>
                    <?php if (isset($statsToolbar) && $statsToolbar): ?>
                        <?= StatsToolbar::widget(['model' => $model]); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
        $sidebarParams = ['model' => $model];
        if (isset($ownInterestPartnershipProfileIds)) {
            $sidebarParams['ownInterestPartnershipProfileIds'] = $ownInterestPartnershipProfileIds;
        }
        ?>
        <?= $this->render('boxes/sidebar', $sidebarParams) ?>
    </div>
</div>
