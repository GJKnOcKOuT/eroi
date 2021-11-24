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

/** @var CommunityUserMm $model */

use arter\amos\admin\models\UserProfile;
use arter\amos\community\AmosCommunity;
use arter\amos\community\models\Community;
use arter\amos\community\models\CommunityUserMm;
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\CloseSaveButtonWidget;
use kartik\select2\Select2;

/** @var Community $community */
$community = Community::findOne($model->community_id);
/** @var \arter\amos\core\user\User $user */
$user = \arter\amos\core\user\User::findOne($model->user_id);
/** @var  UserProfile $userProfile */
$userProfile = $user->getProfile();
$this->title = $userProfile->getNomeCognome() . " - ".AmosCommunity::t('amoscommunity', 'Manage role and permission') ;
$this->params['breadcrumbs'][] = ['label' => AmosCommunity::t('amoscommunity', 'Community'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $community->name, 'url' => ['update', 'id' => $community->id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php
$form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data',
        'class' => 'form default-form col-xs-12 nop',
        'id' => 'community_user_mm_form_' . $model->id,
        'enableClientValidation' => true,
        'errorSummaryCssClass' => 'error-summary alert alert-error'
    ],
]);
?>

<?= $form->errorSummary($model, ['class' => 'alert-danger alert fade in']); ?>

<?php
$contextObject = Yii::createObject($community->context);
$roles = $contextObject->getContextRoles();
$rolesArray = [];
foreach ($roles as $role) {
    $rolesArray[$role] = $role;
}
?>
<br/>
<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'role')->widget(Select2::className(), [
            'data' => $rolesArray,
            'language' => 'it',
            'options' =>
                ['multiple' => false,
                'id' => 'role',
                'placeholder' => AmosCommunity::t('amoscommunity', 'Select') . '...',
                'class' => 'dynamicCreation',
                'data-model' => 'community_user_mm',
                'data-field' => 'role',
                'data-module' => 'community_user_mm',
                'data-entity' => 'community_user_mm',
                'data-toggle' => 'tooltip',
    //            'disabled' => (!$model->isNewRecord)? true : false
            ],
            'pluginOptions' => [
                'allowClear' => false
            ],
            'pluginEvents' => [
                "select2:open" => "dynamicInsertOpening"
            ]
        ])->label($model->getAttributeLabel('role'), ['for' => 'role']) ?>
    </div>
</div>

<?= CloseSaveButtonWidget::widget([
    'model' => $model,
    'urlClose' => Yii::$app->urlManager->createUrl(['community/community/annulla-m2m', 'id' => $model->community_id]),
    'buttonNewSaveLabel' => AmosCommunity::tHtml('amoscommunity', 'Save'),
    'buttonSaveLabel' => AmosCommunity::tHtml('amoscommunity', 'Save')
]); ?>

<?php
ActiveForm::end();
?>
