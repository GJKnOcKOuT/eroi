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
 * @link      https://github.com/kv4nt/yii2-owl-carousel2
 * @license   https://github.com/kv4nt/yii2-owl-carousel2/blob/master/LICENSE.md
 */

namespace kv4nt\owlcarousel;

use yii\web\AssetBundle;

/**
 * Asset Bundle for Owl Carousel Widget
 *
 * @author Victor Shumeyko <kvant90@gmail.com>
 */
class OwlCarouselAsset extends AssetBundle
{

    /**
     * @var string the directory that contains the source asset files for this asset bundle.
     */
    public $sourcePath = '@bower/owl.carousel';

    /**
     * @var array list of CSS files that this bundle contains.
     */
    public $css = [
        'dist/assets/owl.carousel.min.css',
        'dist/assets/owl.theme.default.min.css',
    ];

    /**
     * @var array list of JavaScript files that this bundle contains.
     */
    public $js = [
        'dist/owl.carousel.min.js',
    ];

    /**
     * @var array list of depends assets that this bundle contains.
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
