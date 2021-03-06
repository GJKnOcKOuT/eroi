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
 * @package    arter\amos\news
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\news;

use arter\amos\core\interfaces\CmsModuleInterface;
use arter\amos\core\interfaces\SearchModuleInterface;
use arter\amos\core\module\AmosModule;
use arter\amos\core\module\ModuleInterface;
use arter\amos\news\widgets\graphics\WidgetGraphicsUltimeNews;
use arter\amos\news\widgets\icons\WidgetIconAllNews;
use arter\amos\news\widgets\icons\WidgetIconNews;
use arter\amos\news\widgets\icons\WidgetIconNewsCategorie;
use arter\amos\news\widgets\icons\WidgetIconNewsCreatedBy;
use arter\amos\news\widgets\icons\WidgetIconNewsDashboard;
use arter\amos\news\widgets\icons\WidgetIconNewsDaValidare;
use yii\helpers\ArrayHelper;

/**
 * Class AmosNews
 * @package arter\amos\news
 */
class AmosNews extends AmosModule implements ModuleInterface, SearchModuleInterface, CmsModuleInterface {

  const
    MAX_LAST_NEWS_ON_DASHBOARD = 3;

  public static $CONFIG_FOLDER = 'config';

  /**
   * @var string|boolean the layout that should be applied for views within this module. This refers to a view name
   * relative to [[layoutPath]]. If this is not set, it means the layout value of the [[module|parent module]]
   * will be taken. If this is false, layout will be disabled within this module.
   */
  public $layout = 'main';

  /**
   * @var string $name
   */
  public $name = 'Notizie';

  /**
   * If this attribute is true the validation of the publication date is active
   * @var boolean $validatePublicationDate
   */
  public $validatePublicationDate = true;

  /**
   * @var bool|false $filterCategoriesByRole - if true, enables category role check via table news_category_roles_mm
   */
  public $filterCategoriesByRole = false;

  /**
     * @var array
     */
    public $whiteListRolesCategories = ['ADMIN', 'BASIC_USER'];

  /**
   * @var bool|false $hidePubblicationDate
   */
  public $hidePubblicationDate = false;

  /**
   * Hide the Option wheel in the graphic widget
   * @var bool|false $hideWidgetGraphicsActions
   */
  public $hideWidgetGraphicsActions = false;

  /**
   * @var array $newsRequiredFields - mandatory fields in News form
   */
  public $newsRequiredFields = [
    'news_categorie_id',
    'titolo',
    'status',
    'descrizione',
  ];

  /**
   * The ID of the default category pre-selected for the new News
   * @var integer
   */
  public $defaultCategory;

  /**
   * The default value for enable comments
   * @var integer
   */
  public $defaultEnableComments = 1;

  /**
   * @var bool $hideDataRimozioneView
   */
  public $hideDataRimozioneView = false;

  /**
   * @var array $defaultListViews This set the default order for the views in lists
   */
  public $defaultListViews = ['list', 'grid'];

  /**
   * This set the auto update of the publication date on the save if the news is published
   * @var boolean $autoUpdatePublicationDate
   */
  public $autoUpdatePublicationDate = false;

  /**
   *
   * @var type
   */
  public $defaultWidgetIndexUrl = '/news/news/own-interest-news';


    /**
     * @var bool
     */
    public $enableCategoriesForCommunity = false;

    /**
     * @var bool
     */
    public $showAllCategoriesForCommunity = true;

    /**
     * @var array
     */
    public $viewPathEmailSummary = [
        'arter\amos\news\models\News' => '@vendor/arter/amos-news/src/views/email/notify_summary'
    ];

    public $viewPathEmailSummaryNetwork = [
        'arter\amos\news\models\News' => '@vendor/arter/amos-news/src/views/email/notify_summary_network'
    ];
    /*
     * @var bool disableStandardWorkflow Disable standard worflow, direct publish
     */
    public $disableStandardWorkflow = false;

    /*
     * @var int $numberListTag 10 default
     */
    public $numberListTag = 10;

  /**
   * @inheritdoc
   */
  public static function getModuleName() {
    return "news";
  }

   /**
     * @inheritdoc
     */
    public static function getModelSearchClassName()
    {
        return AmosNews::instance()->model('NewsSearch');
    }

    /**
     * @inheritdoc
     */
    public static function getModelClassName()
    {
        return AmosNews::instance()->model('News');
    }

  /**
   * @inheritdoc
   */
  public static function getModuleIconName() {
    return 'feed';
  }

  /**
   * @inheritdoc
   */
  public function init() {
    parent::init();

    \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/controllers', __DIR__ . '/controllers');

    //Configuration: merge default module configurations loaded from config.php with module configurations set by the application
    $config = require(__DIR__ . DIRECTORY_SEPARATOR . self::$CONFIG_FOLDER . DIRECTORY_SEPARATOR . 'config.php');
    \Yii::configure($this, ArrayHelper::merge($config, $this));
  }

  /**
   * @inheritdoc
   */
  public function getWidgetIcons() {
    return [
      WidgetIconNews::className(),
      WidgetIconNewsCategorie::className(),
      WidgetIconNewsCreatedBy::className(),
      WidgetIconNewsDaValidare::className(),
      WidgetIconNewsDashboard::className(),
      WidgetIconAllNews::className(),
    ];
  }

  /**
   * @inheritdoc
   */
  public function getWidgetGraphics() {
    return [
      WidgetGraphicsUltimeNews::className(),
    ];
  }

  /**
   * Get default model classes
   */
  protected function getDefaultModels() {
    return [
      'News' => __NAMESPACE__ . '\\' . 'models\News',
      'NewsCategorie' => __NAMESPACE__ . '\\' . 'models\NewsCategorie',
      'NewsSearch' => __NAMESPACE__ . '\\' . 'models\search\NewsSearch',
    ];
  }

  /**
   * This method return the session key that must be used to add in session
   * the url from the user have started the content creation.
   * @return string
   */
  public static function beginCreateNewSessionKey() {
    return 'beginCreateNewUrl_' . self::getModuleName();
  }



}
