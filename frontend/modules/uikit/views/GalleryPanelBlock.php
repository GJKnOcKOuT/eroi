<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

use app\modules\uikit\assets\FrontAsset;
use yii\web\View;
use app\modules\uikit\Uikit;


/**
 * @var $this object
 * @var $data array
 */

$attrs = $data['attrs'];

//gallery with thumb
if (!empty($data['showthumb'])) {
    $classGallery = ' galleryThumb';
}else {
    $classGallery = ' gallerySlider';
}

//gallery NO thumb
if (!empty($data['class'])) {
    $class = 'wrap-lightslider '. $data['class'] . $classGallery;
}else {
    $class = 'wrap-lightslider '. $classGallery;
}

$controls = $data['showactions'] ? 'true' : 'false';
$gallery = $data['gallery'] ? 'true' : 'false';

if($gallery == 'true') {
    $class = $class. ' isGalleryClass';
}

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
        speed: 120,
        pause: 4000,
        mode: 'fade'
    });
    
    $('.play-btn').click(function(){
        slider.play();
    });
    $('.pause-btn').click(function(){
        slider.pause();
    });

    $('#lightSlider').find('.lSliderItem').css('height', windowHeight + 'px');
JS;

$this->registerJs($js, View::POS_READY);
?>

<div <?= Uikit::attrs(compact('class'), $attrs) ?>>
    <ul id="lightSlider">
        <?php foreach ($data['items'] as $item) : ?>
            <?= $this->render('gallerypanel/item', compact('item', 'data')) ?>
        <?php endforeach ?>
    </ul>

    <?php if($controls  == 'true'): ?>
        <div class="lightSliderAction">
            <span class="am am-play play-btn"></span>
            <span class="am am-pause pause-btn"></span>
        </div>
    <?php endif; ?>
</div>