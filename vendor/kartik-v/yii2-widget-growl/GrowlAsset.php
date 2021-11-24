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
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-widgets
 * @subpackage yii2-widget-growl
 * @version 1.1.1
 */

namespace kartik\growl;

/**
 * Asset bundle for \kartik\widgets\Growl
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class GrowlAsset extends \kartik\base\AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/kv-bootstrap-notify']);
        $this->setupAssets('js', ['js/bootstrap-notify']);
        parent::init();
    }

    /**
     * Adds a theme CSS file
     *
     * @param string $theme the theme name
     *
     * @return kartik\growl\GrowlAsset object instance
     */
    public function addTheme($theme)
    {
        $ext = YII_DEBUG ? '.css' : '.min.css';
        $this->css[] = "css/{$theme}{$ext}";
        return $this;
    }
}