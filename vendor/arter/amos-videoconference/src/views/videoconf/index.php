<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use arter\amos\core\helpers\Html;
use arter\amos\core\views\DataProviderView;
use arter\amos\core\utilities\ViewUtility;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\utilities\ModalUtility;
use arter\amos\videoconference\AmosVideoconference;

use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\VideoconfSearch $model
 */
$actionColumn = '{join}{view}{update}{delete}';

$this->title = AmosVideoconference::t('amosvideoconference', 'Videoconferenza');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videoconf-index">
    <?php // echo $this->render('_search', ['model' => $model]);  ?>

    <p>
        <?php /* echo Html::a(AmosVideoconference::t('amosvideoconference', 'Nuova videoconferenza istantanea', [
          'modelClass' => 'Videoconf',
          ]), ['create'], ['class' => 'btn btn-amministration-primary'])
         */ ?>
    </p>

    <?php
    //pr(Yii::$app->formatter);
    echo DataProviderView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $model,
        'currentView' => $currentView,
        'gridView' => [
            //'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                'title',
                'description:html',
                [
                    'label' => AmosVideoconference::t('amosvideoconference', 'Num. Partecipanti'),
                    'value' => function ($model){
                        return count($model->videoconfUsersMms);
                    },
                ],
                /*  [
                  'attribute' => 'begin_date_hour',
                  'format' => 'datetime'
                  ],
                  [
                  'attribute' => 'end_date_hour',
                  'format' => 'datetime'
                  ], */
                //'status',
                [
                    'attribute' => 'begin_date_hour',
                    'format' => 'html',
                    'value' => function ($model) {
                        if ($model->begin_date_hour) {
                            return Yii::$app->formatter->asDatetime($model->begin_date_hour, ViewUtility::formatDateTime());
                        }
                        
                        return '';
                    }
                ],
                [
                    'attribute' => 'end_date_hour',
                    'format' => 'html',
                    'value' => function ($model) {
                        if ($model->end_date_hour) {
                            return Yii::$app->formatter->asDatetime($model->end_date_hour, ViewUtility::formatDateTime());
                        }
                        
                        return '';
                    }
                ],
               //  ['attribute'=>'created_at','format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']], 
//            ['attribute'=>'updated_at','format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']], 
//            ['attribute'=>'deleted_at','format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']], 
//            'created_by', 
//            'updated_by', 
//            'deleted_by', 
                [
                    'class' => 'arter\amos\core\views\grid\ActionColumn',
                    'template' => $actionColumn,
                    'buttons' => [
                        'join' => function ($url, $model) {
                            if ($model->isVideoConferenceRoomActive()) {
                                $action = '/videoconference/videoconf/meet?id_room=' . $model->id_room_videoconference;
                                $options = [
                                    'title' => AmosVideoconference::t('amosvideoconference', 'Entra nella videoconferenza'),
                                    'class' => 'bk-btnMore',
                                ];
                                return Html::a(AmosIcons::show('videocam', ['class' => 'btn btn-tool-secondary']), $action, $options);
                            }
                        },
                    ]
                ],
            ],
        ],
            /* 'listView' => [
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
              'array' => false,//se ci sono più eventi legati al singolo record
              //'getEventi' => 'getEvents'//funzione da abilitare e implementare nel model per creare un array di eventi legati al record
              ] */
    ]);
    ?>

</div>
