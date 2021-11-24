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
 * @package    arter\amos\dashboard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\dashboard;

use arter\amos\core\module\AmosModule;
use yii\base\BootstrapInterface;

class AmosDashboard extends AmosModule implements BootstrapInterface {

  public static 
    $CONFIG_FOLDER = 'config';
  
  public 
    $controllerNamespace = 'arter\amos\dashboard\controllers',
    $controllerConsoleNamespace = 'arter\amos\dashboard\commands'
  ;

  /**
   * @var string|boolean the layout that should be applied for views within this module. This refers to a view name
   * relative to [[layoutPath]]. If this is not set, it means the layout value of the [[module|parent module]]
   * will be taken. If this is false, layout will be disabled within this module.
   */
  public 
    $layout = 'main',
    $name = 'Dashboard'
  ;

  //public $initWidgets = true;

  /**
   * If true the widgets will be refreshed if
   * the AmosWidgets.created_at > AmosUserDashboars.updated_at
   * @var boolean
   */
  public
    $refreshWidgets = true,
    $initIfEmpty = true,
    $initAllWidgets = false,
    $initHierarchyWidgets = true,
    $initChildWidget = false,
    
    $modulesSubdashboard,                           // Array of the modules that have the sub-dashboard
    $useWidgetGraphicDashboardVisible = true,       // If true, only widgets that have dashboard_visible set to 1 will be shown
    $useWidgetGraphicOrder = false
  ;

  /**
   * 
   * @param \yii\console\Application $app
   */
  public function bootstrap($app) {
    if ($app instanceof \yii\console\Application) {
      $this->controllerNamespace = $this->controllerConsoleNamespace;
    }
  }

  /**
   * 
   */
  public function init() {
    parent::init();
    
    \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/controllers', __DIR__ . '/controllers/');
    // initialize the module with the configuration loaded from config.php
    //  \Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . self::$CONFIG_FOLDER . DIRECTORY_SEPARATOR . 'config.php'));
  }

  /**
   * @return string
   */
  public static function getModuleName() {
    return "dashboard";
  }

  /**
   * 
   */
  public function getWidgetIcons() {}

  /**
   * 
   */
  public function getWidgetGraphics() {}

  /**
   * 
   */
  protected function getDefaultModels() {
    // TODO: Implement getDefaultModels() method.
  }

  /**
   * 
   * @param type $widgets
   */
  public function setModuleSubDashboard($widgets) {
    if (is_array($widgets)) {
      ;
    } else if (is_string($widgets)) {
      $widgets = [$widgets];
    }
  }

}