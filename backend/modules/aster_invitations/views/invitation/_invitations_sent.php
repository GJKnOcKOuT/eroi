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

use arter\amos\core\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var $model \arter\amos\invitations\models\Invitation
 **/

$moduleName = null;
$contextModelId = null;

$moduleName = $model->module_name;
$contextModelId = $model->context_model_id ;
 ?>

<?php $form = \arter\amos\core\forms\ActiveForm::begin()?>
    <div class="col-lg-12">
        <?php echo "<strong>" . \arter\amos\invitations\Module::t('amosinvitations', 'Name and surname:') . '</strong> ' . $model->nameSurname ?>
    </div>
    <div class="col-lg-12">
        <?php echo "<strong>" . \arter\amos\invitations\Module::t('amosinvitations', 'Invitations sent:') . '</strong> ' . $model->invitationUser->numberNotificationSended;?>
    </div>
    <div class="col-lg-12">
        <?php
        /** @var  $lastInvitationUser \arter\amos\invitations\models\InvitationUser */
        $invitationUser = arter\amos\invitations\models\InvitationUser:: getInvitationUserFromEmail($model->invitationUser->email);
        $invitation = $invitationUser->getInvitations()->orderBy('send_time DESC')->one()
        ?>
        <?php echo "<strong>" . \arter\amos\invitations\Module::t('amosinvitations', 'Last invitation sent at:') . '</strong> ' . \Yii::$app->formatter->asDatetime($invitation->send_time) ?>
    </div>
    <div>
        <?= Html::a( \arter\amos\invitations\Module::t('amosinvitations', 'Re-send') , [
            '/invitations/invitation/re-send',
            'id' => $model->id,
            'moduleName' => $moduleName,
            'contextModelId' => $contextModelId
        ],['class' => 'btn btn-primary pull-right'])?>
        <?php \arter\amos\core\forms\CloseSaveButtonWidget::widget(['model' => $model, 'buttonId' => 're-send-button', 'buttonSaveLabel' => \arter\amos\invitations\Module::t('amosinvitations', 'Send')]); ?>
    </div>
<?php \arter\amos\core\forms\ActiveForm::end(); ?>
