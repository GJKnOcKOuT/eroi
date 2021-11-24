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


use \yii\helpers\Html;

/* @var $panel yii\debug\panels\RouterPanel */

?>
<div class="yii-debug-toolbar__block">
    <a href="<?= $panel->getUrl() ?>" title="Action: <?= Html::encode($panel->data['action']) ?>">Route <span
            class="yii-debug-toolbar__label"><?= Html::encode($panel->data['route']) ?></span></a>
</div>
