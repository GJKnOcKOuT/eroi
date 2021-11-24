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

ModuleAdminAsset::register(Yii::$app->view);
/**
 * @var yii\web\View $this
 * @var yii\bootstrap\ActiveForm $form
 * @var \arter\amos\admin\models\LoginForm $model
 */

$this->title = AmosAdmin::t('amosadmin', 'Reactivate Profile');
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $form = ActiveForm::begin([
    'id' => 'reactivate-profile-form'
]); ?>
<div id="bk-formDefaultLogin" class="bk-loginContainer loginContainer">
    <div class="body col-xs-12 nop">
        <div class="col-xs-12">
            <h2 class="title-login"><?= AmosAdmin::t('amosadmin', '#reactivate_profile_title'); ?></h2>
            <?php if(\Yii::$app->request->get() && array_key_exists("userdisabled", \Yii::$app->request->get())) { ?>
                <h3 class="subtitle-login"><?= AmosAdmin::t('amosadmin', '#userdisabled_profile_subtitle'); ?></h3>
            <?php } else { ?>
                <h3 class="subtitle-login"><?= AmosAdmin::t('amosadmin', '#reactivate_profile_subtitle'); ?></h3>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-xs-12"><?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => AmosAdmin::t('amosadmin', 'Type email')]) ?></div>
            <div class="col-xs-12"><?= $form->field($model, 'message')->textarea(['maxlength' => true, 'rows' => 6, 'placeholder' => AmosAdmin::t('amosadmin', 'Type a message')]) ?></div>
            <?= Html::tag('div', AmosAdmin::t('amosadmin', '#required_field'), ['class' => 'col-xs-12 required-field']) ?>
            <div class="col-xs-12 footer-link">
                <?= Html::submitButton(AmosAdmin::t('amosadmin', '#reactivate_profile_send'), ['class' => 'btn btn-primary btn-administration-primary pull-right', 'title'=>AmosAdmin::t('amosadmin', '#reactivate_profile_send_title')]) ?>
                <?php if(\Yii::$app->request->get() && array_key_exists("userdisabled", \Yii::$app->request->get())) { ?>
                    <?= Html::a(AmosAdmin::t('amosadmin', '#go_to_login'), ['/admin/security/login'], ['class' => 'btn btn-secondary pull-left', 'title'=>AmosAdmin::t('amosadmin', '#go_to_login_title')]) ?>
                <?php } else { ?>
                    <?= Html::a(AmosAdmin::t('amosadmin', '#go_to_register'), ['/admin/security/register'], ['class' => 'btn btn-secondary pull-left', 'title'=>AmosAdmin::t('amosadmin', '#go_to_register_title')]) ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>