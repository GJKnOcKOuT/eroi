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
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @package yii2-widgets
 * @subpackage yii2-widget-rating
 * @version 1.0.4
 */

namespace kartik\rating;

use kartik\base\AssetBundle;

/**
 * Theme Asset bundle for StarRating Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class StarRatingThemeAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/kartik-v/bootstrap-star-rating';
 
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->depends = array_merge($this->depends, ['kartik\rating\StarRatingAsset']);
        parent::init();
    }
    
    /**
     * Add star rating theme file
     *
     * @param string $theme the theme file name
     */
    public function addTheme($theme) 
    {
        $this->js[] = "themes/{$theme}/theme." . (YII_DEBUG ? "js" : "min.js");
        $this->css[] = "themes/{$theme}/theme." . (YII_DEBUG ? "css" : "min.css");
    }
}