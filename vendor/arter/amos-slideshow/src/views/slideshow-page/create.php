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
 * @package    arter\amos\slideshow
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * @var yii\web\View $this
 * @var arter\amos\slideshow\models\SlideshowPage $model
 */

use arter\amos\slideshow\AmosSlideshow;

$this->title = AmosSlideshow::t('amosslideshow', 'Crea');/*
$this->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Slideshow'), 'url' => ['/slideshow']];
if (isset($model->slideshow_id)) {
    $this->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Elenco'), 'url' => ['index', 'slideshowId' => $model->slideshow_id]];
    $this->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Pagine'), 'url' => ['/slideshow/slideshow-page/index', 'slideshowId' => $model->slideshow_id]];
}
$this->params['breadcrumbs'][] = AmosSlideshow::t('amosslideshow', 'Crea');*/
?>
<div class="slideshow-pages-create">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
