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

use arter\amos\core\controllers\CrudController;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\dashboard\controllers\TabDashboardControllerTrait;
use arter\amos\faq\AmosFaq;
use arter\amos\faq\models\Faq;
use arter\amos\faq\models\FaqAmosWidgetMm;
use arter\amos\faq\models\FaqSearch;
use Yii;
use yii\helpers\Url;
use arter\amos\faq\assets\AmosFaqAsset;

/**
 * Class FaqController
 * FaqController implements the CRUD actions for Faq model.
 * @package arter\amos\faq\controllers
 */
class FaqController extends CrudController
{
    /**
     * Trait used for initialize the tab dashboard
     */
    use TabDashboardControllerTrait;

    /**
     * @var string $layout
     */
    public $layout = 'list';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->initDashboardTrait();

        $this->setModelObj(new Faq());
        $this->setModelSearch(new FaqSearch());
AmosFaqAsset::register(Yii::$app->view);
        $this->setAvailableViews([
            /* 'map' => [
              'name' => 'map',
              'label' => AmosFaq::t('amosfaq', '{iconaMappa}'.Html::tag('p',AmosFaq::t('amosfaq', 'Mappa')), [
              'iconaMappa' => AmosIcons::show('map-alt')
              ]),
              'url' => '?currentView=map'
              ], */
//            'grid' => [
//                'name' => 'grid',
//                'label' => AmosFaq::t('amosfaq', '{iconaTabella}'.Html::tag('p',AmosFaq::t('amosfaq', 'Tabella')), [
//                    'iconaTabella' => AmosIcons::show('view-list-alt')
//                ]),
//                'url' => '?currentView=grid'
//            ],
            'list' => [
                'name' => 'list',
                'label' => AmosFaq::t('amosfaq', '{iconaLista}' . Html::tag('p', AmosFaq::t('amosfaq', 'Lista')), [
                    'iconaLista' => AmosIcons::show('view-list')
                ]),
                'url' => '?currentView=list'
            ],
        ]);

        parent::init();
        $this->setUpLayout();
    }

    /**
     * Lists all Faq models.
     * @return mixed
     */
    public function actionIndex($layout = NULL)
    {
        Url::remember();

        $this->setUpLayout('list');
        $this->setDataProvider($this->getModelSearch()->search(Yii::$app->request->getQueryParams()));
        $this->setCreateNewBtnLabel();
        $this->view->params['currentDashboard'] = $this->getCurrentDashboard();
        return parent::actionIndex();
    }

    /**
     * Displays a single Faq model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', ['model' => $model]);
        }
    }

    /**
     * Set a view param used in \arter\amos\core\forms\CreateNewButtonWidget
     */
    private function setCreateNewBtnLabel()
    {
        Yii::$app->view->params['createNewBtnParams'] = [
            'createNewBtnLabel' => AmosFaq::t('amosfaq', 'Aggiungi nuova FAQ')
        ];
    }

    /**
     * Creates a new Faq model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->setUpLayout('form');
        $model = new Faq;
        $model->listaWidget = null;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                if (Yii::$app->request->post()['Faq'] && Yii::$app->request->post()['Faq']['listaWidget']) {
                    $model->listaWidget[] = Yii::$app->request->post()['Faq']['listaWidget'];
                    if (!empty(Yii::$app->request->post()['Faq']['listaWidget'])) {
                        foreach (Yii::$app->request->post()['Faq']['listaWidget'] as $widgetName) {
                            $faqAmosWidgetMm = new FaqAmosWidgetMm();
                            $faqAmosWidgetMm->faq_id = $model->id;
                            $faqAmosWidgetMm->amos_widgets_classname = $widgetName;
                            $faqAmosWidgetMm->save();
                        }
                    }
                }

                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Faq model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $this->setUpLayout('form');
        $model = $this->findModel($id);
        $model->listaWidget = null;
        //foreach (FaqAmosWidgetMm::find(['faq_id' => $model->id])->asArray()->all() as $widget){
        foreach ($model->amosWidgets as $widget) {
            $model->listaWidget[] = $widget['classname'];
        }

        if ($model->load(Yii::$app->request->post())) {
            FaqAmosWidgetMm::deleteAll(['faq_id' => $model->id]);
            //aggiungo la lista dei widget
            if (isset(Yii::$app->request->post()['Faq']) && isset(Yii::$app->request->post()['Faq']['listaWidget'])) {
                $model->listaWidget[] = Yii::$app->request->post()['Faq']['listaWidget'];
                if (Yii::$app->request->post()['Faq']['listaWidget']) {
                    foreach (Yii::$app->request->post()['Faq']['listaWidget'] as $widgetName) {
                        $faqAmosWidgetMm = new FaqAmosWidgetMm();
                        $faqAmosWidgetMm->faq_id = $model->id;
                        $faqAmosWidgetMm->amos_widgets_classname = $widgetName;
                        $faqAmosWidgetMm->save();
                    }
                }

            }

            if ($model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                //'listaWidget' => $listaWidget
            ]);
        }
    }

    /**
     * Deletes an existing Faq model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
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
