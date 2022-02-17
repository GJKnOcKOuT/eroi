<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\tickets\views\mail
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var User */

$appLink = Yii::$app->urlManager->createAbsoluteUrl(['/']);
$appName = Yii::$app->name;

//$this->title ='Richiesta Informazioni';
$this->registerCssFile('https://fonts.googleapis.com/css?family=Roboto');
?>
<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td style="margin-bottom:10px;background-color:#297A38;height:15px"></td>
        <td style="margin-bottom:10px;background-color:#297A38;height:15px"></td>
        <td style="margin-bottom:10px;background-color:#297A38;height:15px"></td>
    </tr>
    <tr>
        <td style="height:10px"></td>
    </tr>
    <tr style="background-color:#ffffff;">
        <td>
            <?php
            if (isset(Yii::$app->params['logoMail'])) {
                $logoMail = $appLink.Yii::$app->params['logoMail'];
            } else {
                $logoMail = '';
            }
            ?>
            <img style="max-width:500px; max-height:60px;" src="<?= $logoMail ?>" alt="logo">
        </td>
    </tr>
</table>


<table width=" 600" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td>
            <div class="corpo"
                 style="padding:10px;margin-bottom:10px;background-color:#fff;">
                <div class="sezione titolo" style="overflow:hidden;color:#000000;">
                    <h2 style="padding:5px 0;	margin:0;">Dati utente segnalante</h2>
                </div>
                <?php if (!empty($modelProfile)) { ?>
                    <div class="sezione" style="overflow:hidden;color:#000000;">
                        <div class="testo">
                            <p>
                                <strong>Username</strong>: <?=
                                Yii::t('amosapp', '{username}',
                                    [
                                    'username' => Html::encode($modelProfile->user->username)]
                                );
                                ?>
                            </p>
                            <p>
                                <strong><?= \Yii::t('amosapp', 'Nome') ?></strong>: <?=
                                Yii::t('amosapp', '{first_name}',
                                    [
                                    'first_name' => Html::encode($modelProfile->nome)]
                                );
                                ?>
                            </p>
                            <p>
                                <strong><?= \Yii::t('amosapp', 'Cognome') ?></strong>: <?=
                                Yii::t('amosapp', '{surname}',
                                    [
                                    'surname' => Html::encode($modelProfile->cognome)]
                                );
                                ?>
                            </p>
                            <p>
                                <strong>Email</strong>: <?=
                                Yii::t('amosapp', '{email}',
                                    [
                                    'email' => Html::encode($modelProfile->user->email)
                                ]);
                                ?>
                            </p>
                        </div>

                    </div>
                <?php } else { ?>
                    <div class="sezione" style="overflow:hidden;color:#000000;">
                        <div class="testo">
                            <p>Utente non loggato.</p>
                        </div>
                    </div>
                <?php } ?>

                <div class="sezione titolo" style="overflow:hidden;color:#000000;">
                    <h2 style="padding:5px 0;	margin:0;"><?= \Yii::t('amosapp', 'Richiesta di assistenza') ?></h2>
                </div>
                <div class="sezione" style="overflow:hidden;color:#000000;">
                    <div class="testo">
                        <p>
                            <strong><?= \Yii::t('amosapp', 'Nome') ?></strong>: <?=
                            Yii::t('amosapp', '{first_name}',
                                [
                                'first_name' => Html::encode($model->first_name)]
                            );
                            ?>
                        </p>
                        <p>
                            <strong><?= \Yii::t('amosapp', 'Cognome') ?></strong>: <?=
                            Yii::t('amosapp', '{surname}',
                                [
                                'surname' => Html::encode($model->surname)]
                            );
                            ?>
                        </p>
                        <p>
                            <strong>Email</strong>: <?=
                            Yii::t('amosapp', '{email}',
                                [
                                'email' => Html::encode($model->email)
                            ]);
                            ?>
                        </p>
                        <p>
                            <strong><?= \Yii::t('amosapp', 'Telefono') ?></strong>: <?=
                            Yii::t('amosapp', '{telephone}',
                                [
                                'telephone' => Html::encode($model->telephone)]
                            );
                            ?>
                        </p>
                        <p>
                            <strong><?= \Yii::t('amosapp', 'Messaggio') ?></strong>: <?=
                            Yii::t('amosapp', '{message}',
                                [
                                'message' => Html::encode($model->message)]
                            );
                            ?>
                        </p>
                    </div>

                </div>

            </div>
        </td>
    </tr>
</table>

<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td>
            <!--            <div style="color:black; background-color:lightgrey; padding:10px; font-family:Arial;font-size:12px;line-height:150%;text-align:left">-->
            <div style="font-style: italic; color: #b0b0b0; margin-top:10px;border-top: 2px solid #297a38;padding-top: 5px;font-size: 11px;line-height: normal;">
                <?=
                Yii::t('amosapp', '#footer_template_mail',
                    [
                    'appName' => $appName,
                ])
                ?>
                <p style="margin: 0px;">
                    <a href="<?= $appLink ?>site/privacy"
                       title="<?= Yii::t('amosapp', '#footer_template_mail_privacy_title') ?>"
                       target="_blank"><?= Yii::t('amosapp', '#footer_template_mail_privacy') ?>
                    </a>
                    <br>
                    <?php if (!empty(\Yii::$app->params['urlPersonalizedPrivacy'])) { ?>
                        <a href="<?= $appLink ?>"<?= \Yii::$app->params['urlPersonalizedPrivacy'] ?>
                           title="<?= Yii::t('poiplatform', '#privacy_regione_lombardia') ?>"
                           target="_blank"><?= Yii::t('poiplatform', '#privacy_regione_lombardia') ?>
                        </a>
                    <?php } ?>
                </p>
                <br>
                <?php
                if (!empty($this->params['profile'])) {
                    $profile = $this->params['profile'];
                    $token   = md5($profile->user_id.$appName);
                }
                ?>

                <?php if (!empty($token)) { ?>
                    <p style="margin: 0px; text-align: center">
                        <a href="<?= $appLink ?>admin/security/disable-notifications?token=<?= $token ?>"
                           title="<?= Yii::t('amosapp', '#footer_disable_notification') ?>"
                           target="_blank"><?= Yii::t('amosapp', '#footer_disable_notification') ?>
                        </a>
                    </p>
                <?php } ?>
                <?php if (!empty($profile)) { ?>
                    <p>
                        <?= Yii::t('amosapp',
                            'Gestisci la frequenza delle email ricevute e la tua presenza nella piattaforma, ')
                        ?>
                        <a href="<?= $appLink ?>admin/user-profile/update?id=<?= $profile->id ?>&tabActive=tab-settings"
                           title="<?= Yii::t('amosapp', '#login_profile') ?>"
                           target="_blank"><?= Yii::t('amosapp', '#login_profile') ?>
                        </a>
                    </p>
<?php } ?>
            </div>
        </td>
    </tr>
</table>
