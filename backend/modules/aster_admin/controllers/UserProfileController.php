<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_admin\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_admin\controllers;

use Yii;
use Exception;
use Throwable;
use yii\helpers\Url;
use yii\db\Transaction;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use arter\amos\core\user\User;
use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserContact;
use arter\amos\admin\models\UserProfile;
use arter\amos\notificationmanager\AmosNotify;
use arter\amos\attachments\components\FileImport;
use backend\modules\aster_admin\utility\UserProfileUtility;
use arter\amos\notificationmanager\widgets\NotifyFrequencyWidget;
use arter\amos\admin\controllers\UserProfileController as AmosUserProfileController;

/**
 * Class UserProfileController
 * @package backend\modules\aster_admin\controllers
 */
class UserProfileController extends AmosUserProfileController {

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'user-association-mentor-network'

                        ],
                        'roles' => ['ADMIN'],
                    ],
                ],
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function actionFacilitatorUsers() {
        Yii::$app->view->params['textHelp']['filename'] = 'yours_validated_users-helper';
        return parent::actionFacilitatorUsers();
    }

    /**
     * @inheritdoc
     */
    public function afterAssociateOneToMany($event) {
        parent::afterAssociateOneToMany($event);
        try {
            $userprofile_class = AmosAdmin::getInstance()->model('UserProfile');
            $post = Yii::$app->request->post();
            $save = isset($post['save']) ? ($post['save']) : true;
            if (isset($post['selected']) && $save && !empty($event->sender) && is_object($event->sender) && $event->sender instanceof $userprofile_class) {
                $useprofile = $event->sender;
                UserProfileUtility::updateUserProfileOnChangeMentor($useprofile);
            }
        } catch (\Exception $ex) {
            Yii::getLogger()->log($ex->getMessage(), \yii\log\Logger::LEVEL_ERROR);
        }
    }

    /**
     * @inheritdoc
     */
    public function actionUpdate($id, $render = true, $tabActive = null) {
        Url::remember();

        $this->setUpLayout('form');

        $url = Yii::$app->urlManager->createUrl(['/admin/user-profile/update-profile', 'id' => $id]);

        if ($render) {
            $url = Yii::$app->urlManager->createUrl(['/admin/user-profile/update', 'id' => $id]);
        }


        // Finding the user profile model
        $this->model = $this->findModel($id);

        // Setting the dynamic scenario. It's compiled dinamically by the
        // configuration manager based on the module configurations.
        // Remove this row to restore the default functionalities.
        $this->model->setScenario(UserProfile::SCENARIO_DYNAMIC);

        $selectedFacilitatorRoles = [];

        if (Yii::$app->request->post()) {
            $previousStatus = $this->model->status;
            $ruoliUtente = (isset(\Yii::$app->request->post()[$this->getModelName()]['listaRuoli']) && is_array(\Yii::$app->request->post()[$this->getModelName()]['listaRuoli'])) ? \Yii::$app->request->post()[$this->getModelName()]['listaRuoli'] : [];
            $setRuoli = (isset(\Yii::$app->request->post()[$this->getModelName()]['listaRuoli'])) ? true : false;

            /**
             * Keep track of old status
             */
            $currentStatus = $this->model->status;

            /**
             * Keep track of old setting of notify_from_editorial_staff
             */
            //            $notify_from_editorial_staff = $this->model->notify_from_editorial_staff;

            /**
             * Check if facilitator roles are deleted for the current user
             */
            $isFacilitatorRoleRemoved = false;
            $userProfilePost = Yii::$app->request->post('UserProfile');
            if (!empty($userProfilePost)) {
                if (array_key_exists('enable_facilitator_box', $userProfilePost)) {
                    if ($this->model->enable_facilitator_box == true && $userProfilePost['enable_facilitator_box'] == false) {
                        $isFacilitatorRoleRemoved = true;
                    }

                    $this->model->enable_facilitator_box = $userProfilePost['enable_facilitator_box'];

                    //UserProfileUtility::enableDisableRole($this->model, $this->model->enable_facilitator_box, 'FACILITATOR');
                }
            }

            /**
             * Load post data
             */
            $notify_from_editorial_staff = $this->model->notify_from_editorial_staff;
            $this->model->load(Yii::$app->request->post());
            $this->model->user->load(Yii::$app->request->post());
            if ($this->model->validate() && $this->model->user->validate()) {
                //$this->model->presentazione_breve = strip_tags($this->model->presentazione_breve);
                if (empty(Yii::$app->request->post('notify_from_editorial_staff'))) {
                    $this->model->notify_from_editorial_staff = 0;
                    if ($this->model->notify_from_editorial_staff != $notify_from_editorial_staff) {
                        $sent = UserProfileUtility::sendMail($this->model,
                                        '@vendor/arter/amos-admin/src/mail/user/notify-editorial-staff-subject',
                                        '@vendor/arter/amos-admin/src/mail/user/notify-editorial-staff-html'
                        );
                    }
                } else {
                    $this->model->notify_from_editorial_staff = 1;
                }
                if ($setRuoli) {
                    if (!empty($this->forzaListaRuoli)) {
                        // Se mi hanno forzato i ruoli, prendo buoni quelli passati
                        $this->model->setRuoli($this->forzaListaRuoli);
                        $this->forzaListaRuoli = null;
                    } else {
                        $this->model->setRuoli($ruoliUtente);
                    }
                }

                if (($this->model->status == UserProfile::USERPROFILE_WORKFLOW_STATUS_VALIDATED) || $this->adminModule->bypassWorkflow) {
                    $this->model->validato_almeno_una_volta = 1;
                }

                //If the previous status is validated return to draft
                if (!empty(\Yii::$app->request->post()['UserProfile']['isProfileModified'])) {
                    $isProfileModified = \Yii::$app->request->post()['UserProfile']['isProfileModified'];
                }
                if (($currentStatus == UserProfile::USERPROFILE_WORKFLOW_STATUS_VALIDATED) && !empty($isProfileModified) && $isProfileModified == 1) {
                    $this->model->status = UserProfile::USERPROFILE_WORKFLOW_STATUS_TOVALIDATE;
                }

                if ($this->model->save() && $this->model->user->save()) {
                    $this->assignFacilitator($isFacilitatorRoleRemoved);
                    if (Yii::$app->request->post('enable_cm_box') == "1") {
                        UserProfileUtility::enableDisableRole($this->model, true, 'CM_SFIDE');
                    } else if (Yii::$app->request->post('enable_cm_box') == "0") {
                        UserProfileUtility::enableDisableRole($this->model, false, 'CM_SFIDE');
                    }

                    if (Yii::$app->request->post('enable_animator_box') == "1") {
                        UserProfileUtility::enableDisableRole($this->model, true, 'PARTNER_PROF_EXPR_OF_INT_ADMIN_FACILITATOR');
                        UserProfileUtility::enableDisableRole($this->model, true, 'INVITATIONS_ADMINISTRATOR');
                        UserProfileUtility::enableDisableRole($this->model, true, 'PARTNERSHIP_PROFILES_FACILITATOR');
                    } else if (Yii::$app->request->post('enable_animator_box') == "0") {
                        UserProfileUtility::enableDisableRole($this->model, false, 'PARTNER_PROF_EXPR_OF_INT_ADMIN_FACILITATOR');
                        UserProfileUtility::enableDisableRole($this->model, false, 'INVITATIONS_ADMINISTRATOR');
                        UserProfileUtility::enableDisableRole($this->model, false, 'PARTNERSHIP_PROFILES_FACILITATOR');
                    }

                    if (empty($this->model->userProfileImage)) {
                        $adminmodule = AmosAdmin::instance();
                        if (!is_null($adminmodule)) {
                            $fileImport = new FileImport();
                            $ok = $fileImport->importFileForModel($this->model, 'userProfileImage',
                                    \Yii::getAlias($adminmodule->defaultProfileImagePath), false);
                        }
                    }

                    // Save email and sms notify frequency
                    $notifyModule = Yii::$app->getModule('notify');
                    if (!is_null($notifyModule)) {
                        /** @var AmosNotify $notifyModule */
                        $post = Yii::$app->request->post();
                        $emailFrequency = 0;
                        $smsFrequency = 0;
                        $atLeastOne = false;
                        if (isset($post[NotifyFrequencyWidget::emailFrequencySelectorName()])) {
                            $atLeastOne = true;
                            $emailFrequency = Yii::$app->request->post()[NotifyFrequencyWidget::emailFrequencySelectorName()];
                        }
                        if (isset($post[NotifyFrequencyWidget::smsFrequencySelectorName()])) {
                            $atLeastOne = true;
                            $smsFrequency = Yii::$app->request->post()[NotifyFrequencyWidget::smsFrequencySelectorName()];
                        }
                        if ($atLeastOne) {
                            $ok = $notifyModule->saveNotificationConf($this->model->user->id, $emailFrequency,
                                    $smsFrequency, $post);
                            if (!$ok) {
                                Yii::$app->getSession()->addFlash('danger',
                                        AmosAdmin::t('amosadmin', 'Error while updating email frequency'));
                                if ($render) {
                                    $this->updateParamsRender = ArrayHelper::merge($this->updateParamsRender,
                                                    [
                                                        'user' => $this->model->user,
                                                        'model' => $this->model,
                                                        'tipologiautente' => $this->model->tipo_utente,
                                                        'permissionSave' => 'USERPROFILE_UPDATE',
                                                        'tabActive' => $tabActive,
                                    ]);
                                    return $this->render('update', $this->updateParamsRender);
                                } else {
                                    return $this->model;
                                }
                            }
                        }
                    }

                    Yii::$app->getSession()->addFlash('success',
                            AmosAdmin::t('amosadmin', 'Profilo utente aggiornato con successo.'));
                    if ($render) {
                        return $this->redirectOnUpdate($this->model, $previousStatus);
                    } else {
                        return $this->model;
                    }
                } else {
                    Yii::$app->getSession()->addFlash('danger',
                            AmosAdmin::t('amosadmin', 'Si &egrave; verificato un errore durante il salvataggio'));
                }
            } else {
                $selectedFacilitatorRoles = Yii::$app->request->post('selectedFacilitatorRoles');
                if (isset($this->model->user->getErrors()['email'])) {
                    Yii::$app->getSession()->addFlash('danger', $this->model->user->getErrors()['email'][0]);
                } else {
                    Yii::$app->getSession()->addFlash('danger',
                            AmosAdmin::t('amosadmin', 'Modifiche non salvate. Verifica l\'inserimento dei campi'));
                }
            }
        }


        if ($render) {
            $this->updateParamsRender = ArrayHelper::merge($this->updateParamsRender,
                            [
                                'user' => $this->model->user,
                                'model' => $this->model,
                                'tipologiautente' => $this->model->tipo_utente,
                                'permissionSave' => 'USERPROFILE_UPDATE',
                                'tabActive' => $tabActive,
                                'selectedFacilitatorRoles' => $selectedFacilitatorRoles,
            ]);
            return $this->render('update', $this->updateParamsRender);
        } else {
            return $this->model;
        }
    }

    /**
     * Method per il controllo dell'esistenza di un record di user_contact tra user_profile facilitatore
     * user_profile 
     *
     * @return void
     */
    public function actionUserAssociationMentorNetwork(){

        // estrazione di tutti user_profile id che sono facilitatori dalla tabella user_profile
        $user_profiles_facilitatore_id = ArrayHelper::getColumn(
            $user_profiles_facilitatore = UserProfile::find()
                ->select('facilitatore_id')
                ->andWhere(['NOT', ['facilitatore_id' => null]])
                ->asArray()
                ->groupBy(['facilitatore_id'])
                ->all(),

            function ($element) {
                return $element['facilitatore_id'];
            }
        );

        $transaction = \Yii::$app->db->beginTransaction();

        try {

            // ciclo per ogni user_profile_facilitatore_id e cerco gli utenti da user_profile che lo hanno come facilitatore
            foreach ($user_profiles_facilitatore_id as $key => $user_profile_facilitatore_id) {

                // estrazione di tutti gli user_profile che hanno l'id del user_profile facilitatore
                $user_profiles = UserProfile::find()
                                ->andWhere(['facilitatore_id' => $user_profile_facilitatore_id])
                                ->andWhere(["NOT", ['user_id' => null]])
                                ->andWhere(['deleted_at' => null])
                                ->all();

                // per ogni user_profile controllo che ci sia un collegamento bidirezzionale tra user_profile e user_profile facilitatore
                foreach ($user_profiles as $key => $user_profile) {
   
                    if( null != $user_profile->user ){

                        // controllo se l'utente ha un contatto con il user_profile facilitatore
                        $user_contacts = UserContact::find()->andWhere(['or',
                                            ['user_id' => $user_profile->user_id],
                                            ['contact_id' => $user_profile->user_id]
                                        ])
                                        ->andWhere(['or',
                                            ['user_id' => $user_profile_facilitatore_id],
                                            ['contact_id' => $user_profile_facilitatore_id]
                                        ])
                                        ->andWhere(['deleted_at' => null])
                                        ->all();

                        // caso in cui ci sia un record user contact, procedo con il suo aggiornamento
                        if( null != $user_contacts ){

                            // aggiornamento dei record di user_contact
                            $this->updateUserContact($user_contacts);

                        }else{

                            // caso in cui non ci sono i record user_contact, procedo con la sua creazione
                            $this->createUserContact( $user_profile_facilitatore_id, $user_profile->user_id );
                        }
                    }
                }
            }

            $transaction->commit();

        } catch (\Throwable $th) {
            
            $transaction->rollBack();
            throw new \Exception(AmosAdmin::t('amosadmin', "Error during the save user contact " . $th->getMessage()));
        }

        echo "L'aggiornamento / creazione del record di contatto tra user_profile facilitatore e l'utente user_profile è andata a buon fine.";
    }


    /**
     * Method per la creazione di un nuovo record UserContact
     *
     * @param int $user_id
     * @param int $contact_id
     * @return void
     */
    public function createUserContact($user_id, $contact_id){

        $userContact = new UserContact();
        $userContact->user_id = $user_id;
        $userContact->contact_id = $contact_id;
        $userContact->created_by = $user_id;
        $userContact->status = UserContact::STATUS_ACCEPTED;

        $userContact->save(false);
    }

    /**
     * Method per l'aggiornamento dello stato dei recod user_contact 
     *
     * @param model|UserContact $user_contacts
     * @return void
     */
    public function updateUserContact($user_contacts){

        // ciclo per ogni user_contact procedo con l'aggiornamento
        foreach ($user_contacts as $key => $user_contact) {

            // aggiorno lo stato di quegli gia esistenti
            if ( $user_contact->status != UserContact::STATUS_ACCEPTED ) {
                
                $user_contact->status = UserContact::STATUS_ACCEPTED;
                $user_contact->save(false);
            }
        }
    }
    
}
