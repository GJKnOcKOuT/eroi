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
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @version   1.9.9
 */

namespace kartik\base;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\web\View;

/**
 * Asset bundle used for all Krajee extensions with bootstrap and jquery dependency.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class AssetBundle extends BaseAssetBundle implements BootstrapInterface
{
    use BootstrapTrait;

    /**
     * @var bool whether the bootstrap JS plugins are to be loaded and enabled
     */
    public $bsPluginEnabled = false;

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\YiiAsset',
    ];

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        $this->initBsAssets();
        parent::init();
    }

    /**
     * Initialize bootstrap assets dependencies
     * @throws InvalidConfigException
     */
    protected function initBsAssets()
    {
        $lib = 'bootstrap' . ($this->isBs4() ? '4' : '');
        $this->depends[] = "yii\\{$lib}\\BootstrapAsset";
        if ($this->bsPluginEnabled) {
            $this->depends[] = "yii\\{$lib}\\BootstrapPluginAsset";
        }
    }

    /**
     * Registers this asset bundle with a view after validating the bootstrap version
     * @param View $view the view to be registered with
     * @param string $bsVer the bootstrap version
     * @return static the registered asset bundle instance
     */
    public static function registerBundle($view, $bsVer = null)
    {
        $currVer = ArrayHelper::getValue(Yii::$app->params, 'bsVersion', null);
        if (empty($bsVer) || static::isSameVersion($currVer, $bsVer)) {
            return static::register($view);
        }
        Yii::$app->params['bsVersion'] = $bsVer;
        $out = static::register($view);
        if (!empty($currVer)) {
            Yii::$app->params['bsVersion'] = $currVer;
        }
        return $out;
    }
}
