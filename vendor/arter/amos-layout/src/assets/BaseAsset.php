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
 * @package    arter\amos\layout
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\layout\assets;

use arter\amos\core\widget\WidgetAbstract;
use yii\web\AssetBundle;

/**
 * Class AppAsset
 * @package arter\amos\layout\assets
 */
class BaseAsset extends AssetBundle
{
    public $js = [
        'js/bootstrap-tabdrop.js',
        'js/globals.js',
        'js/device-detect.js',
        'js/tooltip-component.js',
        'js/footer.js'
    ];

    public $css = [
        'less/main.less'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
        'arter\amos\layout\assets\LajaxAsset',
        'yii\bootstrap\BootstrapAsset',
        'kartik\select2\Select2Asset',
        'arter\amos\layout\assets\IEAssets',
        'arter\amos\layout\assets\JqueryUiTouchPunchImprovedAsset',
        'arter\amos\layout\assets\ConflictJuiBootstrap',
        'arter\amos\layout\assets\TourAsset',
        'arter\amos\layout\assets\IconAsset',
        'arter\amos\layout\assets\FontAsset',
        'arter\amos\layout\assets\DialogAsset',
        'arter\amos\layout\assets\LajaxAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = __DIR__ . '/resources/base';
        if(!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS){
            $this->css = ['less/main_fullsize.less'];
        }
        parent::init();
    }
}
