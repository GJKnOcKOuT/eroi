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
 * @package    arter\amos\community\views\community-wizard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\AmosCommunity;
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\WizardPrevAndContinueButtonWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;

/**
 * @var \arter\amos\community\models\Community $model
 */

$this->title = AmosCommunity::t('amoscommunity', 'New Community');
if(!is_null($model->parent_id)){
    $this->title = AmosCommunity::t('amoscommunity', '#new_subcommunity');
}
$this->params['breadcrumbs'][] = ['label' => AmosCommunity::t('amoscommunity', 'Community'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php
$form = ActiveForm::begin([
    'options' => [
        'id' => 'community_form_' . $model->id,
        'class' => 'form',
        'enctype' => 'multipart/form-data',
        'enableClientValidation' => true,
        'errorSummaryCssClass' => 'error-summary alert alert-error'
    ]
]);
?>

<div class="access-type">
    <div class="row">
        <div class="col-xs-12">
            <p><?= AmosCommunity::tHtml('amoscommunity', "Choose the enrollment mode for users") ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?= $form->beginField($model, 'community_type_id') ?>
            <?php
            $communityTypesArray = \arter\amos\community\models\CommunityType::find()->asArray()->all();
            foreach ($communityTypesArray as $communityType) {
                $communityTypeId = $communityType['id'];
                $amosIconToshow = 'unlock';
                $color = 'success';
                if ($communityTypeId == 3) {
                    $amosIconToshow = 'lock';
                    $color = 'danger';
                } elseif ($communityTypeId == 2) {
                    $amosIconToshow = 'unlock-alt';
                    $color = 'warning';
                }
                ?>
                <div class="radio">
                    <div class="row">
                        <div class="col-sm-2 col-xs-12">
                            <div class="text-center text-<?= $color ?>">
                                <?= AmosIcons::show($amosIconToshow, ['class' => 'am-4'], 'dash'); ?>
                            </div>
                        </div>
                        <div class="col-sm-10 col-xs-12">
                            <?= \arter\amos\core\helpers\Html::radio('Community[community_type_id]', ($model->community_type_id == $communityTypeId), [
                                'label' => AmosCommunity::t('amoscommunity', $communityType['name']),
                                'labelOptions' => ['class' => 'control-label'],
                                'id' => 'community[community_type_id]-' . $communityTypeId,
                                'value' => $communityTypeId,
                            ]); ?>
                            <p><?= AmosCommunity::t('amoscommunity', $communityType['description']) ?></p>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
            <?= Html::error($model, 'community_type_id', ['class' => 'help-block help-block-error']); ?>
            <?= $form->endField() ?>

        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">

        </div>
    </div>
</div>

<div class="col-xs-12 note_asterisk nop">
    <p><?= AmosCommunity::tHtml('amoscommunity', 'The fields marked with ') ?><span class="red">*</span><?= AmosCommunity::tHtml('amoscommunity', ' are required') ?></p>
</div>

<?= WizardPrevAndContinueButtonWidget::widget([
    'model' => $model,
    'previousUrl' => Yii::$app->getUrlManager()->createUrl([
        '/community/community-wizard/details',
        'id' => $model->id
    ]),
    'cancelUrl' => Yii::$app->session->get(AmosCommunity::beginCreateNewSessionKey()),
    'contentAlreadyExists' => true
]) ?>

<?php ActiveForm::end(); ?>
