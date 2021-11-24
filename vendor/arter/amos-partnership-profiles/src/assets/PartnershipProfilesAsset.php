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
 * @package    arter\amos\partnershipprofiles\assets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\partnershipprofiles\assets;

use yii\web\AssetBundle;
use arter\amos\core\widget\WidgetAbstract;

/**
 * Class PartnershipProfilesAsset
 * @package arter\amos\partnershipprofiles\assets
 */
class PartnershipProfilesAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/arter/amos-partnership-profiles/src/assets/web';
    
    /**
     * @inheritdoc
     */
    public $js = [
    ];
    
    /**
     * @inheritdoc
     */
    public $css = [
        'less/partnership-profiles.less',
    ];
    
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset'
    ];

    public function init()
    {
        if(!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS){
            $this->css = ['less/partnership-profiles_fullsize.less'];
        }

        parent::init();
    }
}