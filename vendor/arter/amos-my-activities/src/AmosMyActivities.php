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
 * @package    arter\amos\myactivities
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\myactivities;

use arter\amos\core\module\AmosModule;
use arter\amos\myactivities\widgets\icons\WidgetIconMyActivities;

/**
 * Class AmosMyActivities
 * @package arter\amos\myactivities
 */
class AmosMyActivities extends AmosModule
{
    public $controllerNamespace = 'arter\amos\myactivities\controllers';
    public $name = 'MYACTIVITIES';
    
    public $orderType = 'SORT_ASC';


    /**
     * @inheritdoc
     */
    public static function getModuleName()
    {
        return 'myactivities';
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/controllers', __DIR__ . '/controllers/');
        \Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'));
    }

    /**
     * @inheritdoc
     */
    public function getWidgetGraphics()
    {

    }

    /**
     * @inheritdoc
     */
    public function getWidgetIcons()
    {
        return [
            WidgetIconMyActivities::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultModels()
    {
        return [
        ];
    }
}
