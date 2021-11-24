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
 * @package    arter\amos\core\views\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * @var string $message
 * @var string $nameUser
 */
use arter\amos\core\module\BaseAmosModule;
if(!isset($email)){
    $email = Yii::$app->user->email;
}
?>

<?= $nameUser . ' '. BaseAmosModule::t('amoscore', '#request_information_mail') ?>
<?= $message ?>
<?= BaseAmosModule::t('amoscore', '#request_information_mail_footer') . ' '. $email ?>

