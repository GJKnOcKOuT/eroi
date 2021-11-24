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
 * @package    arter\amos\discussioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\discussioni;

use arter\amos\core\module\AmosModule;
use arter\amos\core\module\ModuleInterface;
use arter\amos\core\interfaces\SearchModuleInterface;
use arter\amos\core\interfaces\CmsModuleInterface;
use arter\amos\discussioni\widgets\graphics\WidgetGraphicsDiscussioniInEvidenza;
use arter\amos\discussioni\widgets\graphics\WidgetGraphicsUltimeDiscussioni;
use arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopic;
use arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicCreatedBy;
use arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicDaValidare;
use Yii;
use yii\console\Application;

/**
 * Class AmosDiscussioni
 * @package arter\amos\discussioni
 */
class AmosDiscussioni extends AmosModule implements ModuleInterface, SearchModuleInterface, CmsModuleInterface
{
   
    /**
     * @var bool $disableComments disable comments
     */
    public $disableComments = false;
    
    const
        MAX_LAST_DISCUSSION_ON_DASHBOARD = 3;

    /**
     * 
     */
    public
    // @var string $controllerNamespace the controller namespace
        $controllerNamespace = 'arter\amos\discussioni\controllers',
        $geolocalEnabled = false,
        $geolocalLatColumn = 'lat',
        $geolocalLngColumn = 'lng',
        $geolocalRadius = '5000',
        $name = 'Discussioni',
        // @var bool $notifyOnlyContributors
        $notifyOnlyContributors = true,
        // @var array $defaultListViews This set the default order for the views in lists
        $defaultListViews = ['list'/* , 'icon' */, 'grid'],
        $enable_foreground = false,
        $foreground_permission = 'DISCUSSION_FOREGROUD_PERMISSION',
        // @var string
        $defaultWidgetIndexUrl = '/discussioni/discussioni-topic/own-interest-discussions';

    /*
     * @var bool disableStandardWorkflow Disable standard worflow, direct publish
     */
    public $disableStandardWorkflow = false;

    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        if ($app instanceof Application) {
            $this->controllerNamespace = 'arter\amos\discussioni\commands\controllers';
            \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/commands/controllers', __DIR__ . '/commands/controllers');
            \Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'commands' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'));
        }
    }

    /**
     *
     */
    public function init()
    {
        parent::init();

        if (\Yii::$app instanceof Application) {
            \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/commands', __DIR__ . '/commands/');
            \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/controllers', __DIR__ . '/controllers/');
            //aggiunge le configurazioni trovate nel file config/config.php
            Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'));
        } else {
            \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/controllers', __DIR__ . '/controllers/');
            //aggiunge le configurazioni trovate nel file config/config.php
            Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'));
        }
    }

    /**
     * @return string - The name of the module
     */
    public static function getModuleName()
    {
        return "discussioni";
    }

    /**
     * 
     * @return type
     */
    public static function getModelSearchClassName()
    {
        return __NAMESPACE__ . '\models\search\DiscussioniTopicSearch';
    }

    /**
     * 
     * @return type
     */
    public static function getModelClassName()
    {
        return __NAMESPACE__ . '\models\DiscussioniTopic';
    }

    /**
     * 
     * @return string
     */
    public static function getModuleIconName()
    {
        return 'comment';
    }

    /**
     * @return boolean
     */
    public function isGeolocalEnabled()
    {
        return $this->geolocalEnabled;
    }

    /**
     * @param boolean $geolocalEnabled
     */
    public function setGeolocalEnabled($geolocalEnabled)
    {
        $this->geolocalEnabled = $geolocalEnabled;
    }

    /**
     * @return string
     */
    public function getGeolocalLatColumn()
    {
        return $this->geolocalLatColumn;
    }

    /**
     * @param string $geolocalLatColumn
     */
    public function setGeolocalLatColumn($geolocalLatColumn)
    {
        $this->geolocalLatColumn = $geolocalLatColumn;
    }

    /**
     * @return string
     */
    public function getGeolocalLngColumn()
    {
        return $this->geolocalLngColumn;
    }

    /**
     * @param string $geolocalLngColumn
     */
    public function setGeolocalLngColumn($geolocalLngColumn)
    {
        $this->geolocalLngColumn = $geolocalLngColumn;
    }

    /**
     * @return string
     */
    public function getGeolocalRadius()
    {
        return $this->geolocalRadius;
    }

    /**
     * @param string $geolocalRadius
     */
    public function setGeolocalRadius($geolocalRadius)
    {
        $this->geolocalRadius = $geolocalRadius;
    }

    /**
     * @return array: classname of the graphic widgets
     */
    public function getWidgetGraphics()
    {
        return [
            WidgetGraphicsUltimeDiscussioni::className(),
            WidgetGraphicsDiscussioniInEvidenza::className(),
        ];
    }

    /**
     * @return array: classname of the icon widgets
     */
    public function getWidgetIcons()
    {
        return [
            WidgetIconDiscussioniTopic::className(),
            WidgetIconDiscussioniTopicCreatedBy::className(),
            WidgetIconDiscussioniTopicDaValidare::className(),
        ];
    }

    /**
     * @return array
     */
    protected function getDefaultModels()
    {
        return [
            'DiscussioniTopic' => __NAMESPACE__ . '\\' . 'models\DiscussioniTopic',
            'DiscussioniCommenti' => __NAMESPACE__ . '\\' . 'models\DiscussioniCommenti',
            'DiscussioniRisposte' => __NAMESPACE__ . '\\' . 'models\DiscussioniRisposte',
        ];
    }

    /**
     * This method return the session key that must be used to add in session
     * the url from the user have started the content creation.
     * @return string
     */
    public static function beginCreateNewSessionKey()
    {
        return 'beginCreateNewUrl_' . self::getModuleName();
    }

}
