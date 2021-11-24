<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\utility\controllers;

use arter\amos\utility\Module;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;
use AD7six\Dsn\Dsn;

class FilesController extends Controller
{
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
                        'allow' => true,
                        'actions' => [
                            'index',
                        ],
                        'roles' => ['ADMIN']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['post', 'get']
                ]
            ]
        ];
    }

    public $layout = "main";

    /**
     * @inheritdoc
     */
    public function init() {

        parent::init();
        $this->setUpLayout();
        // custom initialization code goes here
    }

    /**
     * @param null $layout
     * @return bool
     */
    public function setUpLayout($layout = null){
        $this->layout = false;
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $src = Yii::getAlias('@vendor/arter/amos-utility/src');

        define('FM_EMBED', true);
        define('FM_ROOT_PATH', Yii::getAlias('@app').'/..');
        define('FM_SELF_URL', '/' . Yii::$app->controller->getRoute());
        define('FM_ROOT_URL', '/' . Yii::$app->controller->getRoute());
        $_SERVER["PHP_SELF"] = '/' . Yii::$app->controller->getRoute();

        require $src . '/libs/tinyfilemanager.php';
        die;
    }
}