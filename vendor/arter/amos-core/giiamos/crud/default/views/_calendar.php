<?=
"<?php
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
 
use backend\\components\\helpers\\Html; 
    
/*
 * Personalizzare a piacimento la vista
 * \$model è il model legato alla tabella del db
 * \$buttons sono i tasti del template standard {view}{update}{delete}
 * tutto quello che si inserirà qui comparirà dopo il calendario per inserire
 * del codice HTML prima del calendario usare il campo intestazione della
 * configurazione della vista nella pagina index.php
 */
?>
<div class=\"listview-container legenda-calendario\">       
 ############ PERSONALIZZARE IL CALENDARIO CON L&#39;HTML A PIACIMENTO - qui un esempio di legenda, le funzioni non sono implementate di default ##############  
    <div class=\"legenda-calendario-simbolo\" style=\"background-color:<?= \$model->getColoreCategoria() ?>\"></div>
    <div class=\"legenda-calendario-testo\"><?= \$model->getNomeLegenda() ?></div>

</div>"
?>
