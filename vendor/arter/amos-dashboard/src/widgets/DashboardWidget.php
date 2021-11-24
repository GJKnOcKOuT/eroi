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

namespace arter\amos\dashboard\widgets;

use Yii;
use yii\base\Widget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\dashboard\AmosDashboard;
use arter\amos\dashboard\models\search\AmosWidgetsSearch;
use arter\amos\dashboard\models\AmosWidgets;
use arter\amos\dashboard\assets\SubDashboardAsset;
use arter\amos\core\views\assets\AmosCoreAsset;
use arter\amos\dashboard\assets\ModuleDashboardAsset;

/**
 * Class DashboardWidget
 * @package arter\amos\dashboard\widgets
 */
class DashboardWidget extends Widget
{

    /**
     * Title that show in the breadcrumb
     * @var string
     */
    public
        $title,
        $forceAll = true,
        $classDivGraphic = 'grid-item',
        $graphicCustomSize = false,
        $widgetParentClassname = null;

    /**
     * widget initialization
     */
    public function init()
    {
        parent::init();

        if (empty($this->title)) {
            $this->title = AmosDashboard::t('amosdashboard', 'Dashboard del plugin');
        }
    }

    /**
     * @return mixed
     */
    public function run()
    {
        return $this->getHtml();
    }

    /**
     * This method render the widget
     * @param type $icons
     * @param type $graphics
     * @return type
     */
    protected function getHtml()
    {
        $moduleL = \Yii::$app->getModule('layout');
        $layoutModuleSet = isset($moduleL);
        $showWidgetsGraphic = [];
        $controller = \Yii::$app->controller;
        $currentDashboard = $controller->getCurrentDashboard();

        AmosCoreAsset::register($controller->getView());
        ModuleDashboardAsset::register($controller->getView());
        AmosIcons::map($controller->getView());
        SubDashboardAsset::register($controller->getView());

        return $this->render(
                'dashboard',
                [
                    'layoutModuleSet' => $layoutModuleSet,
                    'currentDashboard' => $currentDashboard,
                    'classDivGraphic' => $this->classDivGraphic,
                    'graphicCustomSize' => $this->graphicCustomSize,
                    'forceAll' => $this->forceAll,
                    'title' => $this->title,
                    'widgetParentClass' => $this->widgetParentClassname
                ]
        );
    }

}
