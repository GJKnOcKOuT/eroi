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


use arter\amos\events\AmosEvents;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\views\grid\ActionColumn;

/**
 * @var yii\web\View $this
 * @var arter\amos\events\models\EventCalendars $model
 */
$this->title = \arter\amos\events\AmosEvents::t('amosevents', 'Le mie prenotazioni');
if ($event) {
    $this->title .= ' '.Yii::t('amosevents', 'for event').' "'.$event->title.'"';
}
$this->params['breadcrumbs'][] = $this->title;


echo \arter\amos\core\views\AmosGridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'eventCalendars.title',
            'format' => 'html',
            'label' => AmosEvents::t('amosevents', 'Progetto'),
        ],
        [
            'attribute' => 'date',
            'format' => 'date'
        ],
        [
            'attribute' => 'hour_start',
            'format' => 'time'
        ],
        [
            'attribute' => 'hour_end',
            'format' => 'time'
        ],
        [
            'class' => ActionColumn::className(),
            'template' => '{book}',
            'buttons' => [
                'book' => function ($url, $model) {
                    return \yii\helpers\Html::a(\arter\amos\core\icons\AmosIcons::show('calendar-check-o', [],
                                'dash'), ['/events/event-calendars/view', 'id' => $model->eventCalendars->id],
                            [
                            'class' => 'btn btn-primary',
                            'title' => AmosEvents::t('amosevents', "Gestisci appuntamento"),
                    ]);
                }
            ]
        ]
    ]
]);
