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
 * @package    arter\amos\core
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/* @var $this \yii\web\View */
/* @var $content string */

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "head"); ?>
</head>
<body>

<?php $this->beginBody() ?>

<div class="login-page col-lg-4 col-md-6 col-sm-6 col-xs-12 col-lg-push-4 col-md-push-3 col-sm-push-3 nop">

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "messages"); ?>

    <div class="col-xs-12 dropdown-languages">
        <?php
        $headerMenu = new \arter\amos\core\views\common\HeaderMenu();
        $menuLang = $headerMenu->getListLanguages();
        echo $menuLang;
        ?>
    </div>
    <div class="clearfix"></div>

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "logo_login"); ?>

    <?= $content ?>

</div>

<div class="clearfix"></div>

<?= $this->render("parts" . DIRECTORY_SEPARATOR . "sponsors"); ?>

<?= $this->render("parts" . DIRECTORY_SEPARATOR . "footer_text"); ?>

<?= $this->render("parts" . DIRECTORY_SEPARATOR . "assistance"); ?>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
