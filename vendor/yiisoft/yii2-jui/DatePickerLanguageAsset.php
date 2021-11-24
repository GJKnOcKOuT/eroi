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
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\jui;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DatePickerLanguageAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery-ui';
    /**
     * @var boolean whether to automatically generate the needed language js files.
     * If this is true, the language js files will be determined based on the actual usage of [[DatePicker]]
     * and its language settings. If this is false, you should explicitly specify the language js files via [[js]].
     */
    public $autoGenerate = true;
    /**
     * @var string language to register translation file for
     */
    public $language;
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\jui\JuiAsset',
    ];


    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        if ($this->autoGenerate) {
            $language = $this->language;
            $fallbackLanguage = substr($this->language, 0, 2);
            if ($fallbackLanguage !== $this->language && !file_exists(Yii::getAlias($this->sourcePath . "/ui/i18n/datepicker-{$language}.js"))) {
                $language = $fallbackLanguage;
            }
            $this->js[] = "ui/i18n/datepicker-$language.js";
        }
        parent::registerAssetFiles($view);
    }
}
