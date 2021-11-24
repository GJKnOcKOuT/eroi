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

use arter\amos\core\helpers\Html;
use arter\amos\partnershipprofiles\Module;

/**
 * @var \arter\amos\admin\models\UserProfile $contactProfile
 * @var string $message
 * @var string $url
 * @var string $messageLink
 * @var \backend\modules\aster_partnership_profiles\models\PartnershipProfiles $partnershipProfile
 */

$urlSfida = \Yii::$app->urlManager->createAbsoluteUrl([
    '/partnershipprofiles/partnership-profiles/view',
    'id' => $partnershipProfile->id
]);
$visualizzaSfidaLink = Html::a('visualizza sfida', $urlSfida);
$titleSfidaLink = Html::a($partnershipProfile->getTitle(), $urlSfida);

$eroeCreate = $partnershipProfile->createdUserProfile;
$urlUserCreate = \Yii::$app->urlManager->createAbsoluteUrl($eroeCreate->getFullViewUrl());
$userCreateLink = Html::a($eroeCreate->getNomeCognome(), $urlUserCreate);

$message = Module::t('amospartnershipprofiles', "#mentor_eroe_to_create", [
    'sfida' => $titleSfidaLink,
    'nomecognome' => $userCreateLink,
    'visualizza_sfida' => $visualizzaSfidaLink,
]);
?>

<div>
    <div style="box-sizing:border-box;">
        <div class="corpo" style="border:1px solid #cccccc;padding:10px;margin-bottom:10px;background-color:#ffffff;margin-top:20px">
            <p><?= $message ?></p>
        </div>
    </div>
</div>
