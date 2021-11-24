<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_invitations\views\invitation
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\models\UserProfile;
use arter\amos\core\user\User;
use arter\amos\invitations\Module;

/**
 * @var yii\web\View $this
 * @var arter\amos\invitations\models\Invitation $invitation
 */
/** @var User $loggedUser */
$loggedUser = \Yii::$app->user->identity;

/** @var UserProfile $profileSender */
$profileSender = $loggedUser->userProfile;

$appName = Yii::$app->name;

$urlConf = [
    '/admin/security/register',
    'name' => $invitation->name,
    'surname' => $invitation->surname,
    'email' => $invitation->invitationUser->email,
    'iuid' => \Yii::$app->user->id
];

if (!empty($invitation->module_name) && !empty($invitation->context_model_id)) {
    $urlConf['moduleName']     = $invitation->module_name;
    $urlConf['contextModelId'] = $invitation->context_model_id;
}

$url = Yii::$app->urlManager->createAbsoluteUrl($urlConf);
?>
<div>
    <?= Module::t('amosinvitations', '#hi').' '.$invitation->getNameSurname() ?>,
</div>
<div style="font-weight: normal">
    <p><?=
        Module::t('asterplatform', '#text_email_invitation_nov_19_0',
            [
                'platformName' => $appName,
                'sender' => $profileSender->nomeCognome
        ])
        ?></p>
    <div style="color:green"><strong><?= $invitation->message ?></strong></div>
    <p><?= Module::t('asterplatform', "#text_email_invitation_nov_19_1") ?></p>
    <p><?= Module::t('asterplatform', "#text_email_invitation_nov_19_3") ?></p>
    <p><?= Module::t('asterplatform', "#registration") ?><a href="<?= $url ?>"><strong><?= Module::t('asterplatform',
            '#registration_link')
        ?></strong></a></p>
</div>

<div>
    <?= Module::t('amosinvitations', '#invitation-email-end',
        ['site' => $appName])
    ?>
</div>
