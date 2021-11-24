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

/* @var $panel yii\debug\panels\ProfilingPanel */
/* @var $time int */
/* @var $memory int */
?>
<div class="yii-debug-toolbar__block">
    <a href="<?= $panel->getUrl() ?>" title="Total request processing time was <?= $time ?>">Time <span
            class="yii-debug-toolbar__label yii-debug-toolbar__label_info"><?= $time ?></span></a>
    <a href="<?= $panel->getUrl() ?>" title="Peak memory consumption">Memory <span
            class="yii-debug-toolbar__label yii-debug-toolbar__label_info"><?= $memory ?></span></a>
</div>
