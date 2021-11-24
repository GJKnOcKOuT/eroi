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

$appLink = Yii::$app->urlManager->createAbsoluteUrl(['/']);
$appLinkPrivacy = Yii::$app->urlManager->createAbsoluteUrl(['/admin/user-profile/privacy']);
$appName = Yii::$app->name;

?>
<?= AmosAdmin::tHtml('amosadmin', 'Gentile {nome} {cognome},', [
    'nome' => Html::encode($profile->nome),
    'cognome' => Html::encode($profile->cognome)]);
?>
<?= "\n"; ?>
<?= AmosAdmin::tHtml('amosadmin', 'la presente per comunicarle, ai sensi dell’art. 6 dell’AVVISO PUBBLICO “Presentazione domande volte all’inserimento nel Registro dei formatori del Sistema della IeFP della Regione Emilia Romagna, per l’eventuale conferimento di incarichi non a carattere subordinato”, che la sua domanda di inserimento nel Registro dei Formatori risulta formalmente corretta e pertanto accoglibile.\n\nDi seguito troverà le credenziali per accedere alla Piattaforma collaborativa dei Formatori IeFP, dove le verrà richiesto, come primo accesso, il consenso a pubblicare il suo CV ed i suoi dati sulla pagina dedicata.\n\nGrazie della collaborazione.\n\n') ?>
<?= "\n"; ?>
<?= Html::beginTag('a', ['href' => $appLink . 'admin/security/insert-auth-data?token=' . $profile->user->password_reset_token]) ?>
<?= AmosAdmin::t('amosadmin', 'Link di accesso alla piattaforma'); ?>
<?= Html::endTag('a'); ?>
<?= "\n"; ?>
<?= AmosAdmin::t('amosadmin', 'Se il link non funziona copia e incolla il seguente in una finestra del tuo browser di navigazione') ?>
<?= $appLink . 'admin/security/insert-auth-data?token=' . $profile->user->password_reset_token ?>
<?= "\n"; ?>
<?= "\n"; ?>

<?= AmosAdmin::t('amosadmin', '#footer_credential_mail', [
    'appName' => $appName,
    'nome' => $profile->nome,
    'cognome' => $profile->cognome,
    'email' => $profile->user->email,
]) ?>
<?= "\n"; ?>
<?= "\n"; ?>
<?= $appLink; ?>
