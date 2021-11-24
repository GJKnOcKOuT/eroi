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
 * @package    arter\amos\core\views\assets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\views\assets;

use yii\web\AssetBundle;

class TourAsset extends AssetBundle {

    public $sourcePath = '@bower/bootstrap-tour';
    public $js = [
        'build/js/bootstrap-tour.min.js',
    ];
    public $css = [
        'build/css/bootstrap-tour.min.css',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}
