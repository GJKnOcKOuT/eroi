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

use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\views\DataProviderView;
use arter\amos\slideshow\AmosSlideshow;

/**
 * @var yii\web\View $this
 * @var string $currentView
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\slideshow\models\search\SlideshowSearch $model
 */
$this->title = AmosSlideshow::t('amosslideshow', 'Elenco');
$this->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Slideshow'), 'url' => ['/slideshow']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slideshow-index">
    <?php // echo $this->render('_search', ['model' => $model]);  ?>

    <?php
    echo DataProviderView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $model,
        'currentView' => $currentView,
        'gridView' => [
            'columns' => [
                'name',
                'description:ntext',
                'label',
                'slideshowRoutes.already_view:statosino',
                'slideshowRoutes.route',
                'slideshowRoutes.role',
                [
                    'class' => 'arter\amos\core\views\grid\ActionColumn',
                    'template' => '{manageIndicators}{view}{update}{delete}',
                    'buttons' => [
                        'manageIndicators' => function ($url, $model) {
                            $createUrlParams = [
                                '/slideshow/slideshow-page/index',
                                'slideshowId' => $model['id']
                            ];
                            $btn = '';
                            if (Yii::$app->getUser()->can('MANAGE_SLIDESHOWPAGES')) {
                                $btn = Html::a(AmosIcons::show('collection-text', ['class' => '']), Yii::$app->urlManager->createUrl($createUrlParams), ['title' => AmosSlideshow::t('amosslideshow', 'Gestisci le pagine'), 'class' => 'btn btn-tool-secondary']);
                            }
                            return $btn;
                        }
                    ]
                ],
            ],
        ],
        /*
          'listView' => [
          'itemView' => '_item'
          'masonry' => FALSE,

          // Se masonry settato a TRUE decommentare e settare i parametri seguenti
          // nel CSS settare i seguenti parametri necessari al funzionamento tipo
          // .grid-sizer, .grid-item {width: 50&;}
          // Per i dettagli recarsi sul sito http://masonry.desandro.com

          //'masonrySelector' => '.grid',
          //'masonryOptions' => [
          //    'itemSelector' => '.grid-item',
          //    'columnWidth' => '.grid-sizer',
          //    'percentPosition' => 'true',
          //    'gutter' => '20'
          //]
          ],
          'iconView' => [
          'itemView' => '_icon'
          ],
          'mapView' => [
          'itemView' => '_map',
          'markerConfig' => [
          'lat' => 'domicilio_lat',
          'lng' => 'domicilio_lon',
          'icon' => 'iconaMarker',
          ]
          ],
          'calendarView' => [
          'itemView' => '_calendar',
          'clientOptions' => [
          //'lang'=> 'de'
          ],
          'eventConfig' => [
          //'title' => 'titoloEvento',
          //'start' => 'data_inizio',
          //'end' => 'data_fine',
          //'color' => 'coloreEvento',
          //'url' => 'urlEvento'
          ],
          'array' => false,//se ci sono pi?? eventi legati al singolo record
          //'getEventi' => 'getEvents'//funzione da abilitare e implementare nel model per creare un array di eventi legati al record
          ]
         */
    ]);
    ?>

</div>
