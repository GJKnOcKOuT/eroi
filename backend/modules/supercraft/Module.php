<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\tickets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\supercraft;

use arter\amos\core\module\AmosModule;

/**
 * registry module definition class
 */
class Module extends AmosModule
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\supercraft\controllers';
    public $newFileMode = 0666;
    public $name = 'supercraftcss';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        \Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'));

    }

    protected function getDefaultModels()
    {
        return [];
    }

    /**
     *
     * @return string
     */
    public static function getModuleName()
    {
        return 'supercraftcss';
    }

    public function getWidgetGraphics()
    {
        return NULL;
    }

    public function getWidgetIcons()
    {
        return [
            \backend\modules\supercraft\widgets\icons\WidgetIconSupercraft::className(),

        ];
    }
}
