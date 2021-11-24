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
 * @package    arter\amos\admin\mail\user
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var \arter\amos\core\user\User $user
 * @var \arter\amos\admin\models\UserProfile $profile
 */

$appLink = Yii::$app->params['platform'] ['backendUrl'];//Yii::$app->urlManager->createAbsoluteUrl(['/']);
$appLink = substr($appLink, -1) == '/' ? $appLink : $appLink . '/';
$appLinkPrivacy = Yii::$app->params['platform'] ['backendUrl'] .'/admin/user-profile/privacy'; //Yii::$app->urlManager->createAbsoluteUrl(['/admin/user-profile/privacy']);
$appName = Yii::$app->name;

$this->title = AmosAdmin::t('amosadmin', 'Registrazione {appName}', ['appName' => $appName]);
$this->registerCssFile('http://fonts.googleapis.com/css?family=Roboto');

?>

<table style="line-height: 18px;" width=" 600" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td>
            <div class="corpo"
                 style="padding:10px;margin-bottom:10px;background-color:#ffffff;">

                <div class="sezione" style="overflow:hidden;color:#000000;">
                    <div class="testo">
                        <p style="margin-bottom: 20px;">
                            <span style="font-weight: bold;">
                                <?= AmosAdmin::t('amosadmin', '#welcome_email_dear', [
                                    'name' => Html::encode($profile->nome),
                                    'surname' => Html::encode($profile->cognome)
                                ]); ?>
                                </span>
                            <br />
                            <?= AmosAdmin::t('amosadmin', "#welcome_email") . Yii::$app->name ?>.
                        </p>
                        <p style="margin-bottom: 20px;">
                            <?php
                            $seconds = Yii::$app->params['user.passwordResetTokenExpire'];

                            if($seconds >= 86400) {
                                $passwordResetTokenExpire = floor($seconds / (3600 * 24));
                                if($passwordResetTokenExpire == 1){
                                    $textDay = 'giorno';
                                } else {
                                    $textDay = 'giorni';
                                }
                            }else {
                                if(floor($seconds / 60)>=60){
                                    $textDay = chr(8);
                                    $passwordResetTokenExpire = sprintf("%d ore",floor($seconds / (60*60)));
                                } else {
                                    $textDay = 'minuti';
                                    $passwordResetTokenExpire = floor($seconds / 60);
                                }

                            }
                            $passwordResetTokenExpire = $passwordResetTokenExpire . ' ' . $textDay;
                            ?>
                            <?= AmosAdmin::t('amosadmin', '#welcome_email_expire', [
                                'passwordResetTokenExpire' =>  $passwordResetTokenExpire,
                                'supportEmail' => Yii::$app->params['supportEmail']
                            ]); ?>

                            <?php $link = $appLink . 'admin/security/insert-auth-data?token=' . $profile->user->password_reset_token;
                            if(!empty($community)) {
                                $link .= '&community_id='.$community->id.'&subscribe=1';
                            }
                            ?>
                            <?= Html::beginTag('a', ['href' => $link]) ?>
                            <?= AmosAdmin::t('amosadmin', "#welcome_email_link") ?>
                            <?= Html::endTag('a'); ?>
                        </p>
                        <p style="margin-bottom: 20px;">
                            <?= AmosAdmin::t('amosadmin', '#welcome_email_error_link') ?>
                            <?= AmosAdmin::t('amosadmin', $link) ?>
                        </p>

                        <?php
                        /**
                         * @var \arter\amos\socialauth\Module $social
                         */
                        $social = \Yii::$app->getModule('socialauth');
                        if($social && $social->enableRegister == true ): ?>
                            <p style="margin-bottom: 20px;">
                                <?= AmosAdmin::t('amosadmin', '#welcome_email_social', [
                                    'platformName' => Yii::$app->name
                                ]) ?>
                            </p>
                        <?php endif; ?>
                        <p style="margin-bottom: 20px;">
                            <?= AmosAdmin::t('amosadmin', '#welcome_email_change_data') ?>
                        </p>
                        <p style="text-align: right;margin-bottom: 20px">
                            <?= AmosAdmin::t('amosadmin', '#welcome_email_thanks') ?>
                        </p>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>
