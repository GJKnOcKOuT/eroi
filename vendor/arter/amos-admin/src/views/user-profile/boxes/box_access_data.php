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
use arter\amos\admin\base\ConfigurationManager;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use yii\helpers\FileHelper;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var arter\amos\core\forms\ActiveForm $form
 * @var arter\amos\admin\models\UserProfile $model
 * @var arter\amos\core\user\User $user
 * @var bool $spediscicredenzialienable
 */

/** @var AmosAdmin $adminModule */
$adminModule = Yii::$app->controller->module;

$js = "
$('#deactivate-account-btn').on('click', function(event) {
    event.preventDefault();
    var ok = confirm('" . AmosAdmin::t('amosadmin', 'Do you really want to deactivate your user') . '?' . "');
    if (ok) {
        window.location.href = $(this).attr('href');
    }
});
$('#reactivate-account-btn').on('click', function(event) {
    event.preventDefault();
    var ok = confirm('" . AmosAdmin::t('amosadmin', 'Do you really want to reactivate this user') . '?' . "');
    if (ok) {
        window.location.href = $(this).attr('href');
    }
});

$('#drop-account-btn').on('click', function(event) {
    event.preventDefault();
    var ok = confirm('" . AmosAdmin::t('amosadmin', '#delete_user_data') . "');
    if (ok) {
        window.location.href = $(this).attr('href');
    }
});

";
$this->registerJs($js, View::POS_READY);

?>

<section class="account-admin-section col-xs-12 nop">
    <h2>
        <!--        < ?= AmosIcons::show('account') ?>-->
        <?= AmosAdmin::t('amosadmin', 'Account'); ?>
    </h2>
    <div class="col-xs-12 col-sm-4 nop">
        <?php if ($adminModule->confManager->isVisibleField('username', ConfigurationManager::VIEW_TYPE_FORM)): ?>
            <?= Html::beginTag('p', ['class' => 'field-user-username']) ?>
            <?= Html::tag('span', $user->getAttributeLabel('username')) ?>
            <?= Html::tag('strong', $user->username ? $user->username : AmosAdmin::t('amosadmin', 'Non ancora definito')) ?>
            <?= Html::endTag('p') ?>
        <?php endif; ?>
        <?= Html::beginTag('p') ?>
        <?= Html::tag('span', AmosAdmin::t('amosadmin', '#creation_date')) . ':' ?>
        <?= Html::tag('strong', ($model->created_at ? Yii::$app->formatter->asDatetime($model->created_at) : AmosAdmin::t('amosadmin', '#not_available'))) ?>
        <?= Html::endTag('p') ?>
        <?= Html::beginTag('p') ?>
        <?= Html::tag('span', AmosAdmin::t('amosadmin', '#last_update_date') . ':') ?>
        <?= Html::tag('strong', ($model->updated_at ? Yii::$app->formatter->asDatetime($model->updated_at) : AmosAdmin::t('amosadmin', '#not_available'))) ?>
        <?= Html::endTag('p') ?>
    </div>
    <div class="col-xs-6 col-sm-4 nop">
        <?php if ($adminModule->confManager->isVisibleField('attivo', ConfigurationManager::VIEW_TYPE_FORM)): ?>
            <?= Html::beginTag('p') ?>
            <?= Html::tag('span', AmosAdmin::t('amosadmin', 'Stato')) ?>
            <?= Html::tag('strong', ($model->attivo ? AmosAdmin::t('amosadmin', 'Active') : AmosAdmin::t('amosadmin', 'Deactivated'))) ?>
            <?= Html::endTag('p') ?>
        <?php endif; ?>
        <?php if ($adminModule->confManager->isVisibleField('ultimo_accesso', ConfigurationManager::VIEW_TYPE_FORM)): ?>
            <?= Html::beginTag('p') ?>
            <?= Html::tag('span', AmosAdmin::t('amosadmin', 'Ultimo accesso:')) ?>
            <?= Html::tag('strong', ($model->ultimo_accesso ? Yii::$app->formatter->asDatetime($model->ultimo_accesso) : AmosAdmin::t('amosadmin', 'Nessun accesso'))) ?>
            <?= Html::endTag('p') ?>
        <?php endif; ?>

        <?php if ($adminModule->confManager->isVisibleField('ultimo_logout', ConfigurationManager::VIEW_TYPE_FORM)): ?>
            <?= Html::beginTag('p') ?>
            <?= Html::tag('span', AmosAdmin::t('amosadmin', 'Ultimo logout:')) ?>
            <?= Html::tag('strong', ($model->ultimo_logout ? Yii::$app->formatter->asDatetime($model->ultimo_logout) : AmosAdmin::t('amosadmin', 'Nessun logout'))) ?>
            <?= Html::endTag('p') ?>
        <?php endif; ?>
    </div>
    <div class="col-xs-6 col-sm-4 nop">

        <?php if (!$model->isNewRecord && isset($user['email']) && strlen(trim($user['email']))): ?>
            <?php if (Yii::$app->getUser()->can("GESTIONE_UTENTI")): ?>
                <?php if ($spediscicredenzialienable): ?>
                    <?php echo $this->renderPhpFile(
                        FileHelper::localize(
                            $this->context->getViewPath() . DIRECTORY_SEPARATOR . 'help' . DIRECTORY_SEPARATOR . 'send-recovery-password.php'
                        ), ['model' => $model]); ?>
                <?php else: ?>
                    <div id="info-spedisci" class="btn btn-action-primary disabled" data-toggle="tooltip" data-placement="left"
                         title="<?= AmosAdmin::t('amosadmin', 'Per spedire le credenziali occorre impostare il Ruolo nella sezione AMMINISTRAZIONE'); ?>">
                        <?= AmosAdmin::t('amosadmin', 'Spedisci credenziali'); ?>
                    </div>
                    <div class=""><?= AmosAdmin::tHtml('amosadmin', 'Per spedire le credenziali occorre impostare il Ruolo nella sezione AMMINISTRAZIONE') ?></div>
                    <div class="btn btn-action-primary disabled"><?= AmosAdmin::t('amosadmin', 'Spedisci credenziali'); ?></div>
                <?php endif; ?>
            <?php endif; ?>
            <?php
            /** @var \arter\amos\core\user\User $identity */
            $identity = Yii::$app->user->identity
            ?>
            <?php if (Yii::$app->user->can('CHANGE_USER_PASSWORD') && ($user['id'] == $identity->id)): ?>
                <?= Html::a(AmosIcons::show('unlock') . AmosAdmin::t('amosadmin', 'Cambia password'), ['/admin/user-profile/cambia-password', 'id' => $model->id], [
                    'class' => 'btn  btn-action-primary btn-cambia-password'
                ]); ?>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($model->isActive() && Yii::$app->user->can('DeactivateAccount', ['model' => $model])): ?>
            <?= Html::a(AmosAdmin::t('amosadmin', 'Deactivate user'), ['/admin/user-profile/deactivate-account', 'id' => $model->id], [
                'id' => 'deactivate-account-btn',
                'class' => 'btn btn-danger',
                'title' => AmosAdmin::t('amosadmin', 'Deactivate user'),
//                'data-confirm' => AmosAdmin::t('amosadmin', 'Do you really want to deactivate your user') . '?'
            ]) ?>
        <?php endif; ?>
        <?php if ($model->isDeactivated() && (Yii::$app->user->can('ADMIN') || Yii::$app->user->can('AMMINISTRATORE_UTENTI'))): ?>
            <?= Html::a(AmosAdmin::t('amosadmin', 'Reactivate this user'), ['/admin/user-profile/reactivate-account', 'id' => $model->id], [
                'id' => 'reactivate-account-btn',
                'class' => 'btn btn-navigation-primary',
                'title' => AmosAdmin::t('amosadmin', 'Reactivate this user'),
//                'data-confirm' => AmosAdmin::t('amosadmin', 'Do you really want to reactivate this user') . '?'
            ]) ?>
        <?php endif; ?>
        <?= Html::a(AmosAdmin::t('amosadmin', '#delete_user'), ['/admin/user-profile/drop-account', 'id' => $model->id], [
            'id' => 'drop-account-btn',
            'class' => 'btn btn-danger',
            'title' => AmosAdmin::t('amosadmin', '#delete_user'),
            //'data-confirm' => AmosAdmin::t('amosadmin', '#delete_user_data')
        ]) ?>
        <?= Html::beginTag('p') ?>
        <?= Html::tag('span', AmosAdmin::t('amosadmin', '#change_irreversible')) ?>
        <?= Html::endTag('p') ?>
    </div>
</section>
