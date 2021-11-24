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
 * @package    arter\amos\sondaggi
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\sondaggi;

use arter\amos\core\interfaces\CmsModuleInterface;
use arter\amos\core\module\AmosModule;
use arter\amos\core\module\ModuleInterface;
use arter\amos\sondaggi\widgets\icons\WidgetIconAmministraSondaggi;
use arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggi;
use arter\amos\sondaggi\widgets\icons\WidgetIconPubblicaSondaggi;
use arter\amos\sondaggi\widgets\icons\WidgetIconSondaggi;
use Yii;
use yii\db\Connection;
use yii\helpers\ArrayHelper;

/**
 * Class AmosSondaggi
 * @package arter\amos\sondaggi
 */
class AmosSondaggi extends AmosModule implements ModuleInterface, CmsModuleInterface
{
    public static $CONFIG_FOLDER = 'config';
    public $controllerNamespace = 'arter\amos\sondaggi\controllers';
    public $newFileMode = 0666;
    public $newDirMode = 0777;

    /**
     * In the case of a private poll for role, it is possible to send the notification to the users who can fill out the survey.
     * @var boolean
     */
    public $enableNotificationEmailByRoles = false;

    /**
     * Default email for the sender
     * @var string
     */
    public $defaultEmailSender;

    /**
     * It allows to show in the first page of the results the geoChart based on the province of domicile.
     * @var boolean
     */
    public $enableGeoChart = false;

    /**
     * It allows to show in the first page of the results a partecipant report if available.
     * @var boolean
     */
    public $enablePartecipantsReport = false;

    /**
     * The fields that will be displayed in the participant's //TO-DO
     * @var array
     */
    public $fieldsByPartecipants = [];

    /**
     * @var string|boolean the layout that should be applied for views within this module. This refers to a view name
     * relative to [[layoutPath]]. If this is not set, it means the layout value of the [[module|parent module]]
     * will be taken. If this is false, layout will be disabled within this module.
     */
    public $layout = 'main';
    public $name = 'Sondaggi';

    /**
     * @var Connection|array|string the DB connection object or the application component ID of the DB connection.
     */
    public $db = 'db';
    
    /**
     * Hide the Option wheel in the graphic widget
     * @var bool|false $hideWidgetGraphicsActions
     */
    public $hideWidgetGraphicsActions = false;
    
    /**
     * @var array $viewPathEmailSummary
     */
    public $viewPathEmailSummary = [
        'arter\amos\sondaggi\models\Sondaggi' => '@vendor/arter/amos-sondaggi/src/views/email/notify_summary'
    ];
    
    /**
     * @var array $viewPathEmailSummaryNetwork
     */
    public $viewPathEmailSummaryNetwork = [
        'arter\amos\sondaggi\models\Sondaggi' => '@vendor/arter/amos-sondaggi/src/views/email/notify_summary_network'
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->db = Yii::$app->db;

        \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/controllers/', __DIR__ . '/controllers/');
        // initialize the module with the configuration loaded from config.php
        $config = require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');
        Yii::configure($this, ArrayHelper::merge($config, $this));
    }
    

    /**
     * @inheritdoc
     */
    public static function getModuleName()
    {
        return "sondaggi";
    }

    /**
     * @inheritdoc
     */
    public function getWidgetIcons()
    {
        return [
            WidgetIconSondaggi::className(),
            WidgetIconCompilaSondaggi::className(),
            WidgetIconPubblicaSondaggi::className(),
            WidgetIconAmministraSondaggi::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getWidgetGraphics()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultModels()
    {
        return [
            'Sondaggi' => __NAMESPACE__ . '\\' . 'models\Sondaggi',
            'SondaggiSearch' => __NAMESPACE__ . '\\' . 'models\search\SondaggiSearch',
        ];
    }


    /**
     *
     * @return string
     */
    public static function getModelClassName()
    {
        return AmosSondaggi::instance()->model('Sondaggi');
    }

    /**
     *
     * @return string
     */
    public static function getModelSearchClassName()
    {
        return AmosSondaggi::instance()->model('SondaggiSearch');
    }

    /**
     *
     * @return string
     */
    public function getFrontEndMenu($dept = 1)
    {
        $menu = "";
        $app  = \Yii::$app;
        if ((is_null($app->user) || $app->user->id == $app->params['platformConfigurations']['guestUserId'])) {
            //$menu .= $this->addFrontEndMenu(AmosSondaggi::t('amossondaggi','Gestione sondaggi'), AmosSondaggi::toUrlModule('/sondaggi'));
        }else{
            $menu .= $this->addFrontEndMenu(AmosSondaggi::t('amossondaggi','#menu_front_sondaggi'), AmosSondaggi::toUrlModule('/sondaggi'));
        }
        return $menu;
    }
}
