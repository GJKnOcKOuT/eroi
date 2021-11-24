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
 * @package    arter\amos\admin\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\layout\controllers;

use arter\amos\admin\models\UserProfileReactivationRequest;
use arter\amos\core\controllers\BackendController;
use arter\amos\core\forms\FirstAccessForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Class SecurityController
 * @package arter\amos\admin\controllers
 */
class MaintenanceController extends BackendController
{
    /**
     * @var string $layout
     */
    public $layout = 'maintenance';


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setUpLayout();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'maintenance',
                        ],
                        'allow' => true,
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }


    public function actionIndex(){

        $this->redirect(['maintenance']);
    }

    /**
     * Maintenance action
     * @return string
     */
    public function actionMaintenance()
    {
//        $this->setUpLayout('maintenance');
    $module = \Yii::$app->getModule($this->module->id);
    $view = (!empty($module->viewMaintenanceMode)? $module->viewMaintenanceMode : 'maintenance');
        return $this->render($view);

    }

}
