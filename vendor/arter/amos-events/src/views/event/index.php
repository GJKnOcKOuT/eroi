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
 * @package    arter\amos\events\views\event
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\utilities\ModalUtility;
use arter\amos\core\views\DataProviderView;
use arter\amos\events\AmosEvents;
    
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\events\models\search\EventSearch $model
 * @var string $currentView
 */

$js = "
$('.reject-btns').on('click', function(event) {
    event.preventDefault();
    var hrefValue = $(this).attr('href');
    var visibleInCalendar = confirm(\"" . AmosEvents::t('amosevents', "Is the event still to be visible in the calendar even during the edit") . "?\");
    this.href = hrefValue + '&visibleInCalendar=' + (visibleInCalendar ? 1 : 0);
    window.location.href = this.href;
});
";
$this->registerJs($js, View::POS_READY);

/** @var AmosEvents $eventsModule */
$eventsModule = Yii::$app->getModule(AmosEvents::getModuleName());

?>
<div class="event-index">
<?php

    echo $this->render('_search', ['model' => $model,'originAction' => Yii::$app->session->get('previousUrl')]);
    echo $this->render('_order', ['model' => $model,'originAction' => Yii::$app->session->get('previousUrl')]);

    $actionColumnDefault = '{view}{update}{delete}';
    $actionColumnToPublish = '{publish}{reject}';
    $actionColumnManager = '{community}';
    $actionColumn = $actionColumnDefault;
    if (isset($addActionColumns)) {
        switch ($addActionColumns) {
            case 'toPublish' :
                $actionColumn = $actionColumnToPublish . $actionColumn;
                break;
            case 'management' :
                $actionColumn = $actionColumnManager;
                break;
        }
    }
    
    echo DataProviderView::widget([
        'dataProvider' => $dataProvider,
        'currentView' => $currentView,
        'gridView' => [
            'columns' => [
                'title',
                'event_type_id' => [
                    'attribute' => 'event_type_id',
                    'label' => $model->getAttributeLabel('eventType'),
                    'value' => 'eventType.title'
                ],
                'status' => [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        return $model->getWorkflowBaseStatusLabel();
                    }
                ],
                'begin_date_hour:datetime',
                [
                    'class' => 'arter\amos\core\views\grid\ActionColumn',
                    'template' => $actionColumn,
                    'buttons' => [
                        'publish' => function ($url, $model) {
                            $createUrlParams = [
                                '/events/event/validate',
                                'id' => $model['id']
                            ];
                            $btn = '';
                            if ((Yii::$app->getUser()->can('EVENTS_VALIDATOR')) || (Yii::$app->getUser()->can('PLATFORM_EVENTS_VALIDATOR'))) {
                                $btn = Html::a(AmosIcons::show(
                                    'check-circle', 
                                    ['class' => 'btn btn-tool-secondary']), 
                                    Yii::$app->urlManager->createUrl($createUrlParams), 
                                    ['title' => AmosEvents::t('amosevents', 'Publish')]
                                );
                            }
                            return $btn;
                        },
                        'reject' => function ($url, $model) {
                            /** @var \arter\amos\events\models\Event $model */
                            $createUrlParams = [
                                '/events/event/reject',
                                'id' => $model['id']
                            ];
                            $btn = '';
                            if ((Yii::$app->getUser()->can('EVENTS_VALIDATOR')) || (Yii::$app->getUser()->can('PLATFORM_EVENTS_VALIDATOR'))) {
                                $btn = Html::a(AmosIcons::show(
                                    'minus-circle', 
                                    ['class' => 'btn btn-tool-secondary']), 
                                    Yii::$app->urlManager->createUrl($createUrlParams), 
                                    ['title' => AmosEvents::t('amosevents', 'Reject'), 
                                        'class' => 'reject-btns']
                                );
                            }
                            return $btn;
                        },
                        'community' => function ($url, $model) {
                            $btn = '';
                            if (isset($model->community_id)) {
                                $createUrlParams = [
                                    '/community/join',
                                    'id' => $model['community_id']
                                ];
                                $btn = Html::a(AmosIcons::show(
                                    'group', 
                                    ['class' => 'btn btn-tool-secondary']), 
                                    Yii::$app->urlManager->createUrl($createUrlParams),
                                    ['title' => AmosEvents::t('amosevents', 'Join the community')]
                                );
                            }
                            return $btn;
                        },
                        'update' => function ($url, $model) {
                            /** @var \arter\amos\events\models\Event $model */
                            $btn = '';
                            if (Yii::$app->user->can('EVENT_UPDATE', ['model' => $model])) {
                                $action = '/events/event/update?id=' . $model->id;
                                $options = ModalUtility::getBackToEditPopup(
                                    $model,
                                    'EventValidate',
                                    $action,
                                    ['class' => 'btn btn-tool-secondary']
                                );
                                $btn = Html::a(AmosIcons::show('edit'), $action, $options);
                            }
                            return $btn;
                        }
                    ]
                ]
            ],
            'enableExport' => $eventsModule->enableExport
        ],
        /*'listView' => [
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
        ],*/
        'calendarView' => [
            'itemView' => '_calendar',
            'options' => [
                'lang' => 'it',
            ],
            'eventConfig' => [
                'id' => 'id',
                'title' => 'eventTitle',
                'start' => 'begin_date_hour',
                'end' => 'end_date_hour',
                'color' => 'eventColor',
                'url' => 'eventUrl'
            ],
            'array' => false,//se ci sono più eventi legati al singolo record
            //'getEventi' => 'getEvents'//funzione da abilitare e implementare nel model per creare un array di eventi legati al record
        ]
    ]); ?>
</div>
