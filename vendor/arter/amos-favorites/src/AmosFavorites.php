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
 * @package    arter\amos\favorites
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\favorites;

use arter\amos\core\module\AmosModule;
use arter\amos\core\module\ModuleInterface;

/**
 * Class AmosFavorites
 * @package arter\amos\favorites
 */
class AmosFavorites extends AmosModule implements ModuleInterface
{
    public static $CONFIG_FOLDER = 'config';
    
    /**
     * @var string|boolean the layout that should be applied for views within this module. This refers to a view name
     * relative to [[layoutPath]]. If this is not set, it means the layout value of the [[module|parent module]]
     * will be taken. If this is false, layout will be disabled within this module.
     */
    public $layout = 'main';
    
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'arter\amos\favorites\controllers';
    
    public $newFileMode = 0666;
    
    public $name = 'Favorites';
    
    /**
     * @var array $modelsEnabled
     */
    public $modelsEnabled = [];
    
    /**
     * @return string
     */
    public static function getModuleName()
    {
        return 'favorites';
    }
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/controllers/', __DIR__ . '/controllers/');
        // custom initialization code goes here
        \Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'));
    }
    
    /**
     * @inheritdoc
     */
    public function getWidgetGraphics()
    {
        return NULL;
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
    protected function getDefaultModels()
    {
        return [];
    }
}
