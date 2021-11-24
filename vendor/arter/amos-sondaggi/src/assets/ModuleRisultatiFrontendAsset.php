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


namespace arter\amos\sondaggi\assets;

use yii\web\AssetBundle;

class ModuleRisultatiFrontendAsset extends AssetBundle
{
    public $sourcePath = '@vendor/arter/amos-sondaggi/src/assets/web';

    public $css = [
        'less/sondaggi-frontend.less'
    ];
    public $js = [
        'js/sondaggi-frontend.js'        
    ];
    public $depends = [        
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
        'kartik\depdrop\DepDropExtAsset'
    ];

}
