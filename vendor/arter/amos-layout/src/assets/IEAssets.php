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
 * @package    arter\amos\core
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\layout\assets;

use yii\web\AssetBundle;

class IEAssets extends AssetBundle {

    public $css = [
        //TOODO
    ];

    public $cssOptions = ['condition' => 'IE'];

    public $js = [
        'js/html5shiv.js',              //html5 compatibility
        'js/respond.js',                //ccs3 compatibility
        'js/svg4everybody.legacy.js'    //svg compatibiilty
    ];

    public $jsOptions = ['condition' => 'IE'];

    public $depends = [
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = __DIR__ . '/resources/ie';

        parent::init();
    }

}
