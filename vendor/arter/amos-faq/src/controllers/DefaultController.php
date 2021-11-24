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
 * @package    arter\amos\faq\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\faq\controllers;

use arter\amos\dashboard\controllers\base\DashboardController;
use yii\helpers\Url;

/**
 * Class DefaultController
 * @package arter\amos\faq\controllers
 */
class DefaultController extends DashboardController
{
    /**
     * @var string $layout Layout for internal dashboard.
     */
    public $layout = 'dashboard_interna';

    /**
     * @inheritdoc
     */
    public function init() {

        parent::init();
        $this->setUpLayout();
        // custom initialization code goes here
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex($oldDashboard = null)
    {
        if (is_null($oldDashboard)) {
            return $this->redirect(['/faq/faq/index']);
        }
        Url::remember();
        $params = ['currentDashboard' => $this->getCurrentDashboard()];
        return $this->render('index', $params);
    }

    /**
     * @param null $layout
     * @return bool
     */
    public function setUpLayout($layout = null){
        if ($layout === false){
            $this->layout = false;
            return true;
        }
        $module = \Yii::$app->getModule('layout');
        if(empty($module)){
            $this->layout =  '@vendor/arter/amos-core/views/layouts/' . (!empty($layout) ? $layout : $this->layout);
            return true;
        }
        $this->layout = (!empty($layout)) ? $layout : $this->layout;
        return true;
    }
}
