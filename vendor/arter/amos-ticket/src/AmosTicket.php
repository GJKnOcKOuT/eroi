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
 * @package    arter\amos\ticket
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\ticket;

use arter\amos\core\interfaces\CmsModuleInterface;
use arter\amos\core\interfaces\SearchModuleInterface;
use arter\amos\core\module\AmosModule;
use arter\amos\core\module\ModuleInterface;
use arter\amos\core\user\User;
use arter\amos\ticket\models\search\TicketFaqSearch;
use arter\amos\ticket\models\TicketFaq;
use arter\amos\ticket\widgets\icons\WidgetIconTicketAdminFaq;
use arter\amos\ticket\widgets\icons\WidgetIconTicketAll;
use arter\amos\ticket\widgets\icons\WidgetIconTicketCategorie;
use arter\amos\ticket\widgets\icons\WidgetIconTicketClosed;
use arter\amos\ticket\widgets\icons\WidgetIconTicketDashboard;
use arter\amos\ticket\widgets\icons\WidgetIconTicketFaq;
use arter\amos\ticket\widgets\icons\WidgetIconTicketProcessing;
use arter\amos\ticket\widgets\icons\WidgetIconTicketWaiting;
use arter\amos\ticket\models\Ticket;
use Yii;

/**
 * Class AmosTicket
 * @package arter\amos\ticket
 */
class AmosTicket extends AmosModule implements ModuleInterface, SearchModuleInterface, CmsModuleInterface
{
    public static $CONFIG_FOLDER = 'config';

    public $config = [];
    public $fieldsConfigurations = [
        'required' => [
            'ticket_categoria_id',
            'titolo',
            'descrizione'
        ],
    ];

    public $enableOrganizationNameString = false;
    
    public $disableInfoFields = false;
    
    public $disableCategory = false;
    
    public $disableTicketOrganization = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/models', __DIR__ . '/models');
        \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/controllers', __DIR__ . '/controllers');
        \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/widgets/icons', __DIR__ . '/widgets/icons');
        \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/migrations', __DIR__ . '/migrations');

        // \Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'));
        // 
        // initialize the module with the configuration loaded from config.php
        $config = require(__DIR__ . DIRECTORY_SEPARATOR . self::$CONFIG_FOLDER . DIRECTORY_SEPARATOR . 'config.php');
        Yii::configure($this, $config);
    }

    /**
     * @inheritdoc
     */
    public static function getModuleName()
    {
        return 'ticket';
    }

    /**
     * @inheritdoc
     */
    public function getWidgetGraphics()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getWidgetIcons()
    {
        return [
            WidgetIconTicketDashboard::className(),
            WidgetIconTicketAdminFaq::className(),
            WidgetIconTicketCategorie::className(),
            WidgetIconTicketAll::className(),
            WidgetIconTicketClosed::className(),
            WidgetIconTicketFaq::className(),
            WidgetIconTicketProcessing::className(),
            WidgetIconTicketWaiting::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultModels()
    {
        return [
            'Ticket' => __NAMESPACE__ . '\\' . 'models\Ticket',
            'TicketCategorie' => __NAMESPACE__ . '\\' . 'models\TicketCategorie',
            'TicketCategorieUsersMm' => __NAMESPACE__ . '\\' . 'models\TicketCategorieUsersMm',
            'TicketFaq' => __NAMESPACE__ . '\\' . 'models\TicketFaq',
            'TicketSearch' => __NAMESPACE__ . '\\' . 'models\search\TicketSearch',
            'TicketFaqSearch' => __NAMESPACE__ . '\\' . 'models\search\TicketFaqSearch',
            'TicketCategorieSearch' => __NAMESPACE__ . '\\' . 'models\search\TicketCategorieSearch',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function getModuleIconName()
    {

        if (!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            return 'assistenza';
        } else {
            return 'feed';
        }
    }

    /**
     * @inheritdoc
     */
    public static function getModelClassName()
    {
        return TicketFaq::className();
    }

    /**
     * @inheritdoc
     */
    public static function getModelSearchClassName()
    {
        return TicketFaqSearch::className();
    }

    public static function createTicket($model, $data, $post)
    {
        /*
	print_r($post['RecordDynamicModel']['email']);
        die();
        */
       $user = User::findByUsername($post['RecordDynamicModel']['email']);

        //$titolo = $model->oggetto;
        $categoria_id = intval($post['RecordDynamicModel']['categoria']);
	$messageText = $post['RecordDynamicModel']['messaggio'];
	$styledMessageText = AmosTicket::createMessage($messageText);

       $ticket = new Ticket();
       $ticket->ticket_categoria_id = $categoria_id;
       $ticket->titolo = $post['RecordDynamicModel']['oggetto'];
       $ticket->descrizione = $styledMessageText;
       $ticket->created_by = $user->id;

       //print_r(\Yii::$app->request->post());
       //die();

       $ticket->save(false);


    }

    public static function createMessage($messageText){

	$styledMessageText = '<p>'.$messageText.'</p>';

	return $styledMessageText;

    }


}
