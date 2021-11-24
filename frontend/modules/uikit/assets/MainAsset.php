<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

namespace app\modules\uikit\assets;


class MainAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/modules/uikit/assets';
    /**
     * @inheritdoc
     */
    public $js = [
        'js/zaa.js',
    ];

    /**
     * @inheritdoc
     */
    public $css = [];

    /**
     * @inheritdoc
     */
    public $depends = [
        'luya\admin\assets\Main',
        'app\modules\uikit\assets\TinyMceAsset',
    ];
    
    
}
