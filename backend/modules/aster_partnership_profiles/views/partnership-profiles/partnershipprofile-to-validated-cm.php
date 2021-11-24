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
 * @var \backend\modules\aster_partnership_profiles\models\PartnershipProfiles $model
 */

$url = \Yii::$app->urlManager->createAbsoluteUrl([
    '/partnershipprofiles/partnership-profiles/update',
    'id' => $model->id
]);

$eroeCreate = $model->createdUserProfile;
$urlUserCreate = \Yii::$app->urlManager->createAbsoluteUrl($eroeCreate->getFullViewUrl());
$userCreateLink = Html::a($eroeCreate->getNomeCognome(), $urlUserCreate);

$urlSfida = \Yii::$app->urlManager->createAbsoluteUrl([
    '/partnershipprofiles/partnership-profiles/view',
    'id' => $model->id
]);
$titleSfidaLink = Html::a($model->getTitle(), $urlSfida);

$message = Module::t('amospartnershipprofiles', "#partnershipprofile_to_validate_cm_mail", [
    'nomecognome' => $userCreateLink,
    'sfida' => $titleSfidaLink
]);

$message_1 = Module::t('amospartnershipprofiles', "#partnershipprofile_to_validate_cm_mail_1");

?>

<div>
    <div style="box-sizing:border-box;">
        <div class="corpo" style="border:1px solid #cccccc;padding:10px;margin-bottom:10px;background-color:#ffffff;margin-top:20px">
            <p><?= $message ?>
                <a href="<?= $url ?>"><?= Module::t('amospartnershipprofiles', "Select facilitator"); ?></a>
                <?= $message_1 ?>
            </p>
        </div>
    </div>
</div>
