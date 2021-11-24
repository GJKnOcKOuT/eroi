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
 * @package    arter\amos\sondaggi\views\sondaggi
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
    
/*
 * Personalizzare a piacimento la vista
 * $model è il model legato alla tabella del db
 * $buttons sono i tasti del template standard {view}{update}{delete}
 */
?>

<div id="listViewListContainer">       
        ############ PERSONALIZZARE A PIACIMENTO L'HTML ##############
        <div class="bk-listViewElement-info">
            <h2><?= $model ?></h2>            
            <?= $buttons ?>
            <div class="clear"></div>            
        </div>   
</div>