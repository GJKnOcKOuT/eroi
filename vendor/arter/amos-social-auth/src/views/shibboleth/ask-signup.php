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


use arter\amos\socialauth\Module;
use arter\amos\admin\AmosAdmin;
use yii\helpers\Html;

/**
 * @var array $userDatas
 * @var string $authType
 */
$adminModule = AmosAdmin::getInstance();

$loginWithSpidOrCnsString = Module::t('amossocialauth', 'spid_signup_already_registered2');
if ($authType == 'IDPC_AUTHENTICATION_SMARTCARD') {
    $loginWithSpidOrCnsString = Module::t('amossocialauth', 'spid_signup_already_registered3');
} elseif (($authType == 'IDPC_SPID_L1') || ($authType == 'IDPC_SPID_L2') || ($authType == 'IDPC_SPID_L3')) {
    $loginWithSpidOrCnsString = Module::t('amossocialauth', 'spid_signup_already_registered2');
}

?>

<div class="loginContainer">
    <div class="body col-xs-12">
        <h2 class="title-login"><?= Module::t('amossocialauth', 'spid_signup_welcome', ['nome' => $userDatas['nome'], 'cognome' => $userDatas['cognome']]) ?></h2>
        <h3 class="subtitle-login"><?= Module::t('amossocialauth', 'spid_signup_subtitle', ['cf' => $userDatas['codiceFiscale'], 'email' => $userDatas['emailAddress']]) ?></h3>
        <div class="col-xs-12 col-sm-6 text-center">
            <p><strong><?= Module::t('amossocialauth', 'spid_signup_already_registered') ?></strong></p>
            <p><?= $loginWithSpidOrCnsString; ?></p>
            <?= Html::a(\Yii::t('amossocialauth', 'spid_signup_already_registered_btn'), ['/'.$adminModule->id.'/security/login', 'confirm' => true], ['class' => 'btn btn-administration-primary']); ?>
        </div>
        <div class="col-xs-12 col-sm-6 text-center">
            <p><strong><?= Module::t('amossocialauth', 'spid_signup_register') ?></strong></p>
            <p><?= Module::t('amossocialauth', 'spid_signup_register2') ?></p>
            <?= Html::a(\Yii::t('amossocialauth', 'spid_signup_register_btn'), ['/'.$adminModule->id.'/security/register', 'confirm' => true], ['class' => 'btn btn-administration-primary']); ?>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-xs-12 footer-link text-center">
    </div>
</div>
