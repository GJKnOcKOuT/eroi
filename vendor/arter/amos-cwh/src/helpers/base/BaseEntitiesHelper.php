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


namespace arter\amos\cwh\helpers\base;


use arter\amos\core\module\AmosModule;
use arter\amos\cwh\base\ModelConfig;
use hanneskod\classtools\Iterator\ClassIterator;
use Symfony\Component\Finder\Finder;
use yii\helpers\ArrayHelper;

class BaseEntitiesHelper
{

    const INTERFACE_CONTENT = '\arter\amos\core\interfaces\ContentModelInterface';
    const INTERFACE_NETWORK = '\arter\amos\cwh\base\ModelNetworkInterface';

    /**
     * Get classname listed by module name that implements {{$interfaceClassname}}
     *
     * @param $interfaceClassname
     * @return array
     */
    public static function getEntities($interfaceClassname)
    {
        $entities = [];
        $excludeNetwork = false;
        if($interfaceClassname == self::INTERFACE_CONTENT){
            $excludeNetwork = true;
        }

        /**
         * TODO
         * bonificare anche i seguenti plugin
         */
        $pluginBlacklisted = [
            'admin', //non perché sia da bonificare dagli errori ma perché non da considerare come contenitore modelli di rete/ di contenuti
            'upload',
            'aliases',
            'file',
            'myactivities',
            'proposte_collaborazione',
        ];

        foreach (\Yii::$app->getModules() as $moduleName => $module) {

            if (ArrayHelper::isIn($moduleName, $pluginBlacklisted)) {
                continue;
            }

            /**@var AmosModule $module */
            if (!$module instanceof AmosModule) {
                $module = \Yii::$app->getModule($moduleName);
            }

            $finder = new Finder();
            $iter = new ClassIterator(
                $finder
                    ->name('*.php')
                    ->notPath('migration')
                    ->contains($moduleName)
                    ->notContains('\search;')
                    ->in($module->getBasePath())
            );

            foreach ($iter->getClassMap() as $classname => $splFileInfo) {

                if (class_exists($classname)) {
                    $refClass = new \ReflectionClass($classname);
                    if (!$refClass->isInterface() && $refClass->implementsInterface($interfaceClassname) && !$refClass->isAbstract()) {
                        if (!$excludeNetwork || !$refClass->implementsInterface(self::INTERFACE_NETWORK)) {
                            $entities[] = new ModelConfig([
                                'classname' => $classname,
                                'tablename' => $classname::tableName(),
                                'label' => $refClass->getShortName(),
                                'module_id' => $moduleName,
                                'base_url_config' => self::retreiveUrlConfigClass($interfaceClassname),
                                'config_class' => self::retreiveConfigClass($interfaceClassname),
                            ]);
                        }
                    }
                }

            }

        }
        return $entities;
    }

    private static function retreiveUrlConfigClass($interfaceClassname)
    {
        if ($interfaceClassname == self::INTERFACE_CONTENT) {
            return '/cwh/configuration/content';
        }
        if ($interfaceClassname == self::INTERFACE_NETWORK) {
            return '/cwh/configuration/network';
        }

        return null;

    }

    private static function retreiveConfigClass($interfaceClassname)
    {
        if ($interfaceClassname == self::INTERFACE_CONTENT) {
            return '\arter\amos\cwh\models\CwhConfigContents';
        }
        if ($interfaceClassname == self::INTERFACE_NETWORK) {
            return '\arter\amos\cwh\models\CwhConfig';
        }

        return null;
    }
}