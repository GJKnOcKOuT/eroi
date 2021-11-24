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
 * @package    arter\amos\events
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\bootstrap\Modal;
use yii\web\View;

/*
 * Personalizzare a piacimento la vista
 * $model è il model legato alla tabella del db
 * $buttons sono i tasti del template standard {view}{update}{delete}
 * tutto quello che si inserirà qui comparirà dopo il calendario per inserire
 * del codice HTML prima del calendario usare il campo intestazione della
 * configurazione della vista nella pagina index.php
 */
/**
 * @var \arter\amos\events\models\Event $model
 * @var $this View
 */

// Modal render for each event (previous code)
/*
$jsAjax = <<<JS

$('body').on('click', '.fc-content', function (e) {
    $.ajax({
	    type: "POST",
	    url: "get-event-by-id",
	    data: { id: $(this).attr('id') },
	    cache: false,
	    success: function(response){
            $('#event-modal-body').html(response);
            $('#event-modal').modal('show');
    	}
    });
});

JS;

$this->registerJs($jsAjax, View::POS_READY);

// END PHP TAG
?
>
<div class="event-modal">
    <?php
    Modal::begin([
        'options' => [
            'id' => 'event-modal',
            'tabindex' => false,
        ],
        'size' => Modal::SIZE_LARGE,
        'header' => '<span class="event-modal-title"></span>',
    ]);
    ?>
    <div class="event-modal-body" id="event-modal-body"></div>
    <?php
    Modal::end();
    ?>
</div>

*/

// Open the event page directly without modals
$this->registerJs(<<<JS
    $('body').on('click', '.fc-content', function (e) {
        var elemId = $(this).attr('id').toString();
        if(elemId !== undefined && elemId !== "") {
            eventId = elemId.split("-")[2];
            window.open("/events/event/view?id=" + eventId, "_self");
        }
    });
JS
    );

?>