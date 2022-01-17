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
 * @package    arter\amos\best\practice\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\best\practice\controllers;

use arter\amos\best\practice\Module;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * Class BestPracticeController
 * This is the class for controller "BestPracticeController".
 * @package arter\amos\best\practice\controllers
 */
class BestPracticeController extends base\BestPracticeController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'created-by',
                            'to-validate',
                            'all',
                            'admin-all',
                            'own-interest'
                        ],
                        'roles' => ['BESTPRACTICE_ADMINISTRATOR']
                    ],
                    [
                        'allow' => true,
                        'actions' => [
                            'own-interest',
                            'created-by',
                            'all',
                        ],
                        'roles' => ['BESTPRACTICE_CREATOR']
                    ],
                    [
                        'allow' => true,
                        'actions' => [
                            'to-validate',
                            'all',
                            'validate',
                            'own-interest'
                        ],
                        'roles' => ['BESTPRACTICE_VALIDATOR']
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post', 'get']
                ]
            ]
        ]);
        return $behaviors;
    }

    /**
     * @return string
     */
    public function actionOwnInterest()
    {
        $this->setDataProvider($this->modelSearch->searchOwnInterest(\Yii::$app->request->getQueryParams()));
        return $this->baseListsAction(Module::t('amosbestpractice', 'Own Interest'));
    }

    /**
     * @return string
     */
    public function actionAll()
    {
        $this->setDataProvider($this->modelSearch->searchAll(\Yii::$app->request->getQueryParams()));
        return $this->baseListsAction(Module::t('amosbestpractice', 'Tutte'));
    }

    /**
     * @return string
     */
    public function actionCreatedBy()
    {
        $this->setDataProvider($this->modelSearch->searchOwn(\Yii::$app->request->getQueryParams()));
        $this->setAvailableViews([
            'grid' => [
                'name' => 'grid',
                'label' => AmosIcons::show('view-list-alt') . Html::tag('p', Module::tHtml('amoscore', 'Table')),
                'url' => '?currentView=grid'
            ]
        ]);
        $this->setCurrentView($this->getAvailableView('grid'));
        return $this->baseListsAction(Module::t('amosbestpractice', 'Create da me'));
    }

    /**
     * @return string
     */
    public function actionToValidate()
    {
        $this->setDataProvider($this->modelSearch->searchToValidate(\Yii::$app->request->getQueryParams()));
        $this->setAvailableViews([
            'grid' => [
                'name' => 'grid',
                'label' => AmosIcons::show('view-list-alt') . Html::tag('p', Module::tHtml('amoscore', 'Table')),
                'url' => '?currentView=grid'
            ]
        ]);
        $this->setCurrentView($this->getAvailableView('grid'));
        return $this->baseListsAction(Module::t('amosbestpractice', 'To Validate'));
    }

    /**
     * @return string
     */
    public function actionAdminAll()
    {
        $this->setDataProvider($this->modelSearch->searchAllAdmin(\Yii::$app->request->getQueryParams()));
        return $this->baseListsAction(Module::t('amosbestpractice', 'Admin All'));
    }
}
