<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles\views\partnership-profiles
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use backend\modules\aster_admin\models\UserProfile;
use arter\amos\core\helpers\Html;
use arter\amos\partnershipprofiles\Module;

/**
 * @var \arter\amos\admin\models\UserProfile $contactProfile
 * @var string $message
 * @var string $url
 * @var string $messageLink
 * @var \backend\modules\aster_partnership_profiles\models\PartnershipProfiles $partnershipProfile
 */

$eroeCreate = $partnershipProfile->createdUserProfile;

/** @var UserProfile $cm */
$cm = UserProfile::find()->andWhere(['user_id' => $partnershipProfile->getValidatorUsersId()[0]])->one();

$chatUrl = \Yii::$app->urlManager->createAbsoluteUrl(['messages/' . $eroeCreate->user_id]);
$eroechatlink = Html::a(Module::t('amospartnershipprofiles', "EROE"), $chatUrl);

$urlSfida = \Yii::$app->urlManager->createAbsoluteUrl([
    '/partnershipprofiles/partnership-profiles/view',
    'id' => $partnershipProfile->id
]);
$titleSfidaLink = Html::a(Module::t('amospartnershipprofiles', "#here"), $urlSfida);

$urlUserCreate = \Yii::$app->urlManager->createAbsoluteUrl($eroeCreate->getFullViewUrl());
$userCreateLink = Html::a($eroeCreate->getNomeCognome(), $urlUserCreate);

$urlUserCm = \Yii::$app->urlManager->createAbsoluteUrl($cm->getFullViewUrl());
$userCmLink = Html::a(Module::t('amospartnershipprofiles', "Community Manager"), $urlUserCm);

$message = Module::t('amospartnershipprofiles', "#animatore_assigned", [
    'sfida' => $partnershipProfile->title,
    'nomecognome' => $userCreateLink,
    'qui' => $titleSfidaLink,
    'eroe' => $eroechatlink,
    'cm' => $userCmLink,
]);

?>

<div>
    <div style="box-sizing:border-box;">
        <div class="corpo" style="border:1px solid #cccccc;padding:10px;margin-bottom:10px;background-color:#ffffff;margin-top:20px">
            <p><?= $message ?></p>
        </div>
    </div>
</div>
