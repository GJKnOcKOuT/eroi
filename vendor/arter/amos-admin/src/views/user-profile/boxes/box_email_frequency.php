<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\admin\views\user-profile\boxes
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\core\icons\AmosIcons;
use arter\amos\notificationmanager\widgets\NotifyFrequencyWidget;

/**
 * @var yii\web\View $this
 * @var arter\amos\core\forms\ActiveForm $form
 * @var arter\amos\admin\models\UserProfile $model
 * @var arter\amos\core\user\User $user
 */

/** @var AmosAdmin $adminModule */
$adminModule = Yii::$app->controller->module;

\arter\amos\core\utilities\ModalUtility::createAlertModal([
    'id' => 'notify-uncheck',
    'modalDescriptionText' => AmosAdmin::t('amosadmin', '#notify_flag_uncheck_msg'),
]);

?>

<section class="email-freq-admin-section col-xs-12 m-t-15">
    <h3>
<!--        < ?= AmosIcons::show('email') ?>-->
        <?= AmosAdmin::tHtml('amosadmin', '#email_frequency_settings') ?>
    </h3>
    <p><?= AmosAdmin::t('amosadmin', 'If the frequency is not indicated, you will receive the notifications as automatically set by the system') . '.' ?></p>
    <div class="col-xs-12 nop m-t-15">
        <label><strong><?= AmosAdmin::tHtml('amosadmin', 'Email frequency')?></strong></label>
        <?= NotifyFrequencyWidget::widget([
            'model' => $model
        ]) ?>
    </div>
    <div class="col-xs-12 nop m-t-15">
        <?= \arter\amos\core\helpers\Html::activeCheckbox($model, 'notify_from_editorial_staff', [
            'name' => 'notify_from_editorial_staff',
            'id' => 'notify_from_editorial_staff-1',
            'onchange' => "if(!$(this).is(':checked')){ $('#notify-uncheck').modal('show'); }"
        ]) ?>
    <div>
</section>
