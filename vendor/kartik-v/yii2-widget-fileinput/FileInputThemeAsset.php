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
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2017
 * @package yii2-widgets
 * @subpackage yii2-widget-fileinput
 * @version 1.0.6
 */

namespace kartik\file;

use kartik\base\AssetBundle;
use Yii;

/**
 * Theme Asset bundle for the FileInput Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class FileInputThemeAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/kartik-v/bootstrap-fileinput';

    /**
     * @inheritdoc
     */
    public $depends = ['kartik\file\FileInputAsset'];

    /**
     * Add file input theme file
     *
     * @param string $theme the theme file name
     */
    public function addTheme($theme)
    {
        $file = YII_DEBUG ? "theme.js" : "theme.min.js";
        if ($this->checkExists("themes/{$theme}/{$file}")) {
            $this->js[] = "themes/{$theme}/{$file}";
        } 
        $file = YII_DEBUG ? "theme.css" : "theme.min.css";
        if ($this->checkExists("themes/{$theme}/{$file}")) {
            $this->css[] = "themes/{$theme}/{$file}";
        } 
        return $this;
    }
    
    /**
     * Check if file exists in path provided
     *
     * @param string $path the file path
     *
     * @return boolean
     */
    protected  function checkExists($path)
    {
        return file_exists(Yii::getAlias($this->sourcePath . '/' . $path));
    }
}
