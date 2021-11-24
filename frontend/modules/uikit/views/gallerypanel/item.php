<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

use trk\uikit\Uikit;
?>
<?php
if ($data['showthumb']) {
    ?>
    <li class="lSliderItem sliderItemThumb" data-thumb="<?= $item['image'] ?>"
        data-caption="<?= base64_encode($item['thumbcontent']) ?>">
            <?php
        } else {
            ?>
    <li class="lSliderItem sliderItemDot">
        <?php }
    ?>
    <img src="<?= $item['image'] ?>" />
    <div class="caption">
        <div class="el-content">
            <?= $item['content'] ?>
        </div>
    </div>
</li>