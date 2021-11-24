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
 * @package    arter\amos\dashboard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\dashboard\assets;

use yii\web\AssetBundle;
use arter\amos\core\widget\WidgetAbstract;

class SubDashboardAsset extends AssetBundle
{
    public $sourcePath = '@vendor/arter/amos-dashboard/src/assets/web';
    public $css = [
        'less/sub-dashboard.less'
    ];
    public $js = [
        'js/sub-dashboard.js'
    ];
    public $depends = [
    ];

    public function init()
    {

        if (!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->js = [];
            $this->depends = ['arter\amos\dashboard\assets\DashboardFullsizeAsset'];
        } else {
            $moduleL = \Yii::$app->getModule('layout');
            if (!empty($moduleL)) {
                $this->depends [] = 'arter\amos\layout\assets\BaseAsset';
                $this->depends [] = 'arter\amos\layout\assets\IsotopeAsset';
            } else {
                $this->depends [] = 'arter\amos\core\views\assets\AmosCoreAsset';
                $this->depends [] = 'arter\amos\core\views\assets\IsotopeAsset';
            }
        }

        parent::init();
    }
}