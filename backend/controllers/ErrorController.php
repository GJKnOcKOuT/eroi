<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */
/**
 */

namespace backend\controllers;

use common\models\FirstAccessForm;
use common\models\ForgotPasswordForm;
use common\models\LoginForm;
use common\models\User;
use arter\amos\admin\models\UserProfile;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use \yii\helpers\Url;
use yii\web\Controller;
use yii\web\Cookie;

class ErrorController extends Controller
{


    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'error',
                            'error404',
                            'error403',
                            'error500',
                        ],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post'],
                ],
            ],
        ];
    }

  public function actions() {
        $this->layout = '@vendor/arter/amos-layout/src/views/layouts/main';
        return [
            'error' => [
                'class' => 'backend\actions\ErrorAction',
            ],
        ];
    }
}