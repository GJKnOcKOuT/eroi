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
 * @package    arter\amos\admin\views\user-profile\boxes
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\base\ConfigurationManager;
use arter\amos\admin\controllers\UserProfileController;
use arter\amos\admin\models\UserProfileArea;
use arter\amos\admin\models\UserProfileRole;
use arter\amos\core\forms\editors\Select;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var arter\amos\core\forms\ActiveForm $form
 * @var arter\amos\admin\models\UserProfile $model
 * @var arter\amos\core\user\User $user
 */

/** @var UserProfileController $appController */
$appController = Yii::$app->controller;

/** @var AmosAdmin $adminModule */
$adminModule = Yii::$app->controller->module;

$roleId = Html::getInputId($model, 'user_profile_role_id');
$roleName = Html::getInputName($model, 'user_profile_role_id');
$areaId = Html::getInputId($model, 'user_profile_area_id');
$areaName = Html::getInputName($model, 'user_profile_area_id');
$otherRoleId = Html::getInputId($model, 'user_profile_role_other');
$otherAreaId = Html::getInputId($model, 'user_profile_area_other');

$js = "
//$('input[name=\"" . $roleName . "\"]').on('change', function(event) {
$('#$roleId').on('change', function(event) {
    if ($(this).val() != " . UserProfileRole::OTHER . ") {
        $('#" . $otherRoleId . "').attr('disabled', true).val('');
    } else {
        $('#" . $otherRoleId . "').attr('disabled', false);
    }
});
//$('input[name=\"" . $areaName . "\"]').on('change', function(event) {
$('#$areaId').on('change', function(event) {
    if ($(this).val() != " . UserProfileArea::OTHER . ") {
        $('#" . $otherAreaId . "').attr('disabled', true).val('');
    } else {
        $('#" . $otherAreaId . "').attr('disabled', false);
    }
});
";
$this->registerJs($js, View::POS_READY);

?>
<?php if (!$adminModule->roleAndAreaOnOrganizations): ?>
    <section>
        <div class="row">
            <?php if ($adminModule->confManager->isVisibleField('user_profile_role_id', ConfigurationManager::VIEW_TYPE_FORM)): ?>
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($model, 'user_profile_role_id', [
                        'template' => "{label}\n{hint}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}",
                    ])->widget(Select::classname(), [
                        'options' => ['placeholder' => AmosAdmin::t('amosadmin', 'Select/Choose') . '...', 'disabled' => false],
                        'data' => $appController->getRoles()
                    ])->label($model->getAttributeLabel('role') . ' ' . AmosIcons::show('lock', ['title' => AmosAdmin::t('amosadmin', '#confidential')])); ?>
                    <?= $form->field($model, 'user_profile_role_other')->textInput([
                        'maxlength' => true,
                        'readonly' => false,
                        'disabled' => ($model->user_profile_role_id != UserProfileRole::OTHER),
                        'placeholder' => AmosAdmin::t('amosadmin', 'Other Role')
                    ])->label(false) ?>
                </div>
            <?php endif; ?>
            <?php if ($adminModule->confManager->isVisibleField('user_profile_area_id', ConfigurationManager::VIEW_TYPE_FORM)): ?>
                <div class="col-xs-12 col-md-6">
                    <?= $form->field($model, 'user_profile_area_id', [
                        'template' => "{label}\n{hint}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}",
                    ])->widget(Select::classname(), [
                        'options' => ['placeholder' => AmosAdmin::t('amosadmin', 'Select/Choose') . '...', 'disabled' => false],
                        'data' => $appController->getAreas()
                    ])->label($model->getAttributeLabel('area') . ' ' . AmosIcons::show('lock', ['title' => AmosAdmin::t('amosadmin', '#confidential')])); ?>
                    <?= $form->field($model, 'user_profile_area_other')->textInput([
                        'maxlength' => true,
                        'readonly' => false,
                        'disabled' => ($model->user_profile_area_id != UserProfileArea::OTHER),
                        'placeholder' => AmosAdmin::t('amosadmin', 'Other Area')
                    ])->label(false) ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
