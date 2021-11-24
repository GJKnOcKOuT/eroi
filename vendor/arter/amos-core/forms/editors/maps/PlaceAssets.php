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
 * @package    arter\amos\core\forms\editors\maps
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\forms\editors\maps;


use yii\web\AssetBundle;

/**
 * Class PlaceAssets
 * @package arter\amos\core\forms\editors\maps
 */
class PlaceAssets extends AssetBundle
{
    public $sourcePath = __DIR__ . DIRECTORY_SEPARATOR . 'assets';
    
    public $js = [
        'js/place.js',
    ];
    
    public $css = [
        'css/place.css'
    ];
    
    public $publishOptions = [
        'forceCopy' => true
    ];
}
