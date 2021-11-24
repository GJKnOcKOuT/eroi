<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

use app\assets\ResourcesAsset;
use app\modules\cms\helpers\CmsHelper;

$resourceAsset = ResourcesAsset::register($this);


$truncate = 250;
?>

<div>
    <div class="img">
        <?php
        $image = $model->image;
        if(!is_null($image)){
            echo $contentImage = CmsHelper::img(
                $image->getWebUrl('square_medium', false, true),
                [
                    'class' => 'el-image',
                    'alt' => $model->name . $model->surname
                ]
            );
        }
        ?>
    </div>
    <div class="text">
        <p><strong><?= $model->name . ' ' . $model->surname ?></strong></p>
        <p><?= $model->company ?></p>
    </div>
</div>