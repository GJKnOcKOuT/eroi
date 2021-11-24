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
 */


$jsAjax = <<<JS

$('body').on('click', '.fc-basicDay-view .fc-content', function (e) {
	
    //e.preventDefault();
	
	var attrId = $(this).attr('id');
    var attrIdSplit = attrId.split('-');
	var id = attrIdSplit[attrIdSplit.length-1];
	
	location.href = window.location.origin + '/events/event/view?id=' + id;
	
    /*
    $.pjax({
	    type: "POST",
	    url: "events/event/event-calendar-widget#container-calendary",
	    data: { id:  id},
	    push: false,
	    container: '#event-calendar-pjax'
    });*/
 });

JS;
$this->registerJs($jsAjax, View::POS_READY);
?>

