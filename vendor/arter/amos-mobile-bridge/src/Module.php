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
 * @package    arter\amos\mobile\bridge
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
namespace arter\amos\mobile\bridge;

use arter\amos\core\module\AmosModule;
use arter\amos\mobile\bridge\controllers\NotificationController;
use arter\amos\mobile\bridge\modules\v1\V1;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\httpclient\Exception;
use yii\web\Application;

/**
 * Class Module
 * @package arter\amos\mobile\bridge
 */
class Module extends AmosModule implements BootstrapInterface
{

    public static $CONFIG_FOLDER = 'config';

    /**
     * @inheritdoc
     */
    static $name = 'mobilebridge';

    /**
     * @var string|boolean the layout that should be applied for views within this module. This refers to a view name
     * relative to [[layoutPath]]. If this is not set, it means the layout value of the [[module|parent module]]
     * will be taken. If this is false, layout will be disabled within this module.
     */
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'arter\amos\mobile\bridge\controllers';
    public $timeout = 180;

    /**
     * @throws Exception
     */
    public function init()
    {
        parent::init();

        //Configuration
        $config = require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');
        Yii::configure($this, ArrayHelper::merge($config, $this));

        if (!is_null(Yii::$app->request)) {
            if (strpos(Yii::$app->request->url, self::getModuleName())) {

                //Override user identity
                Yii::$app->set('user', $this->user);

                //Override request component
                Yii::$app->set('request', $this->request);
            }
        }
    }

    public function bootstrap($app)
    {
        if ($app instanceof Application) {
            $notificationController = new NotificationController('notifications', $this);

            Event::on(ActiveRecord::className(), ActiveRecord::EVENT_AFTER_INSERT, [$notificationController, 'afterActiveRecordCreate']);
        }
    }

    public static function getModuleName()
    {
        return self::$name;
    }

    public function getWidgetIcons()
    {
        return [
        ];
    }

    public function getWidgetGraphics()
    {
        return [
        ];
    }

    protected function getDefaultModels()
    {
        return [
        ];
    }
}
