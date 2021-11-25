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
 * @package    arter\amos\best\practice\controllers\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\best\practice\controllers\base;

use arter\amos\best\practice\models\BestPractice;
use arter\amos\best\practice\models\search\BestPracticeSearch;
use arter\amos\best\practice\Module;
use arter\amos\core\controllers\CrudController;
use arter\amos\core\helpers\BreadcrumbHelper;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\dashboard\controllers\TabDashboardControllerTrait;
use Yii;
use yii\helpers\Url;

/**
 * Class BestPracticeController
 * BestPracticeController implements the CRUD actions for BestPractice model.
 *
 * @property \arter\amos\best\practice\models\BestPractice $model
 * @property \arter\amos\best\practice\models\search\BestPracticeSearch $modelSearch
 *
 * @package arter\amos\best\practice\controllers\base
 */
class BestPracticeController extends CrudController
{
    /**
     * Trait used for initialize the bestPractice dashboard
     */
    use TabDashboardControllerTrait;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setModelObj(new BestPractice());
        $this->setModelSearch(new BestPracticeSearch());

        $this->setAvailableViews([
            'list' => [
                'name' => 'list',
                'label' => AmosIcons::show('view-list') . Html::tag('p', Module::tHtml('amoscore', 'List')),
                'url' => '?currentView=list'
            ],
            'grid' => [
                'name' => 'grid',
                'label' => AmosIcons::show('view-list-alt') . Html::tag('p', Module::tHtml('amoscore', 'Table')),
                'url' => '?currentView=grid'
            ],
        ]);

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function actionIndex($layout = NULL)
    {
        return $this->redirect(['/bestpractice/best-practice/all']);
    }

    /**
     * Displays a single BestPractice model.
     * @param integer $id
     * @return mixed
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionView($id)
    {
        $this->model = $this->findModel($id);
        return $this->render('view', ['model' => $this->model]);
    }

    /**
     * Creates a new BestPractice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->setUpLayout('form');

        Yii::$app->view->params['textHelp']['filename'] = 'create_yours_stories-helper';

        $this->model = new BestPractice();
        if ($this->model->load(Yii::$app->request->post())) {
            if ($this->model->validate()) {
                $validateOnSave = true;
                if ($this->model->status == BestPractice::BESTPRACTICE_WORKFLOW_STATUS_TOVALIDATE) {
                    $this->model->status = BestPractice::BESTPRACTICE_WORKFLOW_STATUS_DRAFT;
                    if ($this->model->save()) {
                        $this->model->status = BestPractice::BESTPRACTICE_WORKFLOW_STATUS_TOVALIDATE;
                        $validateOnSave = false;
                    }
                }
                if ($this->model->status == BestPractice::BESTPRACTICE_WORKFLOW_STATUS_VALIDATED) {
                    $this->model->status = BestPractice::BESTPRACTICE_WORKFLOW_STATUS_DRAFT;
                    if ($this->model->save()) {
                        $this->model->status = BestPractice::BESTPRACTICE_WORKFLOW_STATUS_VALIDATED;
                        $validateOnSave = false;
                    }
                }
                if ($this->model->save($validateOnSave)) {
                    Yii::$app->getSession()->addFlash('success', Yii::t('amoscore', 'Item created'));
                    return $this->redirectOnCreate($this->model);
                } else {
                    Yii::$app->getSession()->addFlash('danger', Yii::t('amoscore', 'Item not created, check data'));
                }
            }
        }

        return $this->render('create', [
            'model' => $this->model,
        ]);
    }

    /**
     * Updates an existing BestPractice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->setUpLayout('form');
        Yii::$app->view->params['textHelp']['filename'] = 'create_yours_stories-helper';
        $this->model = $this->findModel($id);
        $previousStatus = $this->model->status;

        if ($this->model->load(Yii::$app->request->post()) && $this->model->validate()) {
            if ($this->model->status == BestPractice::BESTPRACTICE_WORKFLOW_STATUS_VALIDATED) {
                $this->model->validated_at_least_once = 1;
            }
            if ($this->model->save()) {
                Yii::$app->getSession()->addFlash('success', Yii::t('amoscore', 'Item updated'));
                return $this->redirectOnUpdate($this->model, $previousStatus);
            } else {
                Yii::$app->getSession()->addFlash('danger', Yii::t('amoscore', 'Item not updated, check data'));
            }
        }

        return $this->render('update', [
            'model' => $this->model,
        ]);
    }

    /**
     * Deletes an existing BestPractice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->model = $this->findModel($id);
        if ($this->model) {
            $this->model->delete();
            if (!$this->model->hasErrors()) {
                Yii::$app->getSession()->addFlash('success', Yii::t('amoscore', 'Item deleted'));
            } else {
                Yii::$app->getSession()->addFlash('danger', Yii::t('amoscore', 'Item not deleted because of dependency'));
            }
        } else {
            Yii::$app->getSession()->addFlash('danger', Yii::t('amoscore', 'Item not found'));
        }
        return $this->redirect(Yii::$app->session->get(Module::beginCreateNewSessionKey()));
    }

    /**
     * Used for set page title and breadcrumbs.
     * @param string $bestPracticePageTitle News page title (ie. Created by bestPractice, ...)
     */
    protected function setTitleAndBreadcrumbs($bestPracticePageTitle)
    {
        $this->setNetworkDashboardBreadcrumb();
        Yii::$app->session->set('previousTitle', $bestPracticePageTitle);
        Yii::$app->session->set('previousUrl', Url::previous());
        Yii::$app->view->title = $bestPracticePageTitle;
        Yii::$app->view->params['breadcrumbs'][] = ['label' => $bestPracticePageTitle];
    }

    public function setNetworkDashboardBreadcrumb()
    {
        /** @var \arter\amos\cwh\AmosCwh $moduleCwh */
        $moduleCwh = Yii::$app->getModule('cwh');
        $scope = NULL;
        if (!empty($moduleCwh)) {
            $scope = $moduleCwh->getCwhScope();
        }
        if (!empty($scope)) {
            if (isset($scope['community'])) {
                $communityId = $scope['community'];
                $community = \arter\amos\community\models\Community::findOne($communityId);
                $dashboardCommunityTitle = Module::t('amosbestpractice', "Dashboard") . ' ' . $community->name;
                $dasbboardCommunityUrl = Yii::$app->urlManager->createUrl(['community/join', 'id' => $communityId]);
                Yii::$app->view->params['breadcrumbs'][] = ['label' => $dashboardCommunityTitle, 'url' => $dasbboardCommunityUrl];
            }
        }
    }

    protected function setListViewsParams()
    {
        $this->setCreateNewBtnLabel();
        $this->setUpLayout('list');
        Yii::$app->session->set(Module::beginCreateNewSessionKey(), Url::previous());
        $this->view->params['currentDashboard'] = $this->getCurrentDashboard();
    }

    /**
     * Set a view param used in \arter\amos\core\forms\CreateNewButtonWidget
     */
    private function setCreateNewBtnLabel()
    {
        Yii::$app->view->params['createNewBtnParams'] = [
            'createNewBtnLabel' => Module::t('amosbestpractice', 'Add new best practice'),
            'urlCreateNew' => '/bestpractice/best-practice/create'
        ];
    }

    /**
     * Base operations for list views
     * @param string $pageTitle
     * @return string
     */
    protected function baseListsAction($pageTitle)
    {
        Url::remember();
        $this->setTitleAndBreadcrumbs($pageTitle);
        $this->setListViewsParams();
        Yii::$app->view->params['textHelp']['filename'] = 'yours_interest_stories-helper';
        $renderParams = [
            'dataProvider' => $this->getDataProvider(),
            'model' => $this->getModelSearch(),
            'currentView' => $this->getCurrentView(),
            'availableViews' => $this->getAvailableViews(),
            'url' => ($this->url) ? $this->url : null,
            'parametro' => ($this->parametro) ? $this->parametro : null
        ];
        return $this->render('index', $renderParams);
    }

    /**
     * @param BestPractice $model
     * @param string|null $previousStatus
     * @return \yii\web\Response
     */
    protected function redirectOnUpdate($model, $previousStatus = null)
    {
        // if you have the permission of update or you can validate the content you will be redirected on the update page
        // otherwise you will be redirected on the index page
        $redirectToUpdatePage = false;
        if (Yii::$app->getUser()->can('BESTPRACTICE_UPDATE', ['model' => $model])) {
            $redirectToUpdatePage = true;
        }
        $sessionUrl = Yii::$app->session->get(Module::beginCreateNewSessionKey());
        if ($redirectToUpdatePage) {
            if ($model->status == BestPractice::BESTPRACTICE_WORKFLOW_STATUS_VALIDATED) {
                return $this->redirect(BreadcrumbHelper::lastCrumbUrl());
            } elseif (($model->status == BestPractice::BESTPRACTICE_WORKFLOW_STATUS_DRAFT) && ($previousStatus == BestPractice::BESTPRACTICE_WORKFLOW_STATUS_TOVALIDATE)) {
                return $this->redirect(BreadcrumbHelper::lastCrumbUrl());
            } else {
                return $this->redirect(['/bestpractice/best-practice/update', 'id' => $model->id]);
            }
        } elseif (!is_null($sessionUrl)) {
            return $this->redirect($sessionUrl);
        } else {
            return $this->redirect('/bestpractice/best-practice/own-interest');
        }
    }

    /**
     * @param BestPractice $model
     * @return \yii\web\Response
     */
    protected function redirectOnCreate($model)
    {
        // if you have the permission of update or you can validate the content you will be redirected on the update page
        // otherwise you will be redirected on the index page with the contents created by you
        $redirectToUpdatePage = false;

        if (Yii::$app->getUser()->can('BESTPRACTICE_UPDATE', ['model' => $model])) {
            $redirectToUpdatePage = true;
        }

        if (Yii::$app->getUser()->can('BestPracticeValidate', ['model' => $model])) {
            $redirectToUpdatePage = true;
        }

        $sessionUrl = Yii::$app->session->get(Module::beginCreateNewSessionKey());
        if ($redirectToUpdatePage) {
            return $this->redirect(['/bestpractice/best-practice/update', 'id' => $model->id]);
        } elseif (!is_null($sessionUrl)) {
            return $this->redirect($sessionUrl);
        } else {
            return $this->redirect('/bestpractice/best-practice/own-interest');
        }
    }
}
