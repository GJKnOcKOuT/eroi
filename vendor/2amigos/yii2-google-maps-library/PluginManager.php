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
 * @copyright Copyright (c) 2014 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\google\maps;


use yii\base\BaseObject;
use yii\helpers\ArrayHelper;

/**
 * PluginManager
 *
 * Manages installed plugins.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\google\maps
 */
class PluginManager extends BaseObject
{
    /**
     * @var array stores the managed plugins
     */
    private $_plugins = [];

    /**
     * Check whether we have a plugin installed with that name previous firing up the call
     *
     * @param string $name
     *
     * @return mixed|void
     */
    public function __get($name)
    {
        if (ArrayHelper::keyExists($name, $this->getInstalledPlugins())) {
            return $this->getPlugin($name);
        }
        return parent::__get($name);
    }

    /**
     * Installs a plugin
     *
     * @param PluginAbstract $plugin
     *
     * @return void
     */
    public function install(PluginAbstract $plugin)
    {
        $this->_plugins[$plugin->getPluginName()] = $plugin;
    }

    /**
     * Removes a plugin
     *
     * @param PluginAbstract $plugin
     *
     * @return mixed|null the value of the element if found, default value otherwise
     */
    public function remove(PluginAbstract $plugin)
    {
        return ArrayHelper::remove($this->_plugins, $plugin->getPluginName());
    }

    /**
     * @param \yii\web\View $view
     * Registers plugin bundles
     */
    public function registerAssetBundles($view)
    {
        foreach ($this->_plugins as $plugin) {
            /** @var PluginAbstract $plugin */
            $plugin->registerAssetBundle($view);
        }
    }

    /**
     * @return array of installed plugins
     */
    public function getInstalledPlugins()
    {
        return $this->_plugins;
    }

    /**
     * Returns an installed plugin by name
     *
     * @param string $name
     *
     * @return PluginAbstract|null
     */
    public function getPlugin($name)
    {
        return isset($this->_plugins[$name]) ? $this->_plugins[$name] : null;
    }
}
