<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles\widget\graphics
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_partnership_profiles\widget\graphics;

use arter\amos\core\widget\WidgetGraphic;
use arter\amos\partnershipprofiles\models\search\PartnershipProfilesSearch;
use arter\amos\partnershipprofiles\Module;

use Yii;
use yii\helpers\ArrayHelper;

class WidgetGraphicsLatestPartnershipProfilesAnimator extends WidgetGraphic {

  /**
   * 
   */
  public function init() {
    parent::init();

    $this->setLabel(\Yii::t('amospartenershipprofiles', 'Le sfide in cui sei coinvolto'));
    $this->setDescription(Yii::t('amospartenershipprofile', 'Le sfide in cui sei coinvolto'));
  }

  /**
   * rendering of the view ultime_discussioni
   *
   * @return string
   */
  public function getHtml() {
    $modelSearch = new \backend\modules\aster_partnership_profiles\models\search\AnimationPartnershipProfilesSearch();
    $listaPartenership = $modelSearch->latestAnimationSearch($_GET, Module::MAX_LAST_PARTNERSHIP_ON_DASHBOARD);

    $viewToRender = 'latest_partenership_profiles_animator';

    if (is_null(\Yii::$app->getModule('layout'))) {
      $viewToRender = 'latest_partenership_profiles_old';
    }

    return $this->render($viewToRender, [
        'listaPartnership' => $listaPartenership,
        'widget' => $this,
        'toRefreshSectionId' => 'widgetGraphicLatestThreads'
    ]);
  }

}
