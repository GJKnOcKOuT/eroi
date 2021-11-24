<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\admin\views\user-profile\boxes
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\base\ConfigurationManager;
use arter\amos\admin\controllers\UserProfileController;
use arter\amos\admin\models\UserProfileRole;
use arter\amos\core\forms\editors\Select;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var arter\amos\core\forms\ActiveForm $form
 * @var \backend\modules\aster_admin\models\UserProfile $model
 * @var arter\amos\core\user\User $user
 */

/** @var UserProfileController $appController */
$appController = Yii::$app->controller;

/** @var AmosAdmin $adminModule */
$adminModule = Yii::$app->controller->module;

$roleId = Html::getInputId($model, 'user_profile_role_id');
$otherRoleId = Html::getInputId($model, 'user_profile_role_other');

$js = "
$('#$roleId').on('change', function(event) {
    if ($(this).val() != " . UserProfileRole::OTHER . ") {
        $('#" . $otherRoleId . "').attr('disabled', true).val('');
        $('#" . $otherRoleId . "').hide();
    } else {
        $('#" . $otherRoleId . "').attr('disabled', false);
        $('#" . $otherRoleId . "').show();
    }
});

if($('#$roleId').val() == " . UserProfileRole::OTHER . ") {
    $('#" . $otherRoleId . "').show();
}

";
$this->registerJs($js, View::POS_READY);

$this->registerCss("
    #" . $otherRoleId . " {
        display:none;
    }
");

?>

<?php if (!$adminModule->roleAndAreaOnOrganizations): ?>
    <section>
        <div class="row">
            <?php if (
                $adminModule->confManager->isVisibleField('user_profile_role_id', ConfigurationManager::VIEW_TYPE_FORM) ||
                $adminModule->confManager->isVisibleField('user_profile_role_other', ConfigurationManager::VIEW_TYPE_FORM)
            ): ?>
                <div class="col-xs-12">
                    <?php if ($adminModule->confManager->isVisibleField('user_profile_role_id', ConfigurationManager::VIEW_TYPE_FORM)): ?>
                        <?= $form->field($model, 'user_profile_role_id', [
                            'template' => "{label}\n{hint}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}",
                        ])->widget(Select::classname(), [
                            'options' => ['placeholder' => AmosAdmin::t('amosadmin', 'Select/Choose') . '...', 'disabled' => false],
                            'data' => $appController->getRoles()
                        ])->label($model->getAttributeLabel('role') . ' ' . AmosIcons::show('lock', ['title' => AmosAdmin::t('amosadmin', '#confidential')])); ?>
                    <?php endif; ?>
                    <?php if ($adminModule->confManager->isVisibleField('user_profile_role_other', ConfigurationManager::VIEW_TYPE_FORM)): ?>
                        <?= $form->field($model, 'user_profile_role_other')->textInput([
                            'maxlength' => true,
                            'readonly' => false,
                            'disabled' => ($model->user_profile_role_id != UserProfileRole::OTHER),
                            'placeholder' => AmosAdmin::t('amosadmin', 'Other Role')
                        ])->label(false) ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
