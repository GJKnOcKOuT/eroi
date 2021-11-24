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

class IE8Assets extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //DA SOSTITUIRE CON FILE LESS UNA VOLTA INSERITO IL COMPILATORE
        'css/widgetsIE8.css'
    ];
    public $cssOptions = ['condition' => 'lt IE9'];
    public $js = [
        '/js/html5shiv.js',
        '/js/respond.js',
        '/js/svg4everybody.legacy.js'
    ];
    public $jsOptions = ['condition' => 'lt IE9'];

}
