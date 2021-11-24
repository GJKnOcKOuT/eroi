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

use arter\amos\invitations\models\Invitation;
use arter\amos\invitations\models\InvitationUser;
use yii\web\View;

/**
 * @var View $this
 * @var Invitation $invitation
 * @var InvitationUser $invitationUser
 */

$this->title = Yii::t('amosinvitations', '#send-invitation-titile');
?>
<div class="invitation-update">

    <?= $this->render('_form', [
        'invitation' => $invitation,
        'invitationUser' => $invitationUser,
    ]) ?>

</div>
