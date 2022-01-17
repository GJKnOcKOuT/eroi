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


namespace arter\amos\supercraft;

use arter\amos\core\interfaces\SearchModuleInterface;
use arter\amos\core\module\AmosModule;
use arter\amos\core\module\ModuleInterface;
use arter\amos\core\widget\WidgetAbstract;

/**
 * Class Module
 * @package arter\amos\supercraft
 */
class Module extends AmosModule implements ModuleInterface, SearchModuleInterface
{
    public $controllerNamespace = 'arter\amos\supercraft\controllers';
    public $name = 'SuperCraft';
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        if (\Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'arter\amos\supercraft\console';
        }
        parent::init();
        \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/controllers', __DIR__ . '/controllers/');
        \Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'));
    }

    /**
     * @inheritdoc
     */
    public function getWidgetIcons()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getWidgetGraphics()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function getModuleName()
    {
        return 'bestpractice';
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultModels()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function getModelSearchClassName()
    {
        return __NAMESPACE__ . '\models\search\SuperCraftSearch';
    }

    /**
     * @inheritdoc
     */
    public static function getModuleIconName()
    {
        if (!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            return 'supercraft';
        } else {
            return 'linentita';
        }
    }
}
