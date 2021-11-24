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


namespace arter\amos\utility;

use arter\amos\core\module\AmosModule;
use yii\helpers\ArrayHelper;

/**
 * Class Module
 * @package arter\amos\utility
 */
class Module extends AmosModule
{
    /**
     *
     * @var string $controllerNamespace Controller namespace
     */
    public $controllerNamespace = 'arter\amos\utility\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        //Let console working right
        $this->setControllerNameSpace(\Yii::$app);

        //Configuration
        $config = require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');

        //Setup config
        \Yii::configure($this, ArrayHelper::merge($config, $this));
        $tasksModule = $this->getModule('manage-tasks');
        $layoutModule = \Yii::$app->getModule('layout');

        if ($tasksModule && $layoutModule) {
            \Yii::$app->setLayoutPath($layoutModule->layoutPath);
        }
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
     * @return string
     */
    public static function getModuleName()
    {
        return 'utility';
    }

    /**
     * Get default models
     * @return array
     */
    protected function getDefaultModels()
    {
        return [];
    }

    /**
     * @param $app
     */
    public function bootstrap($app)
    {
        $this->setControllerNameSpace($app);
    }

    /**
     * @param \yii\console\Application $app
     */
    private function setControllerNameSpace($app)
    {
        if ($app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'arter\amos\utility\commands';
        }
    }
}
