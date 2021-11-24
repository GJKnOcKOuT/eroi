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


namespace raoul2000\workflow\view;

use Yii;
use yii\web\AssetBundle;

class WorkflowViewAsset extends AssetBundle
{
    public $sourcePath = '@bower/vis/dist';
    /**
     * @see \yii\web\AssetBundle::init()
     */
    public function init()
    {
    	$this->js = [
    		'vis'.( YII_ENV_DEV ? '.js' : '.min.js' )
    	];
    	$this->css = [
    		'vis'.( YII_ENV_DEV ? '.css' : '.min.css' )
    	];    	
    	return parent::init();
    }    
}
