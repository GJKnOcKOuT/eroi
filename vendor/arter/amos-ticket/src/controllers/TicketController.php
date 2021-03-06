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
 * @package    arter\amos\ticket\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\ticket\controllers;

use arter\amos\core\exceptions\AmosException;
use arter\amos\ticket\AmosTicket;
use arter\amos\ticket\assets\TicketAsset;
use arter\amos\ticket\models\search\TicketSearch;
use arter\amos\ticket\models\Ticket;
use arter\amos\ticket\models\TicketCategorie;
use raoul2000\workflow\base\WorkflowException;
use Yii;
use yii\db\Expression;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Class TicketController
 * This is the class for controller "TicketController".
 * @package arter\amos\ticket\controllers
 */
class TicketController extends \arter\amos\ticket\controllers\base\TicketController
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        TicketAsset::register($this->getView());
        parent::init();
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
                            'index',
                            'ticket-waiting',
                            'ticket-processing',
                            'ticket-closed',
                            'closing-ticket',
                            'change-category-ticket',
                            'extract-tickets'
                        ],
                        'roles' => ['OPERATORE_TICKET']
                    ],
                    [
                        'allow' => true,
                        'actions' => [
                            'extract-tickets'
                        ],
                        'roles' => ['TICKET_EXPORT']
                    ],
                ]
            ],
        ]);
        return $behaviors;
    }

    /**
     * Lists all Ticket models.
     * @param string|null $layout
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionIndex($layout = null)
    {
        $this->view->params['hideCreatedBy'] = !Yii::$app->getUser()->can('AMMINISTRATORE_TICKET') && !Yii::$app->getUser()->can('REFERENTE_TICKET');
        $modelSearch = $this->getModelSearch();
        $modelSearch->status = null;
        $this->setDataProvider($modelSearch->searchAllTicket(Yii::$app->request->getQueryParams()));
        $this->setCreateNewBtnParams();
        return $this->baseListsAction(AmosTicket::t('amosticket', 'Tutti i ticket'), true);
    }

    /**
     * Action to search to waiting ticket
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionTicketWaiting()
    {
        $this->view->params['hideColumns'] = ['closed_at', 'closed_by', 'status'];
        $this->view->params['hideStatus'] = true;
        $this->view->params['hideCreatedBy'] = !Yii::$app->getUser()->can('AMMINISTRATORE_TICKET') && !Yii::$app->getUser()->can('REFERENTE_TICKET');
        $this->setDataProvider($this->getModelSearch()->searchTicketWaiting(Yii::$app->request->getQueryParams()));
        return $this->baseListsAction(AmosTicket::t('amosticket', 'Ticket in attesa'), true);
    }

    /**
     * Action to search to processing ticket
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionTicketProcessing()
    {
        $this->view->params['hideColumns'] = ['closed_at', 'closed_by', 'status'];
        $this->view->params['hideStatus'] = true;
        $this->view->params['hideCreatedBy'] = !Yii::$app->getUser()->can('AMMINISTRATORE_TICKET') && !Yii::$app->getUser()->can('REFERENTE_TICKET');
        $this->setDataProvider($this->getModelSearch()->searchTicketProcessing(Yii::$app->request->getQueryParams()));
        return $this->baseListsAction(AmosTicket::t('amosticket', 'Ticket in lavorazione'), true);
    }

    /**
     * Action to search to waiting ticket
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionTicketClosed()
    {
        $this->view->params['hideColumns'] = ['status'];
        $this->view->params['hideStatus'] = true;
        $this->view->params['currentDashboard'] = $this->getCurrentDashboard();
        $this->view->params['hideCreatedBy'] = !Yii::$app->getUser()->can('AMMINISTRATORE_TICKET') && !Yii::$app->getUser()->can('REFERENTE_TICKET');
        $this->setDataProvider($this->getModelSearch()->searchTicketClosed(Yii::$app->request->getQueryParams()));
        return $this->baseListsAction(AmosTicket::t('amosticket', 'Ticket chiusi'), true);
    }

    /**
     * @param int $id
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionView($id)
    {
        $ticket = Ticket::findOne($id);
        if ($ticket->status == Ticket::TICKET_WORKFLOW_STATUS_WAITING) {
            $firstAnswer = $ticket->getFirstAnswer();
            if (!is_null($firstAnswer) and Yii::$app->getUser()->can('REFERENTE_TICKET')) { //?? stato preso in carico
                try {
                    $ticket->sendToStatus(Ticket::TICKET_WORKFLOW_STATUS_PROCESSING);
                    $ok = $ticket->save(false);
                    if ($ok) {
                        Yii::$app->session->addFlash('success', AmosTicket::t('amosticket', 'Ticket preso in carico!'));
                    } else {
                        Yii::$app->session->addFlash('danger', AmosTicket::t('amosticket', '#ERROR_WHILE_PROCESSING_TICKET'));
                    }
                    return $this->redirect(Url::current(['_csrf-backend' => null]));
                } catch (WorkflowException $e) {
                    Yii::$app->session->addFlash('danger', $e->getMessage());
                }
            }
        }
        return parent::actionView($id);
    }

    /**
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string
     */
    public function actionCreate()
    {
        $this->setUpLayout('form');

        $categoriaId = Yii::$app->request->get('categoriaId');

        if (is_null($categoriaId)) {
            throw new AmosException(AmosTicket::t('amosticket', '#create_ticket_missing_param_category_id'));
        }

        $this->model = new Ticket();
        $this->model->ticket_categoria_id = $categoriaId;

        if ($this->model->load(Yii::$app->request->post()) && $this->model->validate()) {
            if ($this->model->save()) {
                $categoria = TicketCategorie::findOne($this->model->ticket_categoria_id);
                if ($categoria->tecnica) {
                    try { // lo chiude subito
                        $this->model->sendToStatus(Ticket::TICKET_WORKFLOW_STATUS_CLOSED);
                        $this->model->closed_by = Yii::$app->getUser()->id;
                        $this->model->closed_at = $this->model->updated_at;
                        $ok = $this->model->save(false);
                        if (!$ok) {
                            Yii::$app->session->addFlash('danger', AmosTicket::t('amosticket', '#ERROR_WHILE_PROCESSING_TICKET'));
                        }
                    } catch (WorkflowException $e) {
                        Yii::$app->session->addFlash('danger', $e->getMessage());
                        return $this->redirect($this->standardRedirectUrl());
                    }
                }

                Yii::$app->getSession()->addFlash('success', AmosTicket::t('amosticket', 'Il ticket ?? stato creato'));
                return $this->render(
                    'create_thankyou',
                    [
                        'model' => $this->model,
                    ]
                );
            } else {
                Yii::$app->getSession()->addFlash('danger', AmosTicket::t('amosticket', 'Il ticket non ?? stato creato'));
            }
        } else {
            $categoriaId = Yii::$app->request->getQueryParam("categoriaId");
            $this->model->ticket_categoria_id = $categoriaId;
        }

        return $this->render(
            'create',
            [
                'model' => $this->model,
            ]
        );
    }

    /**
     * @param int $id
     * @return \yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionClosingTicket($id)
    {
        $this->model = $this->findModel($id);
        try {
            $oldStatus = $this->model->status;
            $this->model->sendToStatus(Ticket::TICKET_WORKFLOW_STATUS_CLOSED);
            if($this->model->status == Ticket::TICKET_WORKFLOW_STATUS_CLOSED && $oldStatus != Ticket::TICKET_WORKFLOW_STATUS_CLOSED){
                $this->model->closed_by = Yii::$app->getUser()->id;
                $this->model->closed_at = $this->model->updated_at;
            }
            $ok = $this->model->save(false);
            if ($ok) {
                Yii::$app->session->addFlash('success', AmosTicket::t('amosticket', 'Ticket chiuso!'));
            } else {
                Yii::$app->session->addFlash('danger', AmosTicket::t('amosticket', '#ERROR_WHILE_PROCESSING_TICKET'));
            }
        } catch (WorkflowException $e) {
            Yii::$app->session->addFlash('danger', $e->getMessage());
        }
        return $this->redirect($this->standardRedirectUrl());
    }

    /**
     * @param int $id
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionChangeCategoryTicket($id)
    {
        $this->setUpLayout('form');
        /** @var Ticket $model_old_ticket */
        $model_old_ticket = $this->findModel($id);
        $this->model = new Ticket();

        // inizializzo coi vecchi dati
        $this->model->forwarded_from_id = $model_old_ticket->id;
        $this->model->created_by = $model_old_ticket->created_by;
        $this->model->created_at = $model_old_ticket->created_at;
        $this->model->titolo = $model_old_ticket->titolo;
        $this->model->descrizione_breve = $model_old_ticket->descrizione_breve;
        $this->model->descrizione = $model_old_ticket->descrizione;
        $this->model->version = $model_old_ticket->version;
        $this->model->partnership_id = $model_old_ticket->partnership_id;

        if ($this->model->load(Yii::$app->request->post()) && $this->model->validate()) {
            if ($this->model->save()) {
                try {
                    $this->model->created_by = $model_old_ticket->created_by;
                    $this->model->created_at = $model_old_ticket->created_at;
                    $this->model->forwarded_by = Yii::$app->getUser()->id;
                    $this->model->forwarded_at = $this->model->updated_at;
                    $categoria = TicketCategorie::findOne($this->model->ticket_categoria_id);
                    if ($categoria->tecnica) { // la chiude subito
                        $this->model->sendToStatus(Ticket::TICKET_WORKFLOW_STATUS_CLOSED);
                        $this->model->closed_by = Yii::$app->getUser()->id;
                        $this->model->closed_at = $this->model->updated_at;
                    }
                    $ok = $this->model->save();
                    if ($ok) {
                        Yii::$app->getSession()->addFlash('success', AmosTicket::t('amosticket', '#ticket_category_changed'));
                        $model_old_ticket->sendToStatus(Ticket::TICKET_WORKFLOW_STATUS_CLOSED);
                        $model_old_ticket->closed_by = Yii::$app->getUser()->id;
                        $model_old_ticket->closed_at = $this->model->updated_at;
                        $ok = $model_old_ticket->save(false);
                        if ($ok) {

                        } else {
                            Yii::$app->session->addFlash('danger', AmosTicket::t('amosticket', '#ERROR_WHILE_PROCESSING_TICKET'));
                        }
                    } else {
                        Yii::$app->session->addFlash('danger', AmosTicket::t('amosticket', '#error_'));
                    }
                } catch (WorkflowException $e) {
                    Yii::$app->session->addFlash('danger', $e->getMessage());
                }

                return $this->redirect($this->standardRedirectUrl());
            } else {
                Yii::$app->getSession()->addFlash('danger', AmosTicket::t('amosticket', 'Ticket category not changed, check data'));

                return $this->render('change-categoria', [
                    'model' => $this->model,
                    'model_old_ticket' => $model_old_ticket,
                ]);
            }
        } else {
            return $this->render('change-categoria', [
                'model' => $this->model,
                'model_old_ticket' => $model_old_ticket,
            ]);
        }
    }

//    /**
//     * @param int $id
//     * @return string|\yii\web\Response
//     * @throws \yii\web\NotFoundHttpException
//     */
//    public function actionChangeCategoryTicket($id)
//    {
//        $this->setUpLayout('form');
//
//        $this->model = $this->findModel($id);
//        $newTicket = new Ticket();
//
//        // Inizializzo coi vecchi dati
//        $newTicket->forwarded_from_id = $this->model->id;
//        $newTicket->created_by = $this->model->created_by;
//        $newTicket->created_at = $this->model->created_at;
//        $newTicket->titolo = $this->model->titolo;
//        $newTicket->descrizione_breve = $this->model->descrizione_breve;
//        $newTicket->descrizione = $this->model->descrizione;
//        $newTicket->version = $this->model->version;
//        $newTicket->partnership_id = $this->model->partnership_id;
//
//        if ($newTicket->load(Yii::$app->request->post()) && $newTicket->validate()) {
//            if ($newTicket->save()) {
//                try {
//                    $newTicket->created_by = $this->model->created_by;
//                    $newTicket->created_at = $this->model->created_at;
//                    $newTicket->forwarded_by = Yii::$app->getUser()->id;
//                    $newTicket->forwarded_at = $newTicket->updated_at;
//                    $categoria = TicketCategorie::findOne($newTicket->ticket_categoria_id);
//                    if ($categoria->tecnica) { // la chiude subito
//                        $newTicket->sendToStatus(Ticket::TICKET_WORKFLOW_STATUS_CLOSED);
//                        $newTicket->closed_by = Yii::$app->getUser()->id;
//                        $newTicket->closed_at = $newTicket->updated_at;
//                    }
//                    $ok = $newTicket->save();
//                    if ($ok) {
//                        Yii::$app->getSession()->addFlash('success', AmosTicket::t('amosticket', '#ticket_category_changed'));
//                        $this->model->sendToStatus(Ticket::TICKET_WORKFLOW_STATUS_CLOSED);
//                        $this->model->closed_by = Yii::$app->getUser()->id;
//                        $this->model->closed_at = $newTicket->updated_at;
//                        $ok = $this->model->save(false);
//                        if ($ok) {
//                        } else {
//                            Yii::$app->session->addFlash('danger', AmosTicket::t('amosticket', '#ERROR_WHILE_PROCESSING_TICKET'));
//                        }
//                    } else {
//                        Yii::$app->session->addFlash('danger', AmosTicket::t('amosticket', '#error_change_category_new_ticket'));
//                    }
//                } catch (WorkflowException $e) {
//                    Yii::$app->session->addFlash('danger', $e->getMessage());
//                }
//
//                return $this->redirect($this->standardRedirectUrl());
//            } else {
//                Yii::$app->getSession()->addFlash('danger', AmosTicket::t('amosticket', 'Ticket category not changed, check data'));
//            }
//        }
//
//        return $this->render('change-categoria', [
//            'model' => $newTicket,
//            'model_old_ticket' => $this->model,
//        ]);
//    }


    /**
     * Set a view param used in \arter\amos\core\forms\CreateNewButtonWidget
     */
    protected function setCreateNewBtnParams()
    {
        if(\Yii::$app->user->can('TICKET_EXPORT')) {
            $extract = Html::a(AmosTicket::t('amosticket', 'Esporta i ticket'), '/ticket/ticket/extract-tickets',
                ['class' => 'btn btn-navigation-primary']);
            Yii::$app->view->params['additionalButtons'] = [
                'htmlButtons' => [$extract]
            ];
        }
    }

    /**
     * @return \yii\console\Response|\yii\web\Response
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     */
    public function actionExtractTickets(){
       $ticketSearch = new TicketSearch();
       $query = $ticketSearch->queryExtractTicket();
       $result = $query->all();

        $xlsData = [];
        // ------- LABELS --------
        $xlsData[]= [
            AmosTicket::t('amosticket', 'Ticked id'),   AmosTicket::t('amosticket', 'Categoria'),
            AmosTicket::t('amosticket', 'titolo'), AmosTicket::t('amosticket', 'Descrizione'),
            AmosTicket::t('amosticket', 'Utente creatore ticket') , AmosTicket::t('amosticket', 'Email utente creatore') ,
            AmosTicket::t('amosticket',  'Societ?? afferente'),
            AmosTicket::t('amosticket', 'Referente che sta gestendo il ticket'), AmosTicket::t('amosticket', 'Stato'),
            AmosTicket::t('amosticket', 'Creato il'),  AmosTicket::t('amosticket', 'Chiuso il'),
            AmosTicket::t('amosticket', 'Commenti'),  AmosTicket::t('amosticket', 'Risposte ai commenti')
        ];

        // ------  DATA --------
        foreach ($result as $faq){
            $modelTicket = Ticket::findOne($faq['ticket_id']);
            if(!empty($modelTicket)) {
                $status =  AmosTicket::t('amosticket', $modelTicket->workflowStatusLabel);
                $referee  =$modelTicket->ticketReferee;
            }
            $comments = (!empty($faq['commenti']) ? "-" : '').str_replace('#****#', "\n-", $faq['commenti'] );
            $commentsReply = (!empty($faq['risposte_ai_commenti']) ? "-" : '').str_replace('#****#', "\n\n-", $faq['risposte_ai_commenti'] );
            $xlsData[]= [
                $faq['ticket_id'], $faq['categoria'], $faq['titolo'],$faq['descrizione'],
                $faq['operatore_creatore'], $faq['email_operatore'],$faq['societa_afferente'], $referee, $status, $faq['created_at'], $faq['closed_at'],
                $comments, $commentsReply
            ];
        }

        // ----- GENERATE  EXCELL -------
        $objPHPExcel = new \PHPExcel();
        //li pone nella tab attuale del file xls
        $objPHPExcel->getActiveSheet()->fromArray($xlsData, NULL, 'A1');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('/tmp/ticket-faq.xls');
        return \Yii::$app->response->sendFile('/tmp/ticket-faq.xls');
        die;
    }
}
