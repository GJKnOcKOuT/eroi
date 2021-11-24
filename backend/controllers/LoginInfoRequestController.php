<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\controllers;

use backend\models\MyUserProfile;
use arter\amos\admin\models\search\UserProfileSearch;
use arter\amos\admin\models\UserProfile;
use arter\amos\core\controllers\CrudController;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\utilities\Email;
use arter\amos\organizzazioni\utility\OrganizzazioniUtility;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use arter\amos\core\user\User;

/**
 * Class LoginInfoRequestController
 * @package e015\common\controllers
 */
class LoginInfoRequestController extends CrudController {

    /**
     * @var string $layout
     */
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function init() {
        $this->setModelObj(new UserProfile());
        $this->setModelSearch(new UserProfileSearch());


        $this->setAvailableViews([
            'grid' => [
                'name' => 'grid',
                'label' => AmosIcons::show('view-list-alt') . Html::tag('p', BaseAmosModule::tHtml('amoscore', 'Table')),
                'url' => '?currentView=grid'
            ],
                /* 'list' => [
                  'name' => 'list',
                  'label' => AmosIcons::show('view-list') . Html::tag('p', BaseAmosModule::tHtml('amoscore', 'List')),
                  'url' => '?currentView=list'
                  ],
                  'icon' => [
                  'name' => 'icon',
                  'label' => AmosIcons::show('grid') . Html::tag('p', BaseAmosModule::tHtml('amoscore', 'Icons')),
                  'url' => '?currentView=icon'
                  ],
                  'map' => [
                  'name' => 'map',
                  'label' => AmosIcons::show('map') . Html::tag('p', BaseAmosModule::tHtml('amoscore', 'Map')),
                  'url' => '?currentView=map'
                  ],
                  'calendar' => [
                  'name' => 'calendar',
                  'intestazione' => '', //codice HTML per l'intestazione che verr� caricato prima del calendario,
                  //per esempio si pu� inserire una funzione $model->getHtmlIntestazione() creata ad hoc
                  'label' => AmosIcons::show('calendar') . Html::tag('p', BaseAmosModule::tHtml('amoscore', 'Calendari')),
                  'url' => '?currentView=calendar'
                  ], */
        ]);

        parent::init();

        $this->setUpLayout();
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        $behaviors = ArrayHelper::merge(parent::behaviors(), [
                    'access' => [
                        'class' => AccessControl::className(),
                        'rules' => [
                            [
                                'allow' => true,
                                'actions' => [
                                    'required-informations'
                                ],
                            ],
                        ]
                    ],
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'required-informations' => ['post', 'get']
                        ]
                    ]
        ]);
        return $behaviors;
    }

    /**
     * @param $id
     * @param null $url
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionRequiredInformations($id, $url = null) {
        $layout = '@vendor/arter/amos-layout/src/views/layouts/form';
        $this->setUpLayout($layout);
        $up = UserProfile::findOne($id);
        if (empty($up)) {
            throw new BadRequestHttpException('Parameter (id) error: ID = ' . $id . ' is not a user');
        }
        $myUp = new MyUserProfile();
        if ($myUp->load(\Yii::$app->request->post()) && $myUp->validate()) {
            $up->privacy = $myUp->privacy;
            if ($up->save(false)) {
               
                return $this->redirect($url);
            } else {
                Yii::$app->getSession()->addFlash('danger', 'Error while saving profile.');
            }
        }
        return $this->render('required-informations', [
                    'model' => $up,
                    'myModelUserProfile' => $myUp
        ]);
    }

}
