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

$this->title = AmosAdmin::t('amosadmin', 'Password dimenticata');
$this->params['breadcrumbs'][] = $this->title;

$referrer = \Yii::$app->request->referrer;
if( (strpos($referrer, 'javascript') !== false) || (strpos($referrer ,\Yii::$app->params['backendUrl']) == false ) ){
    $referrer = null;
}
ModuleAdminAsset::register(Yii::$app->view);
?>

<div id="bk-formDefaultLogin" class="bk-loginContainer loginContainer">
    <div class="body col-xs-12 nop">
        <h2 class="title-login"><?= AmosAdmin::t('amosadmin', '#forgot_pwd_title'); ?></h2>
        <h3 class="subtitle-login"><?= AmosAdmin::t('amosadmin', '#forgot_pwd_subtitle'); ?></h3>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="row">
            <div class="col-xs-12">
                <?= $form->field($model, 'email') ?>
            </div>
            <div class="col-xs-12 footer-link">
                <?= Html::submitButton(AmosAdmin::t('amosadmin', '#forgot_pwd_send'), ['class' => 'btn btn-primary btn-administration-primary pull-right', 'name' => 'login-button', 'title' => AmosAdmin::t('amosadmin', '#forgot_pwd_send_title')]) ?>
                <?= Html::a(AmosAdmin::t('amosadmin', '#go_to_login'), (strip_tags($referrer) ?: ['/admin/security/login']), ['class' => 'btn btn-secondary pull-left', 'title' => AmosAdmin::t('amosadmin', '#go_to_login_title')]) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>


</div>