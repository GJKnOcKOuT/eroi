<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

use arter\amos\news\AmosNews;
use luya\helpers\Url;
use yii\helpers\Html;
use app\assets\ResourcesAsset;
use app\modules\uikit\assets\FrontAsset;

$resourceAsset = ResourcesAsset::register($this);
FrontAsset::register($this);

$js = <<<JS
windowHeight = $(window).height() - $('.nav-container').outerHeight();
    slider = $('#lightSlider');
    
    slider.lightSlider({
        gallery: true,
        item: 1,
        loop:true,
        slideMargin: 0,
        thumbItem: 4,
        sliderHeight: windowHeight,      
        speed: 1200,
        pause: 4000,
        mode: 'fade'
    });      

$('#lightSlider').find('.lSliderItem').css('height', windowHeight + 'px');
JS;

$this->registerJs($js, $this::POS_READY);
?>

<?= $model->getSchema(); ?>

<!--<a href="< ?= $route = Url::toRoute(['/backendobjects']); ?>">Indietro</a>-->
<?php
$url = $resourceAsset->baseUrl . '/img/img_default.jpg';
$newsImage = $model->getNewsImage();
if (!is_null($newsImage)) {
    $url = $newsImage->getWebUrl('square_large', false, true);
}
if (isset($model->newsCategorie) && !empty($model->newsCategorie)) {

    $classCat = 'cat_community';
}
?>
<div class="wrap-modules">
    <div class="wrap-lightslider gallerySlider">
        <ul id="lightSlider">
            <li class="lSliderItem sliderItemDot">
                <?=
                Html::img($url, [
                    'title' => AmosNews::t('amosnews', 'Immagine della notizia'),
                    'class' => 'el-image uk-cover detail-photo'
                ]);
                ?>

                <div class="caption">
                    <div class="el-content">
                        <div class="<?= $classCat ?>"><p class="category">
                                <span><?= $model->newsCategorie->titolo ?></span></p></div>

                        <h2 class="el-title"><?= $model->getTitle(); ?></h2>

                        <?php if (isset($model->sottotitolo) && !empty($model->sottotitolo)): ?>
                            <p class="el-subtitle"><?= $model->sottotitolo ?></p>
                        <?php endif; ?>

                        <div class="published-details">
                            <!--    $created_by    -->
                            <?php if (isset($model->created_by) && !empty($model->created_by)): ?>
                                <span>di <strong><?= $model->createdUserProfile->nomeCognome ?></strong></span>
                            <?php endif; ?>
                            <?php if (isset($model->data_pubblicazione) && !empty($model->data_pubblicazione)): ?>
                                <span>|</span>
                                <span><?= Yii::$app->getFormatter()->asDate($model->data_pubblicazione) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <div class="nop uk-section-default uk-section">
        <div class="uk-container">
            <div class="row">
                <div class="col-md-12 content-before-sidebar">
                    <div class="capolettera uk-section-default uk-visible@xl uk-section">
                        <?php if (isset($model->descrizione) && !empty($model->descrizione)): ?>
                            <p class=""><?= $model->descrizione ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

