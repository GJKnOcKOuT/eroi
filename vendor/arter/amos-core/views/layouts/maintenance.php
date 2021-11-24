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
 * @package    arter\amos\core\views\layouts
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
//\arter\amos\audit\web\JSLoggingAsset::register($this);
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <?= $this->render("parts".DIRECTORY_SEPARATOR."head"); ?>
    </head>
    <body class="maintenance">

        <?php $this->beginBody() ?>
    
            <div class="container-header">
                <?= $this->render("parts".DIRECTORY_SEPARATOR."header"); ?>
            </div>

            <div class="container-logo">
                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "logo"); ?>
            </div>
    
            <?php if (isset(Yii::$app->params['logo-bordo'])): /*&& \Yii::$app->params['logo-bordo'] == TRUE)*/ ?>
                <div class="container-bordo-logo"><img src="<?=Yii::$app->params['logo-bordo']?>" alt=""></div>
            <?php endif; ?>
    
            <section id="bk-page">
                <div class="container-messages">
                    <?= $this->render("parts".DIRECTORY_SEPARATOR."messages"); ?>
                </div>
                
                <div class="container">
                    <div class="page-content">
                        <?= $this->render("parts".DIRECTORY_SEPARATOR."breadcrumb"); ?>
                        <div class="page-header">
                            <h1 class="title"><?= Html::encode($this->title) ?></h1>
                            <?= $this->render("parts" . DIRECTORY_SEPARATOR . "textHelp"); ?>
                        </div>
                        <?= $content ?>
                    </div>
                </div>
        
            </section>

        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "sponsors"); ?>
        <?= $this->render("parts".DIRECTORY_SEPARATOR."footer"); ?>
    
        <?php $this->endBody() ?>

    </body>
</html>
<?php $this->endPage() ?>