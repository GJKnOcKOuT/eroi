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
 * @package    arter\amos\comuni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\comuni;

use arter\amos\core\module\AmosModule;
use arter\amos\comuni\widgets\icons\WidgetIconAmmComuni;
use arter\amos\comuni\widgets\icons\WidgetIconComuni;
use arter\amos\comuni\widgets\icons\WidgetIconProvince;

/**
 * AmosComuni module definition class
 */
class AmosComuni extends AmosModule {

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'arter\amos\comuni\controllers';
    public $newFileMode = 0666;
    public $newDirMode = 0777;
    public $name = 'comuni';

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();

        // custom initialization code goes here
        \Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'));
    }

    protected function getDefaultModels() {
        return [];
    }

    /**
     *
     * @return string
     */
    public static function getModuleName() {
        return 'comuni';
    }

    public function getWidgetGraphics() {
        return NULL;
    }

    public function getWidgetIcons() {
        return [
            WidgetIconAmmComuni::className(),
            WidgetIconComuni::className(),
            WidgetIconProvince::className(),
        ];
    }

}
