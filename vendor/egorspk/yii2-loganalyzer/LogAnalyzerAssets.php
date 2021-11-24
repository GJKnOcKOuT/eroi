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

namespace spk\yii2loganalyzer;

use yii\web\AssetBundle;

class LogAnalyzerAssets extends AssetBundle
{
    public $depends = ['yii\web\JqueryAsset'];

    function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        
        if (YII_DEBUG) {
            $this->js[] = 'log.js';
            $this->css[] = 'log.css';
        } else {
            $this->js[] = 'log.min.js';
            $this->css[] = 'log.min.css';
        }
        parent::init();
    }
}