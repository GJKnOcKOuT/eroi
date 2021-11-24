<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\dashboard\utility\DashboardUtility;
use arter\amos\core\migration\AmosMigrationWidgets;

/**
 * Class m190423_171550_update_aster_widgets_partnership_profiles_default_order
 */
class m190423_171550_update_aster_widgets_partnership_profiles_default_order extends AmosMigrationWidgets {

  /**
   * Override this to make operations after adding the widgets.
   * @return bool
   */
  public function afterAddWidgets() {
      return DashboardUtility::resetDashboardsByModule('partnershipprofiles');
  }

  /**
   * Override this to make operations after removing the widgets.
   * @return bool
   */
  public function afterRemoveWidgets() {
    return DashboardUtility::resetDashboardsByModule('partnershipprofiles');
  }

  /**
   * @inheritdoc
   */
  protected function initWidgetsConfs() {
    $this->widgets = [
      [
        // Utenti
        'classname' => arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesCreatedBy::className(),
        'update' => true,
        'default_order' => 25
      ],
      [
        'classname' => arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesAll::className(),
        'update' => true,
        'default_order' => 30
      ],
      [
        'classname' => arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesAllAdmin::className(),
        'update' => true,
        'default_order' => 30
       ],
    ];
  }
}
