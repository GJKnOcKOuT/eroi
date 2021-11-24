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
 * @package    arter\amos\documenti\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\documenti\controllers;

use arter\amos\core\controllers\CrudController;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\dashboard\controllers\TabDashboardControllerTrait;
use arter\amos\documenti\AmosDocumenti;
use arter\amos\documenti\models\DocumentiCategoryCommunityMm;
use arter\amos\documenti\models\DocumentiCategoryRolesMm;
use Yii;
use yii\helpers\Url;

/**
 * Class DocumentiCategorieController
 * DocumentiCategorieController implements the CRUD actions for DocumentiCategorie model.
 *
 * @property \arter\amos\documenti\models\DocumentiCategorie $model
 * @property \arter\amos\documenti\models\search\DocumentiCategorieSearch $modelSearch
 *
 * @package arter\amos\documenti\controllers
 */
class DocumentiCategorieController extends CrudController
{
    /**
     * Trait used for initialize the news dashboard
     */
    use TabDashboardControllerTrait;

    /**
     * @var string $layout
     */
    public $layout = 'main';

    /**
     * @var AmosDocumenti $documentsModule
     */
    public $documentsModule = null;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->initDashboardTrait();

        $this->documentsModule = Yii::$app->getModule(AmosDocumenti::getModuleName());

        $this->setModelObj($this->documentsModule->createModel('DocumentiCategorie'));
        $this->setModelSearch($this->documentsModule->createModel('DocumentiCategorieSearch'));

        $this->setAvailableViews([
            'grid' => [
                'name' => 'grid',
                'label' => AmosIcons::show('view-list-alt') . Html::tag('p', AmosDocumenti::tHtml('amosdocumenti', 'Tabella')),
                'url' => '?currentView=grid'
            ],
        ]);

        parent::init();

        $this->setUpLayout();
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
     * Lists all DocumentiCategorie models.
     * @param string|null $layout
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionIndex($layout = NULL)
    {
        Url::remember();
        $this->setUpLayout('list');
        $this->view->params['currentDashboard'] = $this->getCurrentDashboard();
        $this->setTitleAndBreadcrumbs(AmosDocumenti::t('amosdocumenti', '#page_title_documents_categories'));
        $this->setDataProvider($this->modelSearch->search(Yii::$app->request->getQueryParams()));
        return parent::actionIndex();
    }

    /**
     * Displays a single DocumentiCategorie model.
     * @param integer $id
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionView($id)
    {
        $this->model = $this->findModel($id);
        return $this->render('view', ['model' => $this->model]);
    }

    /**
     * Creates a new DocumentiCategorie model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->setUpLayout('form');

        $this->model = $this->documentsModule->createModel('DocumentiCategorie');

        if ($this->model->load(Yii::$app->request->post())) {
            if ($this->model->validate()) {
                if ($this->model->save()) {
                    $this->model->saveDocumentiCategorieCommunityMm();
                    $this->model->saveDocumentiCategorieRolesMm();
                    Yii::$app->getSession()->addFlash('success', AmosDocumenti::tHtml('amosdocumenti', 'Categoria documenti salvata con successo.'));
                    return $this->redirect(['/documenti/documenti-categorie/update', 'id' => $this->model->id]);
                } else {
                    Yii::$app->getSession()->addFlash('danger', AmosDocumenti::tHtml('amosdocumenti', 'Si &egrave; verificato un errore durante il salvataggio'));
                }
            } else {
                Yii::$app->getSession()->addFlash('danger', AmosDocumenti::tHtml('amosdocumenti', 'Modifiche non salvate. Verifica l\'inserimento dei campi'));
            }
        }

        return $this->render('create', [
            'model' => $this->model,
        ]);
    }

    /**
     * Updates an existing DocumentiCategorie model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $this->setUpLayout('form');

        $this->model = $this->findModel($id);
        $this->model->loadDocumentiCategoryCommunities();
        $this->model->loadDocumentiCategoryRoles();

        if ($this->model->load(Yii::$app->request->post())) {
            if ($this->model->validate()) {
                if ($this->model->save()) {
                    $this->model->saveDocumentiCategorieCommunityMm();
                    $this->model->saveDocumentiCategorieRolesMm();
                    Yii::$app->getSession()->addFlash('success', AmosDocumenti::tHtml('amosdocumenti', 'Categoria documenti aggiornata con successo.'));
                    return $this->redirect(['/documenti/documenti-categorie/update', 'id' => $this->model->id]);
                } else {
                    Yii::$app->getSession()->addFlash('danger', AmosDocumenti::tHtml('amosdocumenti', 'Si &egrave; verificato un errore durante il salvataggio'));
                }
            } else {
                Yii::$app->getSession()->addFlash('danger', AmosDocumenti::tHtml('amosdocumenti', 'Modifiche non salvate. Verifica l\'inserimento dei campi'));
            }
        }

        return $this->render('update', [
            'model' => $this->model,
        ]);
    }

    /**
     * Deletes an existing DocumentiCategorie model.
     * If deletion is successful, the browser will be redirected to the previous list page.
     * @param int $id
     * @return \yii\web\Response
     * @throws \Exception
     * @throws \yii\db\StaleObjectException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->model = $this->findModel($id);
        if ($this->model) {
            if ($this->model->getDocumenti()->count() == 0) {
                /** @var DocumentiCategoryCommunityMm $documentiCategoryCommunityMmModel */
                $documentiCategoryCommunityMmModel = $this->documentsModule->createModel('DocumentiCategoryCommunityMm');
                $documentiCategoryCommunityMmModel::deleteAll(['documenti_categorie_id' => $this->id]);
                /** @var DocumentiCategoryRolesMm $documentiCategoryRolesMmModel */
                $documentiCategoryRolesMmModel = $this->documentsModule->createModel('DocumentiCategoryRolesMm');
                $documentiCategoryRolesMmModel::deleteAll(['documenti_categorie_id' => $this->id]);
                $this->model->delete();

                if (!$this->model->hasErrors()) {
                    Yii::$app->getSession()->addFlash('success', AmosDocumenti::t('amosdocumenti', 'Elemento cancellato correttamente.'));
                } else {
                    Yii::$app->getSession()->addFlash('danger', AmosDocumenti::t('amosdocumenti', 'Non sei autorizzato a cancellare questo elemento.'));
                }
            } else {
                Yii::$app->getSession()->addFlash('danger', AmosDocumenti::t('amosdocumenti', 'Non è possibile cancellare la categoria perché associata ad almeno un documento.'));
            }
        } else {
            Yii::$app->getSession()->addFlash('danger', AmosDocumenti::tHtml('amosdocumenti', 'Elemento non trovato.'));
        }
        return $this->redirect(['/documenti/documenti-categorie/index']);
    }
}
