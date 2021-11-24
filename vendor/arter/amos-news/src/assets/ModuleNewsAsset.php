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
 * @package    arter\amos\news
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\news\assets;

use yii\web\AssetBundle;
use arter\amos\core\widget\WidgetAbstract;

class ModuleNewsAsset extends AssetBundle
{
    public $sourcePath = '@vendor/arter/amos-news/src/assets/web';

    public $css = [
        'less/news.less',
    ];
    public $js = [
        'js/news-module.js',
        'js/news.js'
    ];
    public $depends = [
    ];

    public function init()
    {
        $moduleL = \Yii::$app->getModule('layout');

        if(!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS){
            $this->css = ['less/news_fullsize.less'];
        }

        if(!empty($moduleL)){
            $this->depends [] = 'arter\amos\layout\assets\BaseAsset';
        }else{
            $this->depends [] = 'arter\amos\core\views\assets\AmosCoreAsset';
        }
        parent::init();
    }
}