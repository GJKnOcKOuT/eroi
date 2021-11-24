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
 * @package    arter\amos\slideshow
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\slideshow;

use arter\amos\core\module\AmosModule;
use arter\amos\core\module\ModuleInterface;
use arter\amos\slideshow\widgets\icons\WidgetIconSlideshow;
use arter\amos\slideshow\widgets\icons\WidgetIconSlideshowConf;
use Yii;

/**
 * Class AmosSlideshow
 * @package arter\amos\slideshow
 */
class AmosSlideshow extends AmosModule implements ModuleInterface
{
    public static $CONFIG_FOLDER = 'config';

    /**
     * @var string|boolean the layout that should be applied for views within this module. This refers to a view name
     * relative to [[layoutPath]]. If this is not set, it means the layout value of the [[module|parent module]]
     * will be taken. If this is false, layout will be disabled within this module.
     */
    public $layout = 'main';
    public $name = 'Slideshow';

    public static function getModuleName()
    {
        return "slideshow";
    }

    public function init()
    {
        parent::init();
        
        \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/controllers/', __DIR__ . '/controllers/');
        // initialize the module with the configuration loaded from config.php
        Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . self::$CONFIG_FOLDER . DIRECTORY_SEPARATOR . 'config.php'));
    }

    public function getWidgetIcons()
    {
        return [
            WidgetIconSlideshow::className(),
            WidgetIconSlideshowConf::className(),
        ];
    }

    public function getWidgetGraphics()
    {
        return [];
    }

    protected function getDefaultModels()
    {

    }

}
