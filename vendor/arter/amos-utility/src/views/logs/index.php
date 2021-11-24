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

/**@var $this \yii\web\View */
/**@var $content string */
?>
<div class="container">
    <h1>Logs</h1>
    <?php /*pr($log,'LOG');*/ ?>
    <?php
    //Parse error lines
    foreach($matches as $match) {
        pr($match, 'Match');
        //Parse Sub blocks
        foreach($match as $block) {
            pr($block,'Block');
        }
    }
    ?>
</div>