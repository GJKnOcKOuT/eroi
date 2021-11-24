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

use arter\amos\slideshow\AmosSlideshow;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var arter\amos\slideshow\models\SlideshowPage $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Slideshow'), 'url' => ['/slideshow']];
if (isset($model->slideshow_id)) {
    $this->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Elenco'), 'url' => ['index', 'slideshowId' => $model->slideshow_id]];
    $this->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Pagine'), 'url' => ['/slideshow/slideshow-page/index', 'slideshowId' => $model->slideshow_id]];
}
$this->params['breadcrumbs'][] = $model;
?>
<div class="slideshow-pages-view col-xs-12">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'pageContent:html',
            'ordinal',
            'slideshow.name' => [
                'attribute' => 'slideshow.name',
                'label' => 'Slideshow'
            ],
            /*[
                'attribute' => 'created_at',
                'format' => ['datetime', (isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['datetime', (isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A'],
            ],
            [
                'attribute' => 'deleted_at',
                'format' => ['datetime', (isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A'],
            ],
            'created_by',
            'updated_by',
            'deleted_by',*/
        ],
    ]) ?>
</div>
