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

namespace arter\amos\dashboard\controllers;

use arter\amos\dashboard\models\AmosUserDashboards;
use arter\amos\dashboard\models\search\AmosUserDashboardsSearch;
use arter\amos\dashboard\models\search\AmosWidgetsSearch;
use Yii;
use yii\base\Module;
use yii\db\ActiveQuery;

/**
 * Class TabDashboardControllerTrait
 * @package arter\amos\dashboard\controllers
 */
trait TabDashboardControllerTrait
{
    /**
     * @var int $slide
     */
    public $slide = 1;

    /**
     * @var AmosUserDashboards $currentDashboard
     */
    public $currentDashboard;

    /**
     * @var string $customModule This custom module is useful to generate other tab internal dashboard other than the base plugin unique name.
     */
    public $customModule;

    /**
     * @var string $child_of
     */
    public $child_of = null;

    /**
     * Metodo per inizializzazione del trait
     */
    public function initDashboardTrait()
    {
        /** @var Module $this ->module */
        $amosUserDashboardsSearch = new AmosUserDashboardsSearch();
        /** @var AmosUserDashboards $dashboard */
        $dashboard                = $amosUserDashboardsSearch->current([
                'user_id' => Yii::$app->getUser()->getId(),
                'slide' => $this->getSlide(),
                'module' => (!is_null($this->customModule) ? $this->customModule : $this->module->getUniqueId())
            ])->one();
        $this->setCurrentDashboard($dashboard);
    }

    /**
     * @return int
     */
    public function getSlide()
    {
        return $this->slide;
    }

    /**
     * @param int $slide
     */
    public function setSlide($slide)
    {
        $this->slide = $slide;
    }

    /**
     * @return AmosUserDashboards
     */
    public function getCurrentDashboard()
    {
        if (!isset($this->currentDashboard)) {
            $this->initDashboard();
        }
        return $this->currentDashboard;
    }

    /**
     * @param AmosUserDashboards $currentDashboard
     */
    public function setCurrentDashboard($currentDashboard)
    {
        $this->currentDashboard = $currentDashboard;
    }

    /**
     * Inizializzazione della dashboard a tab
     */
    private function initDashboard()
    {
        /** @var Module $this ->module */
        /** @var ActiveQuery $amosWidgetsQuery */
        $amosWidgetsQuery         = null;
        $amosUserDashboardsSearch = new AmosUserDashboardsSearch();
        $params                   = [
            'user_id' => Yii::$app->getUser()->getId(),
            'slide' => $this->getSlide(),
            'module' => (!is_null($this->customModule) ? $this->customModule : $this->module->getUniqueId())
        ];

        $dashboard = $amosUserDashboardsSearch->current($params)->one();

        if (!$dashboard) {
            $dashboard = new AmosUserDashboards($params);
            $dashboard->save();

            if (Yii::$app->getModule('dashboard')->initHierarchyWidgets) {
                if ($dashboard->isPrimary()) {

                    $amosWidgetsQuery = AmosWidgetsSearch::selectable()
                        ->andWhere(['child_of' => null]);
                } else {
                    $amosWidgetsQuery = AmosWidgetsSearch::selectable()
                        ->andWhere(['is not', 'child_of', null])
                        ->andWhere(['module' => $dashboard->module]);
                }
            } elseif (Yii::$app->getModule('dashboard')->initChildWidget) {
                if ($dashboard->isPrimary()) {
                    $amosWidgetsQuery = AmosWidgetsSearch::selectableIcon()
                        ->andWhere(['is not', 'child_of', null]);
                    $amosWidgetsQuery->union(AmosWidgetsSearch::selectableGraphic());
                } else {
                    $amosWidgetsQuery = AmosWidgetsSearch::selectable()
                        ->andWhere(['is not', 'child_of', null])
                        ->andWhere(['module' => $dashboard->module]);
                }
            }

            $widgets = $amosWidgetsQuery->all();
            foreach ($widgets as $widget) {
                if (!empty($widget->id)) {
                    /** @var AmosWidgetsSearch $widget */
                    $dashboard->link('amosWidgetsClassnames', $widget,
                        [
                        'amos_widgets_id' => $widget->id,
                        'order' => $widget->default_order
                    ]);
                }
            }
        }

        $this->setCurrentDashboard($dashboard);
    }
}