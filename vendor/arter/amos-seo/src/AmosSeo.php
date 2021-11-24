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
 * @package    arter\amos\seo
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\seo;

use arter\amos\seo\models\SeoData;
use arter\amos\core\module\AmosModule;
use arter\amos\core\record\Record;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * Class AmosSeo
 *
 * Collaboration Web House - This module provides management of seo fields
 *
 * @package arter\amos\seo
 * @see
 */
class AmosSeo extends AmosModule
{
    public $behaviors            = [
        'seoBehavior' => 'arter\amos\seo\behaviors\SeoBehaviors'
    ];
    public $modulesEnabled       = [];
    public $modelsEnabled        = [];      // configurata in modules-amos
    public static $CONFIG_FOLDER = 'config';
    public $config               = [];

    /**
     * @var string $moduleName
     */
    private static $moduleName = 'seo';

    public function init()
    {
        $configContents = null;
        parent::init();

        \Yii::setAlias('@arter/amos/'.static::getModuleName().'/controllers', __DIR__.'/controllers');
        // \Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'));
        // 
        // initialize the module with the configuration loaded from config.php
        $config = require(__DIR__.DIRECTORY_SEPARATOR.self::$CONFIG_FOLDER.DIRECTORY_SEPARATOR.'config.php');
        Yii::configure($this, $config);

        $this->modulesEnabled = $this->config['modulesEnabled'];

        Record::$modulesChainBehavior[] = 'seo';
        //pr(Record::$modulesChainBehavior, 'Record::$modulesChainBehavior');exit;
    }

    /**
     * Module name
     * @return string
     */
    public static function getModuleName()
    {
        return static::$moduleName;
    }

    /**
     * @param string $moduleName
     */
    public static function setModuleName($moduleName)
    {
        static::$moduleName = $moduleName;
    }

    public function getWidgetGraphics()
    {
        return [];
    }

    public function getWidgetIcons()
    {
        return [];
    }

    /**
     *
     * @return string
     */
    public static function getModel()
    {
        return __NAMESPACE__.'\\'.'models\SeoData';
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultModels()
    {
        return [
        ];
    }

    public static function getModelFromPrettyUrl($slug)
    {
        $seoData = SeoData::findOne([
                'pretty_url' => $slug
        ]);
        if (!is_null($seoData)) {
            $contentClassName = $seoData->classname;
            $model            = $contentClassName::findOne($seoData->content_id);
            //pr($model->toArray(),get_class($model));exit;
            return $model;
        }
        return null;
    }
}