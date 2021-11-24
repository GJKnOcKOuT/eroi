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
 * @package    arter\amos\dashboard\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\dashboard\widgets\icons;

use arter\amos\core\widget\WidgetIcon;
use arter\amos\core\widget\WidgetAbstract;
use arter\amos\core\icons\AmosIcons;
use arter\amos\dashboard\AmosDashboard;

use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconEenDashboard
 *
 * @package arter\amos\een\widgets\icons
 */
class WidgetIconManagement extends WidgetIcon {

  /**
   * @inheritdoc
   */
  public function init() {
    parent::init();

    $paramsClassSpan = [
      'bk-backgroundIcon',
      'color-primary'
    ];

    $this->setLabel(AmosDashboard::tHtml('amosdashboard', 'Management'));
    $this->setDescription(AmosDashboard::t('amosdashboard', 'Plugin Management'));

    if (!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
      $this->setIconFramework(AmosIcons::IC);
      $this->setIcon('gestione');
      $paramsClassSpan = [];
    } else {
      $this->setIcon('wrench');
    }

    $this->enableDashboardModal();
    $this->setUrl(['']);
    $this->setCode('MANAGEMENT');
    $this->setModuleName('admin');
    $this->setNamespace(__CLASS__);

    $this->setClassSpan(
      ArrayHelper::merge(
        $this->getClassSpan(),
        $paramsClassSpan
      )
    );
  }

}
