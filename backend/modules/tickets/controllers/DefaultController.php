<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\tickets\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\tickets\controllers;

use backend\modules\tickets\models\ContactForm;
use arter\amos\admin\models\UserProfile;
use arter\amos\core\controllers\BaseController;
use arter\amos\dashboard\controllers\TabDashboardControllerTrait;
use Yii;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\filters\VerbFilter;

/**
 * Class DefaultController
 * @package backend\modules\tickets\controllers
 */
class DefaultController extends BaseController
{
    use TabDashboardControllerTrait;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'index',
                            'captcha'

                        ],
                        //'roles' => ['@']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post', 'get']
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->initDashboardTrait();
        $this->setModelObj(new ContactForm());
        parent::init();
        $this->setUpLayout('main');
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $this->setUpLayout('main');
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ],
        ];
    }

    /**
     * Displays contacts.
     *
     * @return string
     */
    public function actionIndex($layout = NULL)
    {
        $modelProfile = UserProfile::findOne(['user_id' => Yii::$app->user->id]);
        $modelForm = new ContactForm();
        if ($modelForm->load(Yii::$app->request->post()) && $modelForm->validate()) {
            if ($modelForm->spedisciEmailStandard($modelProfile)) {
                Yii::$app->session->addFlash('success', 'Grazie per averci contattato. Vi risponderemo appena possibile.');
            } else {
                Yii::$app->session->addFlash('error', 'C\'è stato un\'errore nell\'invio dell\'email.');
            }
            return $this->refresh();
        } else {
            $this->setUpLayout('form');
            return $this->render('contacts', ['modelForm' => $modelForm, 'modelProfile' => $modelProfile]);
        }
    }
}
