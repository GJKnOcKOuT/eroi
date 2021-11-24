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
 * @package    arter\amos\layout
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
<section id="bk-page">

    <div class="container">

        <div class="page-content">

            <div class="page-header">
                <?php if (!is_null($this->title)): ?>
                    <h1 class="title"><?= \arter\amos\core\helpers\Html::encode($this->title) ?></h1>
                    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "textHelp"); ?>
                <?php endif; ?>
            </div>

            <?php if ($this instanceof \arter\amos\core\components\AmosView): ?>
                <?php $this->beginViewContent() ?>
            <?php endif; ?>
            <?= $content ?>
            <?php if ($this instanceof \arter\amos\core\components\AmosView): ?>
                <?php $this->endViewContent() ?>
            <?php endif; ?>
        </div>
    </div>

</section>
<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
