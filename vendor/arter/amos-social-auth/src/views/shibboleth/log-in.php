<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use arter\amos\admin\models\UserProfile;
use arter\amos\socialauth\Module;
use yii\helpers\Html;

/**
 * @var array $userDatas
 * @var $userProfile UserProfile
 * @var string $authType
 */

$subtitleSpidOrCnsString = Module::t('amossocialauth', 'spid_login_subtitle', ['email' => $userDatas['emailAddress']]);
if ($authType == 'IDPC_AUTHENTICATION_SMARTCARD') {
    $subtitleSpidOrCnsString = Module::t('amossocialauth', 'spid_login_subtitle_cns', ['email' => $userDatas['emailAddress']]);
} elseif (($authType == 'IDPC_SPID_L1') || ($authType == 'IDPC_SPID_L2') || ($authType == 'IDPC_SPID_L3')) {
    $subtitleSpidOrCnsString = Module::t('amossocialauth', 'spid_login_subtitle', ['email' => $userDatas['emailAddress']]);
}

?>

<div class="loginContainer">
    <div class="body col-xs-12">
        <h2 class="title-login"><?= Module::t('amossocialauth', 'spid_login_welcome') ?></h2>
        <h3 class="subtitle-login"><?= $subtitleSpidOrCnsString; ?></h3>
        <p class="text-center"><strong><?= Module::t('amossocialauth', 'spid_login_user_data') ?></strong></p>
        <p class="text-center"><?= Module::t('amossocialauth', 'spid_login_name') . ': ' . $userProfile->nome ?></p>
        <p class="text-center"><?= Module::t('amossocialauth', 'spid_login_surname') . ': ' . $userProfile->cognome ?></p>
        <p class="text-center"><?= Module::t('amossocialauth', 'spid_login_email') . ': ' . $userProfile->user->email ?></p>
    </div>
    <div class="col-lg-12 col-sm-12 col-xs-12 footer-link text-center">
        <?= Html::a(\Yii::t('amossocialauth', 'spid_login_confirm_btn'), ['/socialauth/shibboleth/endpoint', 'confirm' => true], ['class' => 'btn btn-administration-primary']); ?>
        <?= Html::a(\Yii::t('amossocialauth', 'spid_login_deny_btn'), '/', ['class' => 'btn btn-administration-primary']); ?>
    </div>
</div>
