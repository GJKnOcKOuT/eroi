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


class FrontAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/modules/uikit/assets';
    /**
     * @inheritdoc
     */
    public $js = [
        'js/base64.js',
        'js/lightslider.js',
    ];

    /**
     * @inheritdoc
     */
    public $css = [
        'css/lightslider.css',
        'css/gallerypanel.css',
        'css/accordionattachments.css'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        '\yii\web\JqueryAsset',
    ];
    
    
}
