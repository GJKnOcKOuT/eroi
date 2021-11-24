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
 * @package    arter\amos\basic\template
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use yii\helpers\Html;
use arter\amos\core\forms\ActiveForm;
use arter\amos\admin\AmosAdmin;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\forms\PasswordInput;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="bk-formDefaultLogin" class="loginContainerFullsize">
    <div class="login-block resetpwd-block col-xs-12 nop">
        <div class="login-body">
            <h2 class="title-login"><?= AmosAdmin::t('amosadmin', '#fullsize_reset_pwd'); ?></h2>
            <h3 class="title-login"><?= AmosAdmin::t('amosadmin', '#fullsize_reset_pwd_subtitle'); ?></h3>
            <?php
            $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['autocomplete' => 'off'],
            ])
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <?= Html::beginTag('div', ['class' => 'form-group field-firstaccessform-password']) ?>
                    <?= Html::tag('span', $model->getAttributeLabel('username')) ?>
                    <?= Html::tag('strong', $model->username) ?>
                    <?= Html::endTag('div') ?>
                </div>
                <div class="col-xs-12">
                    <?=
                    $form->field($model, 'password')->widget(PasswordInput::classname(), [
                        'language' => 'it',
                        'pluginOptions' => [
                            'showMeter' => true,
                            'toggleMask' => true,
                            'language' => 'it'
                        ],
                        'options' => [
                            'placeholder' => AmosAdmin::t('amosadmin', '#fullsize_field_reset_pwd_1')
                        ]
                    ])->label('');
                    ?>
                    <?= AmosIcons::show('lucchetto', '', AmosIcons::IC) ?>
                </div>
                <div class="col-xs-12">
                    <?= $form->field($model, 'ripetiPassword')->passwordInput(['placeholder' => AmosAdmin::t('amosadmin', '#fullsize_field_reset_pwd_2')])->label('') ?>
                    <?= AmosIcons::show('lucchetto', '', AmosIcons::IC) ?>
                </div>
                <?php if (!empty($isFirstAccess) && $isFirstAccess) { ?>
                    <div class="cookie-privacy col-xs-12">
                        <?= Html::a(AmosAdmin::t('amosadmin', '#cookie_policy_message'), '/site/privacy', ['title' => AmosAdmin::t('amosadmin', '#cookie_policy_title'), 'target' => '_blank']) ?>
                        <?= Html::tag('p', AmosAdmin::t('amosadmin', '#cookie_policy_content')) ?>
                        <div class="">
                            <?= $form->field($model, 'privacy')->radioList([
                                1 => AmosAdmin::t('amosadmin', '#cookie_policy_ok'),
                                0 => AmosAdmin::t('amosadmin', '#cookie_policy_not_ok')
                            ]); ?>
                        </div>
                    </div>
                <?php } ?>
                <?= $form->field($model, 'token')->hiddenInput()->label(false) ?>
                <div class="col-xs-12 action">
                    <?= Html::submitButton(AmosAdmin::t('amosadmin', '#text_button_login'), ['class' => 'btn btn-navigation-primary', 'name' => 'first-access-button', 'title' => AmosAdmin::t('amosadmin', '#text_button_login')]) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
