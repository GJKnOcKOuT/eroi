<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_news\widgets\graphics\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\WidgetGraphicsActions;
use arter\amos\news\AmosNews;
use arter\amos\news\models\News;
use arter\amos\news\widgets\graphics\WidgetGraphicsUltimeNews;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;
use arter\amos\news\assets\ModuleNewsAsset;
use arter\amos\core\icons\AmosIcons;
use kv4nt\owlcarousel\OwlCarouselWidget;

ModuleNewsAsset::register($this);

/**
 * @var View $this
 * @var ActiveDataProvider $listaNews
 * @var WidgetGraphicsUltimeNews $widget
 * @var string $toRefreshSectionId
 */

$moduleNews = \Yii::$app->getModule(AmosNews::getModuleName());

?>
<div class="box-widget-header">
    <?php
    if (isset($moduleNews) && !$moduleNews->hideWidgetGraphicsActions) {
        echo WidgetGraphicsActions::widget([
            'widget' => $widget,
            'tClassName' => AmosNews::className(),
            'actionRoute' => '/news/news/create',
            'toRefreshSectionId' => $toRefreshSectionId
        ]);
    } ?>

    <div class="box-widget-wrapper">
        <h2 class="box-widget-title">
            <?= AmosIcons::show('news', ['class' => 'am-2'], AmosIcons::IC)?>
            <?= AmosNews::tHtml('amosnews', 'Ultime notizie') ?>
        </h2>
    </div>


    <?php
    if (count($listaNews->getModels()) == 0):
        $textReadAll = AmosNews::t('amosnews', '#addNews');
        $linkReadAll = ['/news/news/create'];
    else:
        $textReadAll = AmosNews::t('amosnews', '#showAll') . AmosIcons::show('chevron-right');
        $linkReadAll = ['/news/news/all-news'];
    endif;
    ?>
    <div class="read-all"><?= Html::a($textReadAll, $linkReadAll, ['class' => '']); ?></div>
</div>

<div class="box-widget latest-news">
    <section class="<?=(count($listaNews->getModels()) == 0) ? '' : 'list-news-full'?>">
        <?php Pjax::begin(['id' => $toRefreshSectionId]); ?>
        <?php if (count($listaNews->getModels()) == 0): ?>
            <div class="list-items list-empty"><h3><?= AmosNews::t('amosnews', 'Nessuna notizia') ?> </h3></div>
        <?php else:
            $configuration = [
                'containerOptions' => [
                    'id'=> 'newsOwlCarouselTouch'
                ],
                'pluginOptions'    => [
                    'autoplay'          => false,
                    'items'             => 2,
                    'loop'              => true,
                    'nav'               => true,
                    'dots'              => true,
                    'dotsEach'          => 1,
                    'margin'            => 10,
                ]
            ];

            OwlCarouselWidget::begin($configuration);

            /** @var News $news */
            $news = $listaNews->getModels();
            $lenghtNews = count($news);

            for($i = 0; $i < $lenghtNews; $i++) : ?>
                <div class="wrap-slide-carousel-box touch">
                    <?php   $newsSingola = $news[$i]; ?>
                    <div class="wrap-item-carousel-box" data-index="<?=($i)?>">
                        <a href="<?= $newsSingola->getFullViewUrl() ?>" title="<?= AmosNews::t('amosnews', 'Immagine della notizia') ?>">
                            <?php
                            $url = '/img/img_default.jpg';
                            if (!is_null($newsSingola->newsImage)) {
                                $url = $newsSingola->newsImage->getUrl('dashboard_news',false,true);
                            }
                            ?>
                            <?= Html::img($url, ['class' => 'img-responsive', 'alt' => AmosNews::t('amosnews', 'Immagine della notizia')]); ?>
    
                            <div class="abstract">
                                <div class="box-widget-info-top">
                                    <div class="listbox-label"><?=$newsSingola->category->titolo;?></div>
                                    <?php if (isset($moduleNews) && !$moduleNews->hidePubblicationDate): ?>
                                        <p><?= Yii::$app->getFormatter()->asDate($newsSingola->data_pubblicazione); ?></p>
                                    <?php endif; ?>
                                </div>
    
                                <?=Html::a('<h2 class="box-widget-subtitle">'. $newsSingola->titolo .'</h2>',
                                    ['../news/news/view', 'id' => $newsSingola->id]); ?>
    
                                <p class="box-widget-text">
                                    <?php
                                    if (strlen($newsSingola->descrizione_breve) > 200) {
                                        $stringCut = substr($newsSingola->descrizione_breve, 0, 200);
                                        echo substr($stringCut, 0, strrpos($stringCut, ' ')) . '... ';
                                    } else {
                                        echo $newsSingola->descrizione_breve;
                                    }
                                    ?>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endfor; ?>
            <?php OwlCarouselWidget::end(); ?>

        <?php endif; ?>
        <?php Pjax::end(); ?>
    </section>
</div>
