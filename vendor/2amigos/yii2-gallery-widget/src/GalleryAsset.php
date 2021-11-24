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

/**
 * @link https://github.com/2amigos/yii2-gallery-widget
 * @copyright Copyright (c) 2013-2016 2amigOS! Consulting Group LLC
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace dosamigos\gallery;

use yii\web\AssetBundle;

/**
 * GalleryAsset
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 */
class GalleryAsset extends AssetBundle
{
    public $sourcePath = '@bower/blueimp-gallery';
    public $css = [
        'css/blueimp-gallery.min.css',
    ];
    public $js = [
        'js/blueimp-gallery.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
