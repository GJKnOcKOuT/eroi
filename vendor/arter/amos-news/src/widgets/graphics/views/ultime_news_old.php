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
 * @package    arter\amos\news\widgets\graphics\views
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

/**
 * @var View $this
 * @var ActiveDataProvider $listaNews
 * @var WidgetGraphicsUltimeNews $widget
 * @var string $toRefreshSectionId
 */

$moduleNews = \Yii::$app->getModule(AmosNews::getModuleName());
?>

<div class="box-widget">
    <div class="box-widget-toolbar row nom">
        <h1 class="box-widget-title col-xs-10 nop"><?= AmosNews::t('amosnews', 'Ultime notizie') ?></h1>
        <?php
        if(isset($moduleNews) && !$moduleNews->hideWidgetGraphicsActions) {
            echo WidgetGraphicsActions::widget([
                'widget' => $widget,
                'tClassName' => AmosNews::className(),
                'actionRoute' => '/news/news/create',
                'toRefreshSectionId' => $toRefreshSectionId
            ]);
        } ?>
    </div>
    <section>
        <h2 class="sr-only"><?= AmosNews::t('amosnews', 'Ultime notizie') ?></h2>
        <?php Pjax::begin(['id' => $toRefreshSectionId]); ?>
        <div role="listbox">
            <?php
            if (count($listaNews->getModels()) == 0):
//                echo '<div class="list-items"><h2 class="box-widget-subtitle">Nessuna notizia</h2></div>';
                $out  = '<div class="list-items"><h2 class="box-widget-subtitle">';
                $out .= AmosNews::t('amosnews', 'Nessuna notizia');
                $out .= '</h2></div>';
                echo $out;
            else:
                ?>
                <div class="list-items">
                    <?php
                    foreach ($listaNews->getModels() as $news):
                        /** @var News $news */
                        ?>
                        <div class="widget-listbox-option row" role="option">
                            <article class="col-xs-12 nop">
                                <div class="container-img">
                                    <?php
                                    $url = '/img/img_default.jpg';
                                    if (!is_null($news->newsImage)) {
                                        $url = $news->newsImage->getUrl('square_small',[
                                            'class'=>'img-responsive'
                                        ]);
                                    }
                                    ?>
                                    <?= Html::img($url, ['class' => 'img-responsive', 'alt' => AmosNews::t('amosnews', 'Immagine della notizia')]); ?>
                                </div>
                                <div class="container-text row">
                                    <div class="col-xs-12 nopl">
                                        <p><?= Yii::$app->getFormatter()->asDatetime($news->created_at); ?></p>
                                        <h2 class="box-widget-subtitle">
                                            <?php
                                            if (strlen($news->titolo) > 60) {
                                                $stringCut = substr($news->titolo, 0, 60);
                                                echo substr($stringCut, 0, strrpos($stringCut, ' ')) . '... ';
                                            } else {
                                                echo $news->titolo;
                                            }
                                            ?>
                                        </h2>
                                    </div>
                                  <div class="col-xs-12 nopl">
                                       <p class="box-widget-text">
                                        <?php
                                        if (strlen($news->descrizione_breve) > 150) {
                                            $stringCut = substr($news->descrizione_breve, 0, 150);
                                            echo substr($stringCut, 0, strrpos($stringCut, ' ')) . '... ';
                                        } else {
                                            echo $news->descrizione_breve;
                                        }
                                        ?>
                                      </p>
                                    </div>
                                </div>
                                <div class="col-xs-12 m-t-5 nop">
                                <span class="pull-right">
                                    <?= Html::a(AmosNews::t('amosnews', 'LEGGI'), ['/news/news/view', 'id' => $news->id], ['class' => 'btn btn-navigation-primary']); ?>
                                </span>
                                </div>
                            </article>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
                <?= Html::a(AmosNews::t('amosnews', 'Visualizza Elenco News'), ['/news/news/all-news'], ['class' => 'read-all']); ?>
                <?php
            endif;
            ?>
        </div>
        <?php Pjax::end(); ?>
    </section>
</div>