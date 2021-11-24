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
 * @package    arter\amos\dashboard\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\dashboard\controllers;

use arter\amos\core\helpers\BreadcrumbHelper;
use arter\amos\dashboard\controllers\base\DashboardController;
use arter\amos\dashboard\models\AmosUserDashboards;
use yii\helpers\Url;

/**
 * Class DefaultController
 * @package arter\amos\dashboard\controllers
 */
class AjaxController extends DashboardController {

    /**
     * @inheritdoc
     */
    public function init() {

        parent::init();
        $this->setUpLayout();
    }

    /**
     * @return string
     */
    public function actionIndex($module, $parent = null) {
        $this->setUpLayout('dashboard');
        Url::remember();

//        $this->setCurrentDashboard($id);
        $currentDashboard = AmosUserDashboards::findOne(['user_id' => \Yii::$app->user->id, 'module' => $module]);
        $currentDashboard->showAllModule = true;
        $this->setCurrentDashboard($currentDashboard);
        BreadcrumbHelper::reset();
        $params = [
            'widgetParentClassname' => $parent,
            'currentDashboard' => $currentDashboard
        ];

        return $this->renderPartial('index', $params);
    }

}
