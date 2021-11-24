<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_partnership_profiles\controllers;


use backend\modules\aster_partnership_profiles\models\PartnershipProfiles;
use backend\modules\aster_partnership_profiles\Module;
use backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideWidgetIcon;
use arter\amos\core\controllers\CrudController;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\widget\WidgetAbstract;
use arter\amos\dashboard\controllers\TabDashboardControllerTrait;
use arter\amos\partnershipprofiles\models\search\PartnershipProfilesSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use Yii;
use yii\helpers\Url;

class AnimationController extends CrudController
{

    /**
     * Trait used for initialize the news dashboard
     */
    use TabDashboardControllerTrait;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->initDashboardTrait();

        $this->setModelObj(new PartnershipProfiles());
        $this->setModelSearch(new PartnershipProfilesSearch());

        $this->viewList = [
            'name' => 'list',
            'label' => AmosIcons::show('view-list') . Html::tag('p', Module::tHtml('amospartnershipprofiles', 'List')),
            'url' => '?currentView=list'
        ];

        $this->viewGrid = [
            'name' => 'grid',
            'label' => AmosIcons::show('view-list-alt') . Html::tag('p', Module::tHtml('amospartnershipprofiles', 'Table')),
            'url' => '?currentView=grid'
        ];

        $this->setAvailableViews([
            'list' => $this->viewList,
            'grid' => $this->viewGrid
        ]);

        parent::init();


        if (!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->view->pluginIcon = 'ic ic-propostecollaborazione';
        }

        $this->setUpLayout();
    }


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
                            'to-assign',
                            'assigned',
                            'to-publish',
                            'published',
                        ],
                        'roles' => ['CM_SFIDE']
                    ],

                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['post', 'get']
                    ]
                ]
            ]
        ]);
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Used for set page title and breadcrumbs.
     * @param string $pageTitle
     */
    public function setTitleAndBreadcrumbs($pageTitle)
    {
        Yii::$app->view->title = $pageTitle;
        Yii::$app->view->params['breadcrumbs'] = [
            ['label' => $pageTitle]
        ];
    }

    /**
     * Set a view param used in \arter\amos\core\forms\CreateNewButtonWidget
     * @param bool $hideBtn
     */
    protected function setCreateNewBtnLabel($hideBtn = false)
    {
        Yii::$app->view->params['createNewBtnParams'] = [
            'createNewBtnLabel' => Module::t('amospartnershipprofiles', 'Add new partnership profile')
        ];
        if ($hideBtn) {
            $this->hideCreateNewBtn();
        }
    }

    /**
     * Method useful to hide the create new button.
     */
    protected function hideCreateNewBtn()
    {
        Yii::$app->view->params['createNewBtnParams']['layout'] = '';
    }

    /**
     * Set the begin create new button session key link and datetime.
     */
    protected function setSessionBeginCreateLink()
    {
        Yii::$app->session->set(Module::beginCreateNewSessionKeyPartnershipProfiles(), Url::previous());
        Yii::$app->session->set(Module::beginCreateNewSessionKeyPartnershipProfilesDateTime(), date('Y-m-d H:i:s'));
    }

    /**
     * This method is useful to set all common params for all list views.
     * @param bool $setCurrentDashboard
     * @param bool $hideCreateNewBtn
     */
    protected function setListViewsParams($setCurrentDashboard = true, $hideCreateNewBtn = false, $child_of = null)
    {
        $this->child_of = (($child_of === null) ? AnimazioneSfideWidgetIcon::className() : $child_of);
        $this->setCreateNewBtnLabel($hideCreateNewBtn);
        $this->setUpLayout('list');
        if ($setCurrentDashboard) {
            $this->view->params['currentDashboard'] = $this->getCurrentDashboard();
        }
        $this->setSessionBeginCreateLink();
    }

    /**
     * This method returns the close url for close button in action view.
     * @return string
     */
    public function getViewCloseUrl()
    {
        return Yii::$app->session->get(Module::beginCreateNewSessionKeyPartnershipProfiles());
    }


    /**
     * @param string|null $currentView
     * @return string
     */
    public function actionToPublish($currentView = null)
    {
        $this->setDataProvider($this->getModelSearch()->search(Yii::$app->request->getQueryParams()));
        return $this->baseListsAction('Da pubblicare', $currentView);
    }

    /**
     * @param string|null $currentView
     * @return string
     */
    public function actionPublished($currentView = null)
    {
        $this->setDataProvider($this->getModelSearch()->search(Yii::$app->request->getQueryParams()));
        return $this->baseListsAction('Pubblicate', $currentView);
    }

    /**
     * @param $pageTitle
     * @param null $currentView
     * @param bool $setCurrentDashboard
     * @param bool $hideCreateNewBtn
     * @param null $child_of
     * @return string
     */
    protected function baseListsAction($pageTitle, $currentView = null, $setCurrentDashboard = true, $hideCreateNewBtn = false, $child_of = null)
    {
        Url::remember();
        if (empty($currentView)) {
            $currentView = 'list';
        }
        $this->setTitleAndBreadcrumbs($pageTitle);
        $this->setListViewsParams($setCurrentDashboard, $hideCreateNewBtn, $child_of);
        $this->setCurrentView($this->getAvailableView($currentView));
        return $this->render('index', [
            'dataProvider' => $this->getDataProvider(),
            'model' => $this->getModelSearch(),
            'currentView' => $this->getCurrentView(),
            'availableViews' => $this->getAvailableViews(),
            'url' => ($this->url) ? $this->url : null,
            'parametro' => ($this->parametro) ? $this->parametro : null
        ]);
    }

}
