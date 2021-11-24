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
 * @subpackage yii2-widget-touchspin
 * @version 1.2.3
 */

namespace kartik\touchspin;

use kartik\base\InputWidget;

/**
 * TouchSpin widget is a Yii2 wrapper for the bootstrap-touchspin plugin by István Ujj-Mészáros. This input widget is a
 * mobile and touch friendly input spinner component for Bootstrap 3.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 * @see http://www.virtuosoft.eu/code/bootstrap-touchspin/
 */
class TouchSpin extends InputWidget
{
    /**
     * @inheritdoc
     */
    public $pluginName = 'TouchSpin';

    /**
     * @inheritdoc
     * @throws \yii\base\InvalidConfigException
     */
    public function run()
    {
        parent::run();
        $this->setPluginOptions();
        $this->registerAssets();
        echo $this->getInput('textInput');
    }

    /**
     * Set the plugin options
     * @throws \yii\base\InvalidConfigException
     */
    protected function setPluginOptions()
    {
        $css = 'btn ' . $this->getDefaultBtnCss();
        $iconPrefix = $this->getDefaultIconPrefix();
        if ($this->disabled) {
            $css .= ' disabled';
        }
        $defaultPluginOptions = [
            'buttonup_class' => $css,
            'buttondown_class' => $css,
            'buttonup_txt' => "<i class='{$iconPrefix}forward'></i>",
            'buttondown_txt' => "<i class='{$iconPrefix}backward'></i>",
        ];
        $this->pluginOptions = array_replace_recursive($defaultPluginOptions, $this->pluginOptions);
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        TouchSpinAsset::registerBundle($view, $this->bsVersion);
        $this->registerPlugin($this->pluginName);
    }
}
