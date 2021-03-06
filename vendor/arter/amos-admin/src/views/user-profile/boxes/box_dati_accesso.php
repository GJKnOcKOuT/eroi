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

/**
 * @var yii\web\View $this
 * @var arter\amos\core\forms\ActiveForm $form
 * @var arter\amos\admin\models\UserProfile $model
 * @var arter\amos\core\user\User $user
 * @var bool $spediscicredenzialienable
 */

/** @var AmosAdmin $adminModule */
$adminModule = Yii::$app->controller->module;

?>
<section class="access-admin-section col-xs-12 nop">
    <h2>
<!--        < ?= AmosIcons::show('lock') ?>-->
        <?= AmosAdmin::tHtml('amosadmin', 'Dati di Accesso') ?>
    </h2>
    <?php if ($adminModule->confManager->isVisibleField('username', ConfigurationManager::VIEW_TYPE_FORM)): ?>
        <div class="col-xs-4 col-sm-6 nop">
            <?= Html::beginTag('p', ['class' => 'field-user-username']) ?>
            <?= Html::tag('span', $user->getAttributeLabel('username')) ?>
            <?= Html::tag('strong', $user->username ? $user->username : AmosAdmin::t('amosadmin', 'Non ancora definito')) ?>
            <?= Html::endTag('p') ?>
        </div>
    <?php endif; ?>

    <div id="user-password" class="col-xs-8 col-sm-6 text-right pull-right">
        <div id="form-credenziali" class="bk-form-credenziali">
            <?php // if (!$model->isNewRecord && isset($user['email']) && strlen(trim($user['email']))):
            //if($spediscicredenzialienable) {
            ?>
            <?php if (!$model->isNewRecord && isset($user['email']) && strlen(trim($user['email']))): ?>
                <?php if (Yii::$app->getUser()->can("GESTIONE_UTENTI")): ?>
                    <?php if ($spediscicredenzialienable): ?>
                        <?= Html::a(
                            AmosIcons::show('email') . AmosAdmin::t('amosadmin', 'Spedisci credenziali'),
                            [
                                '/admin/security/spedisci-credenziali',
                                'id' => $model->id
                            ],
                            [
                                'class' => 'btn btn-navigation-primary btn-spedisci-credenziali ',
                                'title' => AmosAdmin::t('amosadmin', 'Permette l\'invio di una mail contenente un link temporale per modificare le proprie credenziali di accesso.'),
                                'data-confirm' => AmosAdmin::t('amosadmin', 'Sei sicuro di voler inviare le credenziali? Sar?? inviata una mail contenente un link per modificare le credenziali. Vuoi continuare?')
                            ]); ?>
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
        </div>
    </div>
    <div class="clearfix"></div>
</section>
