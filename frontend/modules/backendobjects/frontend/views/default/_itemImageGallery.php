<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

use app\modules\cms\helpers\CmsHelper;
use arter\amos\news\AmosNews;


$truncate = 250;
?>


<div>
    <?php
    echo $contentImage = CmsHelper::img(
        $model->getFileImage()->getWebUrl(),
        [
            'class' => 'el-image',
            'alt' => AmosNews::t('amosnews', 'immagine')
        ]
    );
    ?>
</div>