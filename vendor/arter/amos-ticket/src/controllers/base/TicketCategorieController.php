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
 * @package    arter\amos\ticket\controllers\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\ticket\controllers\base;

use arter\amos\community\models\Community;
use arter\amos\core\controllers\CrudController;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\cwh\AmosCwh;
use arter\amos\dashboard\controllers\TabDashboardControllerTrait;
use arter\amos\ticket\AmosTicket;
use arter\amos\ticket\models\base\UserProfileForm;
use arter\amos\ticket\models\search\TicketCategorieSearch;
use arter\amos\ticket\models\TicketCategorie;
use arter\amos\ticket\models\TicketCategorieUsersMm;
use Yii;
use yii\helpers\Url;

/**
 * Class TicketCategorieController
 * TicketCategorieController implements the CRUD actions for TicketCategorie model.
 *
 * @property \arter\amos\ticket\models\TicketCategorie $model
 * @property \arter\amos\ticket\models\search\TicketCategorieSearch $modelSearch
 *
 * @package arter\amos\ticket\controllers\base
 */
class TicketCategorieController extends CrudController
{
    public $model_referenti;
    public $referenti;

    /**
     * Trait used for initialize the ticket dashboard
     */
    use TabDashboardControllerTrait;

    /**
     * @var string $layout
     */
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->initDashboardTrait();

        $this->setModelObj(new TicketCategorie());
        $this->setModelSearch(new TicketCategorieSearch());

        $this->setAvailableViews([
            'grid' => [
                'name' => 'grid',
                'label' => AmosIcons::show('view-list-alt') . Html::tag('p', AmosTicket::tHtml('amoscore', 'Table')),
                'url' => '?currentView=grid'
            ],
        ]);

        parent::init();

        $this->setUpLayout();
    }

    /**
     * Lists all TicketCategorie models.
     * @param string|null $layout
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionIndex($layout = null)
    {
        Url::remember();
        Yii::$app->view->params['createNewBtnParams'] = [
            'createNewBtnLabel' => AmosTicket::t('amosticket', '#new_category')
        ];
        $this->view->params['currentDashboard'] = $this->getCurrentDashboard();
        $this->setDataProvider($this->getModelSearch()->search(Yii::$app->request->getQueryParams()));
        return parent::actionIndex();
    }

    /**
     * Displays a single TicketCategorie model.
     * @param integer $id
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
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
     * Creates a new TicketCategorie model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionCreate()
    {
        $this->setUpLayout('form');

        $this->model = new TicketCategorie();

        //carico i referenti ottenendo le variabili $this->model_referenti e $this->referenti popolate
        $this->loadReferenti($id = null);

        // If scope set, show checkbox in form to enable user to create a category linked to a community
        $communityId = null;
        $community = null;
        $moduleCwh = \Yii::$app->getModule('cwh');
        if (!is_null($moduleCwh)) {
            /** @var AmosCwh $moduleCwh */
            $scope = $moduleCwh->getCwhScope();
            if (!empty($scope) && isset($scope['community'])) {
                $communityId = $scope['community'];
                $this->model->abilita_per_community = true;
            }
        }
        $community = Community::findOne($communityId);
        $this->model->community_id = $communityId;

        if ($this->model->load(Yii::$app->request->post())) {
            //creo una transazione in modo che se non salvasse correttamente i referenti, non si creerebbe un record categoria
            $transaction = \Yii::$app->db->beginTransaction();

            if ($this->model->validate()) {

                if ($this->model->save()) {
                    $this->model_referenti->ticket_categoria_id = $this->model->id;
                    //aggiorno i referenti della categoria con quelli in post
                    $this->setReferenti(Yii::$app->request->post()[$this->model_referenti->getModelName()]['ids']);


                    if (!$this->model->validateReferenti($this->model_referenti->ids)) {
                        $transaction->rollBack();

                        Yii::$app->getSession()->addFlash('danger', AmosTicket::t('amosticket', 'Modifiche non salvate. Verifica l\'inserimento dei campi'));
                        return $this->render('create', [
                            'model' => $this->model,
                            'model_referenti' => $this->model_referenti,
                            'referenti' => $this->referenti,
                            'community' => $community,
                        ]);
                    } else {
                        //salvo i referenti
                        $saved_referenti = $this->model_referenti->saveUser2TicketCategoria();
                        if ($saved_referenti) {
                            $transaction->commit();

                            Yii::$app->getSession()->addFlash('success', AmosTicket::t('amosticket', 'Categoria salvata con successo.'));
                            //return $this->redirect(['/ticket/ticket-categorie/update', 'id' => $this->model->id]);
                            return $this->redirect(['index']);
                        } else {
                            $transaction->rollBack();

                            Yii::$app->getSession()->addFlash('danger', AmosTicket::t('amosticket', 'Category not created, check referents'));
                            return $this->render('create', [
                                'model' => $this->model,
                                'model_referenti' => $this->model_referenti,
                                'referenti' => $this->referenti,
                                'community' => $community,
                            ]);
                        }
                    }
                } else {
                    $transaction->rollBack();
                    Yii::$app->getSession()->addFlash('danger', AmosTicket::t('amosticket', 'Si &egrave; verificato un errore durante il salvataggio'));
                }
            } else {
                Yii::$app->getSession()->addFlash('danger', AmosTicket::t('amosticket', 'Modifiche non salvate. Verifica l\'inserimento dei campi'));
            }
        }

        return $this->render('create', [
            'model' => $this->model,
            'model_referenti' => $this->model_referenti,
            'referenti' => $this->referenti,
            'community' => $community,
        ]);
    }

    /**
     * Updates an existing TicketCategorie model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $this->setUpLayout('form');

        $this->model = $this->findModel($id);

        //carico i referenti ottenendo le variabili $this->model_referenti e $this->referenti popolate
        $this->loadReferenti($id);

        $community = null;
        if (!empty($this->model->community_id)) {
            $community = Community::findOne(['id' => $this->model->community_id]);
        }

        if ($this->model->load(Yii::$app->request->post())) {
            if ($this->model->validate()) {
                //aggiorno i referenti della conferenza con quelli in post
                $this->setReferenti(Yii::$app->request->post()[$this->model_referenti->getModelName()]['ids']);
                if (!$this->model->validateReferenti($this->model_referenti->ids)) {
                    Yii::$app->getSession()->addFlash('danger', AmosTicket::t('amosticket', 'Si &egrave; verificato un errore durante il salvataggio'));
                } else {
                    if ($this->model->save()) {
                        //salvo i referenti 
                        $saved_referenti = $this->model_referenti->saveUser2TicketCategoria();

                        Yii::$app->getSession()->addFlash('success', AmosTicket::t('amosticket', 'Categoria aggiornata con successo.'));
                        return $this->redirect(['/ticket/ticket-categorie/update', 'id' => $this->model->id]);
                    } else {
                        Yii::$app->getSession()->addFlash('danger', AmosTicket::t('amosticket', 'Si &egrave; verificato un errore durante il salvataggio'));
                    }
                }
            } else {
                Yii::$app->getSession()->addFlash('danger', AmosTicket::t('amosticket', 'Modifiche non salvate. Verifica l\'inserimento dei campi'));
            }
        }

        return $this->render('update', [
            'model' => $this->model,
            'model_referenti' => $this->model_referenti,
            'referenti' => $this->referenti,
            'community' => $community,
        ]);
    }

    /**
     * Deletes an existing TicketCategorie model.
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
                //cancello tutti i referenti eventualmente presenti
                TicketCategorieUsersMm::deleteAll(['ticket_categoria_id' => $id]);
                Yii::$app->getSession()->addFlash('success', AmosTicket::t('amosticket', 'Ticket category successfully deleted'));
            } else {
                Yii::$app->getSession()->addFlash('danger', AmosTicket::t('amosticket', 'You are not authorized to delete this news category'));
            }
        } else {
            Yii::$app->getSession()->addFlash('danger', AmosTicket::t('amosticket', 'Category not found'));
        }
        return $this->redirect(['index']);
    }

    /**
     * @param int $ticket_categoria_id
     */
    public function loadReferenti($ticket_categoria_id)
    {
        $this->model_referenti = new UserProfileForm();
        $this->model_referenti->ticket_categoria_id = $ticket_categoria_id;

        //carica i referenti (da DB) per la categoria settata: popola $this->ids
        $this->model_referenti->loadUsers();

        $this->referenti = UserProfileForm::getAvailableUsers();
    }

    /**
     * Setta gli id degli user_profile ricevuti
     * @param array $ids
     */
    public function setReferenti($ids)
    {
        if (!$this->model_referenti) {
            $this->model_referenti = new UserProfileForm();
        }
        $this->model_referenti->ids = $ids;
    }
}
