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

$this->title = AmosAdmin::t('amosadmin', '#disable_notification');
$this->params['breadcrumbs'][] = $this->title;

ModuleAdminAsset::register(Yii::$app->view);
?>

<div id="bk-formDefaultLogin" class="loginContainerFullsize">
    <div class="login-block disablenotify-block col-xs-12 nop">
        <div class="login-body">
            <h2 class="title-login"><?= AmosAdmin::t('amosadmin', '#disable_notification'); ?></h2>
            <h3 class="title-login"><?= AmosAdmin::t('amosadmin', '#disable_notification_text'); ?></h3>
            <?php $form = ActiveForm::begin(['id' => 'disable-notifications']); ?>
            <div class="row">
                <div class="col-xs-12">
                    <?= Html::hiddenInput('user_id', $token) ?>
                </div>
                <div class="col-xs-12 action">
                    <?= Html::submitButton(AmosAdmin::t('amosadmin', '#disable_notifications_send'), ['class' => 'btn btn-primary btn-administration-primary', 'name' => 'login-button', 'title' => AmosAdmin::t('amosadmin', '#disable_notifications_send')]) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
