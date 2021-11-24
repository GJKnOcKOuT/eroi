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
 * @package    arter\amos\slideshow\controllers\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\slideshow\controllers\base;

use arter\amos\core\controllers\CrudController;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\slideshow\AmosSlideshow;
use arter\amos\slideshow\models\search\SlideshowSearch;
use arter\amos\slideshow\models\Slideshow;
use arter\amos\slideshow\models\SlideshowRoute;
use arter\amos\slideshow\models\SlideshowUserflag;
use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * Class SlideshowController
 *
 * SlideshowController implements the CRUD actions for Slideshow model.
 *
 * @property \arter\amos\slideshow\models\Slideshow $model
 *
 * @package arter\amos\slideshow\controllers\base
 */
class SlideshowController extends CrudController
{
    /**
     * @var string $layout
     */
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setModelObj(new Slideshow());
        $this->setModelSearch(new SlideshowSearch());

        $this->setAvailableViews([
            'grid' => [
                'name' => 'grid',
                'label' => AmosSlideshow::t('amosslideshow',
                    '{iconaTabella}' . Html::tag('p', AmosSlideshow::t('amosslideshow', 'Tabella')), [
                        'iconaTabella' => AmosIcons::show('view-list-alt')
                    ]),
                'url' => '?currentView=grid'
            ],
            /*'list' => [
                'name' => 'list',
                'label' => AmosSlideshow::t('amosslideshow', '{iconaLista}' . Html::tag('p', AmosSlideshow::t('amosslideshow', 'Lista')), [
                    'iconaLista' => AmosIcons::show('view-list')
                ]),
                'url' => '?currentView=list'
            ],
            'icon' => [
                'name' => 'icon',
                'label' => AmosSlideshow::t('amosslideshow', '{iconaElenco}' . Html::tag('p', AmosSlideshow::t('amosslideshow', 'Icone')), [
                    'iconaElenco' => AmosIcons::show('grid')
                ]),
                'url' => '?currentView=icon'
            ],*/
        ]);

        parent::init();

        $this->setUpLayout();
    }

    /**
     * Lists all Slideshow models.
     * @param null|string $layout
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex($layout = null)
    {
        Url::remember();
        $this->setDataProvider($this->getModelSearch()->search(Yii::$app->request->getQueryParams()));
        return parent::actionIndex();
    }

    /**
     * Displays a single Slideshow model.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $this->model = $this->findModel($id);

        if ($this->model->load(Yii::$app->request->post()) && $this->model->save()) {
            return $this->redirect(['view', 'id' => $this->model->id]);
        } else {
            return $this->render('view', ['model' => $this->model]);
        }
    }

    /**
     * Creates a new Slideshow model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->setUpLayout('form');

        $this->model = new Slideshow();
        $route = new SlideshowRoute();

        if ($this->model->load(Yii::$app->request->post()) && $route->load(Yii::$app->request->post()) && $this->model->validate() && $route->validate()) {
            if ($this->model->save()) {
                $route->slideshow_id = $this->model->id;
                $route->save();
                Yii::$app->getSession()->addFlash('success',
                    AmosSlideshow::tHtml('amosslideshow', 'Elemento creato correttamente.'));
                return $this->redirect(['index']);
            } else {
                Yii::$app->getSession()->addFlash('danger',
                    AmosSlideshow::tHtml('amosslideshow', 'Elemento non creato, verificare i dati inseriti.'));
                return $this->render('create', [
                    'model' => $this->model,
                    'route' => $route
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $this->model,
                'route' => $route
            ]);
        }
    }

    /**
     * Updates an existing Slideshow model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $this->setUpLayout('form');

        $this->model = $this->findModel($id);
        $route = SlideshowRoute::findOne(['slideshow_id' => $id]);
        if (!$route) {
            $route = new SlideshowRoute();
            $route->slideshow_id = $id;
        }

        if ($this->model->load(Yii::$app->request->post()) && $route->load(Yii::$app->request->post()) && $this->model->validate() && $route->validate()) {
            if ($this->model->save()) {

                $slideshowRoute = SlideshowRoute::findAll(['slideshow_id' => $id]);
                if (!empty($slideshowRoute)) {
                    foreach ($slideshowRoute as $key => $value) {
                        SlideshowUserflag::deleteAll(['slideshow_route_id' => $value->id]);
                    }
                    SlideshowRoute::deleteAll(['slideshow_id' => $id]);
                }
                $route = new SlideshowRoute();
                $route->load(Yii::$app->request->post());
                $route->slideshow_id = $id;
                $route->save(false);
                Yii::$app->getSession()->addFlash('success',
                    AmosSlideshow::tHtml('amosslideshow', 'Elemento aggiornato correttamente.'));
                return $this->redirect(['index']);
            } else {
                Yii::$app->getSession()->addFlash('danger',
                    AmosSlideshow::tHtml('amosslideshow', 'Elemento non aggiornato, verificare i dati inseriti.'));
                return $this->render('update', [
                    'model' => $this->model,
                    'route' => $route
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $this->model,
                'route' => $route
            ]);
        }
    }

    /**
     * Deletes an existing Slideshow model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Exception
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->model = $this->findModel($id);
        if ($this->model) {
            if ($this->model->getSlideshowPages()->count()) {
                Yii::$app->getSession()->addFlash('danger', AmosSlideshow::tHtml('amosslideshow', 'Elemento non cancellato per la presenza di pagine.'));
            } else {
                $route = $this->model->slideshowRoutes;
                if(!is_null($route)){
                    $route->delete();
                }
                $this->model->delete();
                if (!$this->model->hasErrors()) {
                    Yii::$app->getSession()->addFlash('success', AmosSlideshow::tHtml('amosslideshow', 'Elemento cancellato correttamente.'));
                } else {
                    Yii::$app->getSession()->addFlash('danger', AmosSlideshow::t('amosslideshow', 'Non sei autorizzato a cancellare questo elemento'));
                }
            }
        } else {
            Yii::$app->getSession()->addFlash('danger', AmosSlideshow::tHtml('amosslideshow', 'Elemento non trovato.'));
        }
        return $this->redirect(['index']);
    }
}
