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
 * @package    arter\amos\admin\views\security
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\core\helpers\Html;
use arter\amos\admin\assets\ModuleAdminAsset;
use arter\amos\core\forms\ActiveForm;
use yii\helpers\ArrayHelper;

ModuleAdminAsset::register(Yii::$app->view);

/**
 * @var yii\web\View $this
 * @var yii\bootstrap\ActiveForm $form
 * @var \arter\amos\admin\models\RegisterForm $model
 */
$text = AmosAdmin::t('amosadmin', "#register_privacy_alert_not_accepted");

$js = <<<JS
    var selected_social_url = '';
    $('.social-link').click(function(event){
        selected_social_url = $(this).attr('href');
        event.preventDefault();
        $('#modal-privacy').modal('show');
    });
    
    $('.radio-privacy input').click(function(){
         var checked = $('.radio-privacy input:checked').val();
         if(checked == 1){
         $('.radio').append('<p class="help-block help-block-error">'+'$text'+'</p>');
         }
         else {
           $('.radio p').remove();
        }
    });

    $('#confirm-privacy-button').click(function(){
        var checked = $('.radio-privacy input:checked').val();
       if(checked == 0) {
            window.open(selected_social_url);
            $('#modal-privacy').modal('toggle');
        }
    });


JS;

$this->registerJs($js);

$this->title = AmosAdmin::t('amosadmin', 'Login');
$this->params['breadcrumbs'][] = $this->title;

/**
 * @var $socialAuthModule \arter\amos\socialauth\Module
 */
$socialAuthModule = Yii::$app->getModule('socialauth');

$socialMatch = Yii::$app->session->get('social-pending');
$socialProfile = Yii::$app->session->get('social-profile');
$communityId = Yii::$app->request->get('community');
?>

<div id="bk-formDefaultLogin" class="bk-loginContainer loginContainer">

    <?php if (!isset(Yii::$app->params['logo']) || !Yii::$app->params['logo'] || $socialAuthModule) : ?>
        <div class="header col-xs-12">
            <?php if (!isset(Yii::$app->params['logo']) || !Yii::$app->params['logo']) : ?>
                <p class="welcome-message"><?= AmosAdmin::t('amosadmin', '#login_welcome_message') ?></p>
            <?php endif; ?>

            <?php if ($socialAuthModule && $socialAuthModule->enableRegister && !$socialMatch) : ?>
                <?= $this->render('parts/header', [
                    'type' => 'register',
                ]); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if($socialProfile) :
        echo Html::tag('h2', AmosAdmin::t('amosadmin', 'You are right to register using {provider} account', [
            'provider' => $socialMatch
        ]), ['class' => 'title-login col-xs-12 nop']);
    endif;
    ?>

    <?php if ($socialAuthModule && $socialAuthModule->enableRegister && !$socialMatch) : ?>
        <div class="or-login col-xs-12 nop">
            <?= Html::tag('span', AmosAdmin::t('amosadmin', '#or')) ?>
        </div>
    <?php endif; ?>

    <div class="body col-xs-12 nop">
        <?= Html::tag('h2', AmosAdmin::t('amosadmin', '#title_register'), ['class' => 'title-login']) ?>
        <?= Html::tag('h3', AmosAdmin::t('amosadmin', '#subtitle_register'), ['class' => 'subtitle-login']) ?>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="row">
            <div class="col-lg-12 col-sm-12 nop">
                <div class="col-sm-6 col-xs-12"><?= $form->field($model, 'nome')->textInput() ?></div>
                <div class="col-sm-6 col-xs-12"><?= $form->field($model, 'cognome')->textInput() ?></div>
                <div class="col-xs-12"><?= $form->field($model, 'email')->textInput() ?></div>
                <?= Html::tag('div', AmosAdmin::t('amosadmin', '#required_field'), ['class' => 'col-xs-12 required-field']) ?>
                <div class="col-xs-12"><?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className())->label('') ?></div>
                <div class="col-xs-12 text-bottom">
                    <?= Html::a(AmosAdmin::t('amosadmin', '#cookie_policy_message'), '/site/privacy', ['title' => AmosAdmin::t('amosadmin', '#cookie_policy_title'), 'target' => '_blank']) ?>
                    <?= Html::tag('p', AmosAdmin::t('amosadmin', '#cookie_policy_content')) ?>
                    <?= $form->field($model, 'privacy')->radioList([
                        1 => AmosAdmin::t('amosadmin', '#cookie_policy_ok'),
                        0 => AmosAdmin::t('amosadmin', '#cookie_policy_not_ok')
                    ]); ?>
                </div>

                <?php
                if($communityId) { ?>
                    <?= Html::hiddenInput('community', $communityId)?>
                <?php } 
                ?>

                <?php
                if ($iuid) { ?>
                    <?= Html::hiddenInput('iuid', $iuid)?>
                <?php } 
                ?>
                
                <div class="col-xs-12">
                    <?= Html::submitButton(AmosAdmin::t('amosadmin', '#register_now'), ['class' => 'btn btn-primary btn-administration-primary pull-right', 'name' => 'login-button', 'title' => AmosAdmin::t('amosadmin', '#register_now')]) ?>
                    <?php ActiveForm::end(); ?>
                    <?= Html::a(AmosAdmin::t('amosadmin', '#go_to_login'), ['/admin/security/login'], ['class' => 'btn btn-secondary pull-left', 'title' => AmosAdmin::t('amosadmin', '#go_to_login_title'), 'target' => '_self']) ?>
                </div>

                <div class="col-xs-12 footer-link text-center">
                    <?= Html::a(AmosAdmin::t('amosadmin', '#reactive_profile'), ['/admin/security/reactivate-profile'], ['class' => '', 'title' => AmosAdmin::t('amosadmin', '#reactive_profile'), 'target' => '_self']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    \yii\bootstrap\Modal::begin(['id' => 'modal-privacy']);

    echo Html::tag('div',

        Html::a(AmosAdmin::t('amosadmin', '#cookie_policy_message'), '/site/privacy', ['title' => AmosAdmin::t('amosadmin', '#cookie_policy_title'), 'target' => '_blank']) .
        Html::tag('p', AmosAdmin::t('amosadmin', '#cookie_policy_content')) .
        Html::radioList('privacy', null, [AmosAdmin::t('amosadmin', '#cookie_policy_ok'), AmosAdmin::t('amosadmin', '#cookie_policy_not_ok')], ['class' => 'radio radio-privacy'])

        , ['class' => 'text-bottom']);

    echo Html::tag('div',

        Html::submitButton(AmosAdmin::t('amosadmin', '#register_now'), ['class' => 'btn btn-primary btn-administration-primary pull-right', 'id' => 'confirm-privacy-button', 'title' => AmosAdmin::t('amosadmin', '#register_now')]) .
        Html::a(AmosAdmin::t('amosadmin', '#go_to_login'), null, ['data-dismiss' => 'modal', 'class' => 'btn btn-secondary pull-left', 'title' => AmosAdmin::t('amosadmin', '#go_to_login_title'), 'target' => '_self'])

    );

    \yii\bootstrap\Modal::end();
    ?>


</div>
