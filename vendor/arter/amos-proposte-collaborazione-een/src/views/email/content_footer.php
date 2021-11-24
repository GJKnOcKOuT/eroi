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
 * @package    arter\amos\een\views\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\een\AmosEen;

/**
 * @var integer $contents_number
 */

?>

<div style="box-sizing:border-box;color:#000000;">
    <p style="font-size:1em;margin:0;margin-top:5px;">
        <?php
        $url = "<a href='" . Yii::$app->urlManager->createAbsoluteUrl(['/']) . "'>" . AmosEen::t('amoseen', '#Access_to_platform') . "</a>";
        echo AmosEen::t('amoseen', '#Receive_this_notify', [$url]) ?>
    </p>
</div>