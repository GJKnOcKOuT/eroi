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
 * @package    arter\amos\organizzazioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\organizzazioni\assets;

use yii\web\AssetBundle;
use arter\amos\core\widget\WidgetAbstract;


class OrganizzazioniAsset extends AssetBundle
{
    public $sourcePath = '@vendor/arter/amos-organizzazioni/src/assets/web';

    public $js = [
    ];
    public $css = [
        'less/organizzazioni.less',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset'
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        if(!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS){
            $this->css = ['less/organizzazioniFullsize.less'];
        }
        parent::init();
    }

}