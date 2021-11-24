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
 * @package    arter\amos\een\base
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\een\controllers\base;

use arter\amos\core\controllers\CrudController;
use arter\amos\core\helpers\Html;
use arter\amos\core\helpers\T;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\een\models\EenTagS3TagEenMm;
use arter\amos\een\models\search\EenTagS3TagEenMmSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * Class EenTagS3TagEenMmController
 * EenTagS3TagEenMmController implements the CRUD actions for EenTagS3TagEenMm model.
 *
 * @property \arter\amos\een\models\EenTagS3TagEenMm $model
 * @property \arter\amos\een\models\search\EenTagS3TagEenMmSearch $modelSearch
 *
 * @package arter\amos\een\base
 */
class EenTagS3TagEenMmController extends CrudController
{
    /**
     * @var string $layout
     */
    public $layout = 'main';

    public function init()
    {
        $this->setModelObj(new EenTagS3TagEenMm());
        $this->setModelSearch(new EenTagS3TagEenMmSearch());

        $this->setAvailableViews([
            'grid' => [
                'name' => 'grid',
                'label' => AmosIcons::show('view-list-alt').Html::tag('p', BaseAmosModule::tHtml('amoscore', 'Table')),
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
              'intestazione' => '', //codice HTML per l'intestazione che verrà caricato prima del calendario,
              //per esempio si può inserire una funzione $model->getHtmlIntestazione() creata ad hoc
              'label' => AmosIcons::show('calendar') . Html::tag('p', BaseAmosModule::tHtml('amoscore', 'Calendari')),
              'url' => '?currentView=calendar'
              ], */
        ]);

        parent::init();
        $this->setUpLayout();
    }

    /**
     * Lists all EenTagS3TagEenMm models.
     * @return mixed
     */
    public function actionIndex($layout = NULL)
    {
        Url::remember();
        $this->setDataProvider($this->modelSearch->search(Yii::$app->request->getQueryParams()));
        return parent::actionIndex($layout);
    }

    /**
     * Displays a single EenTagS3TagEenMm model.
     * @param integer $id
     * @return mixed
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
     * Creates a new EenTagS3TagEenMm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tagEen = null, $url = null)
    {
        $this->setUpLayout('form');
        $this->model = new EenTagS3TagEenMm();
        if (!empty($tagEen)) {
            $this->model->een_tag_een_id = $tagEen;
        }

        if ($this->model->load(Yii::$app->request->post()) && $this->model->validate()) {
//
            foreach ((Array)$this->model->tagsS3 as $tag_s3) {
                $tags3mm = new EenTagS3TagEenMm();
                $tags3mm->een_tag_een_id = $this->model->een_tag_een_id;
                $tags3mm->tag_s3_id = $tag_s3;
                $tags3mm->description = $this->model->description;

                $tags3mm->save(false);
            }
                Yii::$app->getSession()->addFlash('success', Yii::t('amoscore', 'Item created'));
                if(!empty($url)){
                    return $this->redirect([$url]);
                }
                return $this->redirect(['index']);

           
        }

        return $this->render('create',
                [
                'model' => $this->model,
                'fid' => NULL,
                'dataField' => NULL,
                'dataEntity' => NULL,
        ]);
    }

    /**
     * Creates a new EenTagS3TagEenMm model by ajax request.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateAjax($fid, $dataField)
    {
        $this->setUpLayout('form');
        $this->model = new EenTagS3TagEenMm();

        if (\Yii::$app->request->isAjax && $this->model->load(Yii::$app->request->post()) && $this->model->validate()) {
            if ($this->model->save()) {
//Yii::$app->getSession()->addFlash('success', Yii::t('amoscore', 'Item created'));
                return json_encode($this->model->toArray());
            } else {
//Yii::$app->getSession()->addFlash('danger', Yii::t('amoscore', 'Item not created, check data'));
            }
        }

        return $this->renderAjax('_formAjax',
                [
                'model' => $this->model,
                'fid' => $fid,
                'dataField' => $dataField
        ]);
    }

    /**
     * Updates an existing EenTagS3TagEenMm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $url = null)
    {
        $this->setUpLayout('form');
        $this->model = $this->findModel($id);
        foreach ((Array)$this->model->getTagsS3s()->all() as $eentags3een) {
            $this->model->tagsS3[] = $eentags3een->tag_s3_id;
        }

        if ($this->model->load(Yii::$app->request->post()) && $this->model->validate()) {
            //delete all
            EenTagS3TagEenMm::deleteAll(['een_tag_een_id' => $this->model->een_tag_een_id]);
            foreach ((Array)$this->model->tagsS3 as $tag_s3) {
                $tags3mm = new EenTagS3TagEenMm();
                $tags3mm->een_tag_een_id = $this->model->een_tag_een_id;
                $tags3mm->tag_s3_id = $tag_s3;
                $tags3mm->description = $this->model->description;
                $tags3mm->save(false);
            }
            Yii::$app->getSession()->addFlash('success', Yii::t('amoscore', 'Item created'));
            if(!empty($url)){
                return $this->redirect([$url]);
            }
            return $this->redirect(['index']);
        }

        return $this->render('update',
                [
                'model' => $this->model,
                'fid' => NULL,
                'dataField' => NULL,
                'dataEntity' => NULL,
                'onUpdate' => true
        ]);
    }

    /**
     * Deletes an existing EenTagS3TagEenMm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->model = $this->findModel($id);
        if ($this->model) {
            $this->model->delete();
            if (!$this->model->hasErrors()) {
                Yii::$app->getSession()->addFlash('success',
                    BaseAmosModule::t('amoscore', 'Element deleted successfully.'));
            } else {
                Yii::$app->getSession()->addFlash('danger',
                    BaseAmosModule::t('amoscore', 'You are not authorized to delete this element.'));
            }
        } else {
            Yii::$app->getSession()->addFlash('danger', BaseAmosModule::tHtml('amoscore', 'Element not found.'));
        }
        return $this->redirect(['index']);
    }
}