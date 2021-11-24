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
 * @link https://github.com/himiklab/yii2-colorbox-widget
 * @copyright Copyright (c) 2014 HimikLab
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace himiklab\colorbox;

use Yii;
use yii\web\AssetBundle;

class ColorboxAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery-colorbox';

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function init()
    {
        parent::init();

        $this->js[] = YII_DEBUG ? 'jquery.colorbox.js' : 'jquery.colorbox-min.js';
        $this->registerLanguageAsset();
    }

    protected function registerLanguageAsset()
    {
        $language = Yii::$app->language;
        if (!file_exists(Yii::getAlias($this->sourcePath . "/i18n/jquery.colorbox-{$language}.js"))) {
            $language = substr($language, 0, 2);
            if (!file_exists(Yii::getAlias($this->sourcePath . "/i18n/jquery.colorbox-{$language}.js"))) {
                return;
            }
        }
        $this->js[] = "i18n/jquery.colorbox-{$language}.js";
    }
}
