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
 * @package    retecomuni\frontend\views\site\parts
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

?>

<div class="calendary">
    <?= \arter\amos\core\views\CalendarView::widget([
        'dataProvider' => $events,
        'itemView' => '_calendar',
        'clientOptions' => [
            'locale' => 'IT',
            'buttonText' => [
                'month' => 'Mese'
            ],
            'height' => 'auto',
            'navLinks' => true,
            'header' => [
                'left' => 'prev,next',
                'center' => 'title',
                'right' => 'month'
            ],
            'dayNamesShort' => ['Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab'],
            'eventBackgroundColor' => '#FC511D',
        ],
        'eventConfig' => [
            'id' => 'id',
            'title' => 'eventTitle',
            'start' => 'begin_date_hour',
            'end' => 'end_date_hour',
            'color' => 'eventColor',
            'url' => 'eventUrl',
        ],
        'array' => false,
        //se ci sono più eventi legati al singolo record
        //'getEventi' => 'getEvents'//funzione da abilitare e implementare nel model per creare un array di eventi legati al record
    ]) ?>
</div>
