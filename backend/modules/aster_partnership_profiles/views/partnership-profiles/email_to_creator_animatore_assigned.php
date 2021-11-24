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

$facilitatore = $partnershipProfile->partnershipProfileFacilitator;
$urlUserAnimator = \Yii::$app->urlManager->createAbsoluteUrl($facilitatore->getFullViewUrl());
$userAnimatorLink = Html::a($facilitatore->getNomeCognome(), $urlUserAnimator);
$userProfiloLink = Html::a(Module::t('amospartnershipprofiles', "profilo"), $urlUserAnimator);

$message = Module::t('amospartnershipprofiles', "#animatore_assigned_to_eroe", [
    'nomecognome' => $userAnimatorLink,
    'profilo' => $userProfiloLink,
]);

?>

<div>
    <div style="box-sizing:border-box;">
        <div class="corpo" style="border:1px solid #cccccc;padding:10px;margin-bottom:10px;background-color:#ffffff;margin-top:20px">
            <p><?= $message ?></p>
        </div>
    </div>
</div>
