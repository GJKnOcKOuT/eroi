<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

namespace app\assets;

/**
 * Application Asset File.
 */
class BootstrapItaliaAsset extends \luya\web\Asset
{
    public $sourcePath = '@app/resources';

    public $css = [
      'css/bootstrap-italia.min.css',
      'css/override_bootstrap-italia.css',
    ];

    public $js = [
      //'js/bootstrap-italia.min.js',
    ];

    public $depends = [
        
    ];
}
