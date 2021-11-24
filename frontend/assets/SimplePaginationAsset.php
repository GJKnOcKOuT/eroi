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
 * Landing Cms Asset File.
 */
class SimplePaginationAsset extends \luya\web\Asset
{
    public $sourcePath = '@bower/jquery.simplepagination';

    public $css = [
        'simplePagination.css',
    ];

    public $js = [
        'jquery.simplePagination.js',
    ];

    public $depends = [
        //
    ];
}
