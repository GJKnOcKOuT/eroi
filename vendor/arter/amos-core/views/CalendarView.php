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
 * @package    arter\amos\core\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\views;

use arter\amos\core\views\common\BaseListView;
use Yii;
use yii\helpers\Html;

class CalendarView extends BaseListView
{
    public $events               = [];
    public $titolo               = null;
    public $intestazione         = null; //contenuti html caricati ad inizio pagina prima del calendario - intestazioni o altro
    public $replace              = [];
    public $array                = false; //se array è settato verrà ignorato $eventConfig e si userà solo $getEventi
    public $getEventi            = 'getEvents';
    public $layout               = "{summary}\n{items}\n{pager}";
    public $disablePagination    = true;
    public $defaultClientOptions = [
    ];
    public $clientOptions        = [
    ];
    public $eventConfig          = [
        'id' => 'id',
        'title' => 'titolo',
        'start' => 'data_inizio',
        'end' => 'data_fine',
        'color' => 'colore',
        'url' => 'url',
    ];

    public function init()
    {
        parent::init();

        $this->defaultClientOptions = [
            'lang' => Yii::$app->language == 'it-IT' ? 'it' : Yii::$app->language,
        ];

        $this->setClientOptions(\yii\helpers\ArrayHelper::merge($this->defaultClientOptions, $this->getClientOptions()));
        if ($this->disablePagination == true) {
            $this->dataProvider->setPagination(false);
        }
        $models = $this->dataProvider->getModels();
        $keys   = $this->dataProvider->getKeys();

        $this->setEvents($this->initEvents($models));
    }

    public function getClientOptions()
    {
        return $this->clientOptions;
    }

    public function setClientOptions(array $clientOptions)
    {
        $this->clientOptions = $clientOptions;
    }

    public function initEvents($models)
    {

        $events = [];
        if ($this->array) {
            foreach ($models as $model) {
                foreach ($model->{$this->getEventi}() as $Event) {
                    $events[] = $Event;
                }
            }
        } else {
            foreach ($models as $model) {
                $Event = new \yii2fullcalendar\models\Event();
                foreach ($this->eventConfig as $kEvent => $vEvent) {
                    $Event->{$kEvent} = $model[$vEvent];
                }
                $events[] = $Event;
            }
        }
        return $events;
    }

    public function run()
    {
        $intestazione = $this->intestazione; //contenuti html caricati ad inizio pagina prima del calendario
        $content      = $this->renderItems(); //contenuti caricati in fondo alla pagina legati al model come la legenda per esempio
        $options      = $this->itemOptions;
        return Html::tag('div', $intestazione).AmosFullCalendar::widget([
                'options' => $this->getClientOptions(),
                'clientOptions' => $this->getClientOptions(),
                'events' => $this->getEvents(),
            ]).Html::tag('div', $content, $options);
    }

    /**
     * Renders all data models.
     * @return string the rendering result
     */
    public function renderItems()
    {
        if ($this->disablePagination == true) {
            $this->dataProvider->setPagination(false);
        }
        $models  = $this->dataProvider->getModels();
        $keys    = $this->dataProvider->getKeys();
        $content = [];
        foreach (array_values($models) as $index => $model) {
            $content[] = $this->renderItem($model, $keys[$index], $index);
        }
        $itemsHtml = Html::tag($this->itemsContainerTag, implode("\n", $content), $this->itemsContainerOptions);
        return Html::tag('div', $itemsHtml, $this->containerOptions);
    }

    public function getEvents()
    {
        return $this->events;
    }

    public function setEvents(array $events)
    {
        $this->events = $events;
    }
}