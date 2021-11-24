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

class AmosCoreAsset extends AssetBundle
{
    public $sourcePath = '@vendor/arter/amos-core/views/assets/web';
    public $baseUrl = '@web';

    public $css = [
        //TODO AGGIUNGERE FILE LESS IE
        'css/less/core.less',
    ];
    public $js = [
        'js/bootstrap-tabdrop.js',
        'js/globals.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
        'arter\amos\core\views\assets\IE8Assets',
        'arter\amos\core\views\assets\JqueryUiTouchPunchImprovedAsset',
        'arter\amos\core\views\assets\ConflictJuiBootstrap',
        'yii\bootstrap\BootstrapAsset',
        'kartik\select2\Select2Asset',
        'arter\amos\core\views\assets\TourAsset',
        'arter\amos\core\views\assets\AmosIconAsset',
        'arter\amos\core\views\assets\AmosFontAsset',
        'arter\amos\core\views\assets\AmosIconDashboardAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $moduleL = \Yii::$app->getModule('layout');
        if (!empty($moduleL)) {
            $this->depends = ['arter\amos\layout\assets\BaseAsset'];
            $this->css = [];
            $this->js = [];
        }
        parent::init();
    }

}
