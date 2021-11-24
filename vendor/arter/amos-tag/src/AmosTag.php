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
 * @package    arter\amos\tag
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\tag;

use arter\amos\core\module\AmosModule;
use arter\amos\core\record\Record;
use arter\amos\tag\widgets\icons\WidgetIconTag;
use arter\amos\tag\widgets\icons\WidgetIconTagManager;
use Yii;

class AmosTag extends AmosModule {

  public $controllerNamespace = 'arter\amos\tag\controllers';

  /**
   * @var string
   */
  public $postKey = 'Tag';

  /**
   * @var array
   */
  public $modelsEnabled = [
  ];
  public $behaviors = [
    'arter\amos\core\behaviors\TaggableBehavior'
  ];
  public $name = 'Tag';

 public $selectSonsOnly = true;
  
  /**
   * 
   */
  public function init() {
    parent::init();
    
    Record::$modulesChainBehavior[] = 'tag';
    Yii::setAlias('@arter/amos/' . static::getModuleName() . '/controllers', __DIR__ . '/controllers');
    
    //aggiunge le configurazioni trovate nel file config/config.php
    Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'));
  }

  /**
   * 
   */
  public function bootstrap() {
    $treeManagerModule = Yii::$app->getModule('treemanager');
    if (!$treeManagerModule) {
      Yii::$app->setModule('treemanager', $this->getModule('treemanager'));
    }
  }

  /**
   * 
   * @return string
   */
  public static function getModuleName() {
    return 'tag';
  }

  /**
   * 
   */
  public function getWidgetGraphics() {
    
  }

  /**
   * 
   * @return type
   */
  public function getWidgetIcons() {
    return [
      WidgetIconTagManager::className(),
      WidgetIconTag::className()
    ];
  }

  /**
   * Chiave che verrà spedita in post
   *
   * @return string
   */
  public function getPostKey() {
    return $this->postKey;
  }

  /**
   * @param string $postKey
   */
  public function setPostKey($postKey) {
    $this->postKey = $postKey;
  }

  protected function getDefaultModels() {
    return [
      'Tag' => __NAMESPACE__ . '\\' . 'models\\Tag',
    ];
  }

}