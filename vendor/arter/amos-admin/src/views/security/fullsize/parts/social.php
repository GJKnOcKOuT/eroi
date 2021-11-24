<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @licence GPLv3
 * @licence https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package amos-admin
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\core\helpers\Html;
use arter\amos\admin\assets\ModuleAdminAsset;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

ModuleAdminAsset::register(Yii::$app->view);

/**
 * @var $socialAuthModule \arter\amos\socialauth\Module
 */
$socialAuthModule = Yii::$app->getModule('socialauth');

//change social url

$urlSocial = ($type == 'login') ? '/socialauth/social-auth/sign-in?provider=' : '/socialauth/social-auth/sign-up?provider=';

if(empty($communityId)) {
    $communityId = \Yii::$app->request->get('community');
}
$paramCommunity = '';
$paramsRedirectUrl = '';
if($communityId){
    $paramCommunity = '&community='.$communityId;
}else if($redirectUrl){
    $paramsRedirectUrl = '';/**'&redirectUrl='.$redirectUrl;*/
}


?>
<?= Html::tag('h2', ($type == 'login') ? AmosAdmin::t('amosadmin', '#fullsize_social_title_login') : AmosAdmin::t('amosadmin', '#fullsize_social_title_register'), ['class' => 'title-login']) ?>
<div class="social-buttons col-xs-12 nop">
    <?php
    foreach ($socialAuthModule->providers as $name => $config) :
        ?>
        <div class="col-xs-12 nop">
            <a
                    class="btn btn-<?= strtolower($name); ?> social-link"
                    title="<?= ($type == 'login') ? AmosAdmin::t('amosadmin', '#login_with_social') : AmosAdmin::t('amosadmin', '#register_with_social') ?> <?= $name; ?>"
                    target="_self"
                    href="<?= Yii::$app->urlManager->createAbsoluteUrl($urlSocial . strtolower($name).$paramCommunity.$paramsRedirectUrl); ?>"
            >
                <span class="am am-<?= strtolower($name); ?>"></span>
                <span class="text"><?= $name; ?></span>
            </a>
        </div>
    <?php endforeach; ?>
</div>
