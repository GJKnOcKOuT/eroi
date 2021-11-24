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

use yii\helpers\Html;

/* @var $this \yii\web\View */

$js = $this->registerJs('
// Full Screen Slider
(function () {
    // $(".bg-fullHeight").height($(window).height()-$("footer").outerHeight()-$(".header-wrapper").outerHeight()); // TODO FIX
    $(".bg-fullHeight").height($(window).height());

    $(window).resize(function(){
        $(".bg-fullHeight").height($(window).height()-$("footer").outerHeight()-$(".header-wrapper").outerHeight());
    });
}());
');
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <?= $this->render("parts".DIRECTORY_SEPARATOR."head"); ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <!-- BEGIN: header  -->
    <div class="header-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="logo text-center">
                        <?=
                        /** @var string $logo */
                        $logo = isset(Yii::$app->params['logo']) ?
                            Html::img(Yii::$app->params['logo'], [
                                'class' => 'logo-under-construction',
                                'alt' => 'logo ' . Yii::$app->name
                            ])
                            : Html::encode($this->title);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: header  -->

    <section class="under-construction bg-fullHeight">
        <?= $content ?>
    </section>

    <?= $this->render("parts".DIRECTORY_SEPARATOR."footer"); ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>