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
use backend\modules\aster_partnership_profiles\models\search\AnimationPartnershipProfilesSearch;
use backend\modules\aster_partnership_profiles\models\UsersAnimationMm;
use backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideWidgetIcon;
use arter\amos\chat\models\Message;
use arter\amos\core\forms\editors\m2mWidget\M2MEventsEnum;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\user\User;
use backend\modules\aster_partnership_profiles\Module;
use Exception;
use raoul2000\workflow\base\WorkflowException;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\base\Event;
use yii\web\ForbiddenHttpException;

/**
 * Class PartnershipProfilesController
 * @package backend\modules\aster_partnership_profiles\controllers
 */
class PartnershipProfilesController extends \arter\amos\partnershipprofiles\controllers\PartnershipProfilesController {

    const NOTIFY_ACTION_ERROR = 0;
    const NOTIFY_ACTION_SUCCESS = 1;

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        
        $this->on(M2MEventsEnum::EVENT_AFTER_INTERCECT_M2M, [$this, 'afterInterceptM2m']);
        $this->on(M2MEventsEnum::EVENT_AFTER_ASSOCIATE_ONE2MANY, [$this, 'afterAssociateOneToMany']);
        $this->on(M2MEventsEnum::EVENT_BEFORE_CANCEL_ASSOCIATE_M2M, [$this, 'beforeCancelAssociateM2m']);
    }

    /**
     *
     * $this->setRedirectAction('view');
        $this->setOptions(['#' => 'tab-organizations']);
     * @inheritdoc
     */
    public function behaviors() {
        $behaviors = ArrayHelper::merge(parent::behaviors(), [
                    'access' => [
                        'class' => AccessControl::className(),
                        'rules' => [
                            [
                                'allow' => true,
                                'actions' => [
                                    'associate-users-tags-m2m',
                                    'associate-users-m2m',
                                    'delete-user-animation',
                                    'contatta-ajax',
                                    'contatta-users-ajax',
                                    'create-community',
                                    'messages-users'
                                ],
                                'roles' => ['CM_SFIDE', 'PARTNERSHIP_PROFILES_FACILITATOR']
                            ],
                            [
                                'allow' => true,
                                'actions' => [
                                    'animation-to-assign',
                                    'animation-assigned',
                                    'animation-published',
                                    'close-partnership-profile',
                                ],
                                'roles' => ['CM_SFIDE']
                            ],
                            [
                                'allow' => true,
                                'actions' => [
                                    'animation-to-publish',
                                    'animation-published',
                                ],
                                'roles' => ['PARTNERSHIP_PROFILES_FACILITATOR']
                            ],
                            [
                                'allow' => true,
                                'actions' => [
                                    'close-partnership-profile',
                                ],
                                'roles' => ['PARTNERSHIP_PROFILES_ADMINISTRATOR']
                            ],
                            [
                                'allow' => true,
                                'actions' => [
                                    'close-partnership-profile',
                                ],
                                'roles' => ['PARTNERSHIP_PROFILES_CREATOR']
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
     * @inheritdoc
     */
    public function actionCreate() {
        $this->setUpLayout('form');

        $this->model = new PartnershipProfiles();
        //$okFacilitator = $this->setDefaultFacilitator();

       // Yii::$app->view->params['textHelp']['filename'] = 'expression_of_interest_description';

        if ($this->model->load(Yii::$app->request->post())) {
            //if ($okFacilitator) {
            $attrPartnershipProfilesTypesMmPost = [];
            if (!empty(\Yii::$app->request->post('PartnershipProfiles')['attrPartnershipProfilesTypesMm'])) {
                $attrPartnershipProfilesTypesMmPost = \Yii::$app->request->post('PartnershipProfiles')['attrPartnershipProfilesTypesMm'];
            }
            $attrPartnershipProfilesCountriesMmPost = [];
            if (!empty(\Yii::$app->request->post('PartnershipProfiles')['attrPartnershipProfilesCountriesMm'])) {
                $attrPartnershipProfilesCountriesMmPost = \Yii::$app->request->post('PartnershipProfiles')['attrPartnershipProfilesCountriesMm'];
            }
            if ($this->model->validate()) {
                $validateOnSave = true;
                if ($this->model->status == PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_TOVALIDATE) {
                    $this->model->status = PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_DRAFT;
                    $ok = $this->model->save();
                    if ($ok) {
                        $this->model->status = PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_TOVALIDATE;
                        $validateOnSave = false;
                    }
                }
                if ($this->model->status == PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED) {
                    $this->model->status = PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_DRAFT;
                    $ok = $this->model->save();
                    if ($ok) {
                        $this->model->status = PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED;
                        $validateOnSave = false;
                    }
                }
                if ($this->model->save($validateOnSave)) {
                    $okPartnershipProfileType = $this->savePartnershipProfileTypes($attrPartnershipProfilesTypesMmPost);
                    $okPartnershipProfileCountries = $this->savePartnershipProfileCountries($attrPartnershipProfilesCountriesMmPost);


                    if ($okPartnershipProfileType && $okPartnershipProfileCountries) {
                        Yii::$app->getSession()->addFlash('success', Module::tHtml('amospartnershipprofiles', 'Element successfully created.'));
                    } else if (!$okPartnershipProfileType && $okPartnershipProfileCountries) {
                        Yii::$app->getSession()->addFlash('danger', Module::tHtml('amospartnershipprofiles', '#error_saving_partnership_profile_type'));
                    } else if ($okPartnershipProfileType && !$okPartnershipProfileCountries) {
                        Yii::$app->getSession()->addFlash('danger', Module::tHtml('amospartnershipprofiles', '#error_saving_partnership_profile_countries'));
                    } else if (!$okPartnershipProfileType && !$okPartnershipProfileCountries) {
                        Yii::$app->getSession()->addFlash('danger', Module::tHtml('amospartnershipprofiles', '#error_saving_partnership_profile_countries_and_types'));
                    }
                    
                    if (Yii::$app->user->can('PARTNERSHIPPROFILES_UPDATE', ['model' => $this->model])) {
                        return $this->redirect(['update', 'id' => $this->model->id]);
                    } else {
                        return $this->redirect(Yii::$app->session->get(Module::beginCreateNewSessionKeyPartnershipProfiles()));
                    }
                } else {
                    Yii::$app->getSession()->addFlash('danger', Module::tHtml('amospartnershipprofiles', 'Element not created, check the data entered.'));
                }
            }
            //} else {
            //     Yii::$app->getSession()->addFlash('danger', Module::tHtml('amospartnershipprofiles', 'Error with partnership profile facilitator'));
            // }
        }

        return $this->render('create', [
                    'model' => $this->model,
                    'fid' => null,
                    'dataField' => null,
                    'dataEntity' => null
        ]);
    }

    public function actionCreateCommunity($id) {
        Url::remember();

        $this->model = $this->findModel($id);
        PartnershipProfiles::createAnimationCommunity($this->model);
        $this->model->community_id = null;
        $this->model->save(false);

        return $this->redirect(['/community/community/update', 'id' => $this->model->sfide_community_id]);
    }

    public function actionUpdate($id) {
        $this->setUpLayout('form');

       // Yii::$app->view->params['textHelp']['filename'] = 'expression_of_interest_description';
        $this->model = $this->findModel($id);
        //$this->setDefaultFacilitator();
        $this->model->attrPartnershipProfilesTypesMm = $this->model->partnershipProfilesTypes;
        $this->model->attrPartnershipProfilesCountriesMm = $this->model->partnershipProfileCountries;

        if ($this->model->load(Yii::$app->request->post()) && $this->model->validate()) {
            $attrPartnershipProfilesTypesMmPost = [];
            if (!empty(\Yii::$app->request->post('PartnershipProfiles')['attrPartnershipProfilesTypesMm'])) {
                $attrPartnershipProfilesTypesMmPost = \Yii::$app->request->post('PartnershipProfiles')['attrPartnershipProfilesTypesMm'];
            }
            $attrPartnershipProfilesCountriesMmPost = [];

            if (!empty(\Yii::$app->request->post('PartnershipProfiles')['attrPartnershipProfilesCountriesMm'])) {
                $attrPartnershipProfilesCountriesMmPost = \Yii::$app->request->post('PartnershipProfiles')['attrPartnershipProfilesCountriesMm'];
            }

            if ($this->model->save()) {
                $okPartnershipProfileType = $this->savePartnershipProfileTypes($attrPartnershipProfilesTypesMmPost);
                $okPartnershipProfileCountries = $this->savePartnershipProfileCountries($attrPartnershipProfilesCountriesMmPost);
                if ($okPartnershipProfileType && $okPartnershipProfileCountries) {
                    Yii::$app->getSession()->addFlash('success', Module::tHtml('amospartnershipprofiles', 'Element successfully updated.'));
                } else if (!$okPartnershipProfileType && $okPartnershipProfileCountries) {
                    Yii::$app->getSession()->addFlash('danger', Module::tHtml('amospartnershipprofiles', '#error_saving_partnership_profile_type'));
                } else if ($okPartnershipProfileType && !$okPartnershipProfileCountries) {
                    Yii::$app->getSession()->addFlash('danger', Module::tHtml('amospartnershipprofiles', '#error_saving_partnership_profile_countries'));
                } else if (!$okPartnershipProfileType && !$okPartnershipProfileCountries) {
                    Yii::$app->getSession()->addFlash('danger', Module::tHtml('amospartnershipprofiles', '#error_saving_partnership_profile_countries_and_types'));
                }
                if (Yii::$app->user->can('PARTNERSHIPPROFILES_UPDATE', ['model' => $this->model])) {
                    return $this->redirect(['update', 'id' => $this->model->id]);
                } else {
                    return $this->redirect(Yii::$app->session->get(Module::beginCreateNewSessionKeyPartnershipProfiles()));
                }
            } else {
                Yii::$app->getSession()->addFlash('danger', Module::tHtml('amospartnershipprofiles', 'Element not updated, check the data entered.'));
            }
        }

        return $this->render(
                        'update',
                        [
                            'model' => $this->model,
                            'fid' => null,
                            'dataField' => null,
                            'dataEntity' => null
                        ]
        );
    }

    /**
     * Displays a single PartnershipProfiles model.
     * @param integer $id
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     * @throws ForbiddenHttpException
     */
    public function actionView($id) {
        Url::remember();

        $this->model = $this->findModel($id);
        if (!\backend\modules\aster_partnership_profiles\utility\PartnershipProfilesUtility::canView($this->model)) {
            throw new ForbiddenHttpException();
        }

        $this->setSessionBeginCreateLink();
        $this->model->setScenario(PartnershipProfiles::SCENARIO_VIEW);

        if ($this->model->load(Yii::$app->request->post()) && $this->model->save(false)) {
            if (Yii::$app->user->can('PARTNERSHIPPROFILES_READ', $this->model)) {
                return $this->redirect(['view', 'id' => $this->model->id]);
            } else {
                return $this->redirect(Yii::$app->session->get(Module::beginCreateNewSessionKeyPartnershipProfiles()));
            }
        } else {
            return $this->render('view', ['model' => $this->model]);
        }
    }

    /**
     * @inheritdoc
     */
    public function actionAssociateFacilitator($id) {
        /** @var PartnershipProfiles $partnershipProfile */
        $partnershipProfile = $this->findModel($id);
        if (
                (Yii::$app->user->id != $partnershipProfile->created_by) &&
                !Yii::$app->user->can('ADMIN') &&
                !Yii::$app->user->can('PARTNERSHIP_PROFILES_ADMINISTRATOR') &&
                !Yii::$app->user->can('PARTNER_PROF_EXPR_OF_INT_ADMIN_FACILITATOR') &&
                !Yii::$app->user->can('PARTNERSHIP_PROFILES_VALIDATOR') &&
                !Yii::$app->user->can('CM_SFIDE')
        ) {
            throw new ForbiddenHttpException(Yii::t('amoscore', 'Non sei autorizzato a visualizzare questa pagina'));
        }

        $this->setUpLayout('main');
        $this->setMmTargetKey('facilitatoreUserProfileId');
        $this->setTargetUrl('associate-facilitator');
        return $this->actionAssociateOneToMany($id);
    }

    /**
     * @return mixed
     */
    public function actionAssociateUsersTagsM2m() {
        Yii::$app->view->params['textHelp']['filename'] = 'associate_users_tags_m2m_help';
        $partnership_profile_id = Yii::$app->request->get('id');
        Url::remember();

        $this->setMmTableName(UsersAnimationMm::className());
        $this->setStartObjClassName(PartnershipProfiles::className());
        $this->setMmStartKey('partnership_profile_id');
        $this->setTargetObjClassName(User::className());
        $this->setMmTargetKey('user_id');
        $this->setRedirectAction('view');
        $this->setTargetUrl('@app/modules/aster_partnership_profiles/views/partnership-profiles/associate-users-tags-m2m');
        $this->setCustomQuery(true);
        $this->setRedirectArray('/partnershipprofiles/partnership-profiles/view?id=' . $partnership_profile_id . '#tab-animatore');

        return $this->actionAssociaM2m($partnership_profile_id);
    }

    /**
     * @return mixed
     */
    public function actionAssociateUsersM2m() {
        Yii::$app->view->params['textHelp']['filename'] = 'associate_users_m2m_help';
        $partnership_profile_id = Yii::$app->request->get('id');
        Url::remember();

        $this->setMmTableName(UsersAnimationMm::className());
        $this->setStartObjClassName(PartnershipProfiles::className());
        $this->setMmStartKey('partnership_profile_id');
        $this->setTargetObjClassName(User::className());
        $this->setMmTargetKey('user_id');
        $this->setRedirectAction('view');
        $this->setTargetUrl('@app/modules/aster_partnership_profiles/views/partnership-profiles/associate-users-m2m');
        $this->setCustomQuery(true);
        $this->setRedirectArray('/partnershipprofiles/partnership-profiles/view?id=' . $partnership_profile_id . '#tab-animatore');
        return $this->actionAssociaM2m($partnership_profile_id);
    }

    /**
     *
     * @param type $id
     * @return type
     */
    public function actionMessagesUsers() {
        $post = Yii::$app->request->post();

        if ($post) {

            $ids = $post['selection'];
        } else {
            Yii::$app->getSession()->addFlash('danger', Module::t('partnershipprofiles', 'Nessun Utente Selezionato'));
            return $this->redirect(Url::previous());
        }
    }

    /**
     * @param Event $event
     * @throws \yii\base\InvalidConfigException
     */
    public function afterInterceptM2m($event) {
        $post = Yii::$app->request->post();
        $usersAnimationMm = $event->sender['intercect'];
        $usersAnimationMm->select_keyword = isset($post['genericSearch']) ? $post['genericSearch'] : '';

        $usersAnimationMm->save(false);
    }

    /**
     * @param Event $event
     */
    public function beforeCancelAssociateM2m($event)
    {
        $urlPrevious = Url::previous();
        $id = Yii::$app->request->get('id');

        if (strstr($urlPrevious, 'associate-users-m2m')) {
           $this->setRedirectArray('/partnershipprofiles/partnership-profiles/view?id=' . $id . '#tab-animatore');
        }
        if (strstr($urlPrevious, 'associate-users-tags-m2m')) {
            $this->setRedirectArray('/partnershipprofiles/partnership-profiles/view?id=' . $id . '#tab-animatore');
        }
    }
    
    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDeleteUserAnimation($id) {
        /** @var UsersAnimationMm $model */
        $model = UsersAnimationMm::find()->andWhere(['id' => $id])->one();
        $model->delete();

        if (!$model->hasErrors()) {
            Yii::$app->getSession()->addFlash('success', Module::t('partnershipprofiles', 'Invito cancellato correttamente.'));
        } else {
            Yii::$app->getSession()->addFlash('danger',
                    Module::t('partnershipprofiles', 'Non sei autorizzato a cancellare l\'invito.'));
        }

        return $this->redirect(Url::previous());
    }

    /**
     * @param string|null $currentView
     * @return string
     */
    public function actionAnimationToPublish($currentView = null) {
        $this->setAvailableViews([
            'grid' => $this->viewGrid,
        ]);
        $modelSearch = new AnimationPartnershipProfilesSearch();
        $this->setDataProvider($modelSearch->searchAnimationToValidate(Yii::$app->request->getQueryParams()));
        return $this->baseListsActionAnimation('Da pubblicare', 'grid', true, true, AnimazioneSfideWidgetIcon::className());
    }

    /**
     * @param string|null $currentView
     * @return string
     */
    public function actionAnimationPublished($currentView = null) {
        $this->setAvailableViews([
            'grid' => $this->viewGrid,
        ]);
        $modelSearch = new AnimationPartnershipProfilesSearch();
        $this->setDataProvider($modelSearch->searchAnimationValidated(Yii::$app->request->getQueryParams()));
        return $this->baseListsActionAnimation('Pubblicate', 'grid', true, true, AnimazioneSfideWidgetIcon::className());
    }

    /**
     * @param string|null $currentView
     * @return string
     */
    public function actionAnimationToAssign($currentView = null) {
        $this->setAvailableViews([
            'grid' => $this->viewGrid,
        ]);
        $modelSearch = new AnimationPartnershipProfilesSearch();
        $this->setDataProvider($modelSearch->searchAnimationToAssign(Yii::$app->request->getQueryParams()));
        return $this->baseListsActionAnimation('Pubblicate', 'grid', true, true, AnimazioneSfideWidgetIcon::className());
    }

    /**
     * @param string|null $currentView
     * @return string
     */
    public function actionAnimationAssigned($currentView = null) {
        $this->setAvailableViews([
            'grid' => $this->viewGrid,
        ]);
        $modelSearch = new AnimationPartnershipProfilesSearch();
        $this->setDataProvider($modelSearch->searchAnimationAssigned(Yii::$app->request->getQueryParams()));
        return $this->baseListsActionAnimation('Pubblicate', 'grid', true, true, AnimazioneSfideWidgetIcon::className());
    }

    /**
     * @param $pageTitle
     * @param null $currentView
     * @param bool $setCurrentDashboard
     * @param bool $hideCreateNewBtn
     * @param null $child_of
     * @return string
     */
    protected function baseListsActionAnimation($pageTitle, $currentView = null, $setCurrentDashboard = true, $hideCreateNewBtn = false, $child_of = null) {
        Url::remember();
        if (empty($currentView)) {
            $currentView = 'list';
        }
        $this->setTitleAndBreadcrumbs($pageTitle);
        $this->setListViewsParams($setCurrentDashboard, $hideCreateNewBtn, $child_of);
        $this->setCurrentView($this->getAvailableView($currentView));
        return $this->render('@backend/modules/aster_partnership_profiles/views/partnership-profiles/index_animation', [
                    'dataProvider' => $this->getDataProvider(),
                    'model' => $this->getModelSearch(),
                    'currentView' => $this->getCurrentView(),
                    'availableViews' => $this->getAvailableViews(),
                    'url' => ($this->url) ? $this->url : null,
                    'parametro' => ($this->parametro) ? $this->parametro : null
        ]);
    }

    /**
     * This action sends an invite to EROE
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionContattaAjax() {
        if (!Yii::$app->request->isAjax) {
            Yii::$app->getSession()->addFlash('danger', Module::t('partnershipprofiles', 'Errore invio messaggio'));
            return $this->redirect(Url::previous());
        }

        if (!Yii::$app->request->isPost) {
            return $this->notifyActionMessage(static::NOTIFY_ACTION_ERROR, Module::t('partnershipprofiles', 'Errore invio messaggio'));
        }

        $post = Yii::$app->request->post();

        if ($post) {

            $id = $post['notify_api_id'];
            $text = $post['notify_text'];
            try {
                $modelAnimationMm = UsersAnimationMm::find()->andWhere(['id' => $id])->one();
            } catch (NotFoundHttpException $exception) {
                return $this->notifyActionMessage(static::NOTIFY_ACTION_ERROR, Module::t('partnershipprofiles', 'Errore invio messaggio'));
            }

            if (is_null($this->model)) {
                return $this->notifyActionMessage(static::NOTIFY_ACTION_ERROR, Module::t('partnershipprofiles', 'Errore invio messaggio'));
            }
            try {
                $transaction = Yii::$app->db->beginTransaction();

                $msgInvitation = new Message();
                $msgInvitation->text = '<p></p><p>' . $text . '</p>';
                $msgInvitation->sender_id = Yii::$app->getUser()->getId();
                $msgInvitation->receiver_id = $modelAnimationMm->user_id;
                $msgInvitation->is_new = 1;

                $ok = $msgInvitation->save();

                if ($ok) {
                    $modelAnimationMm->number_msg += 1;
                    $ok = $modelAnimationMm->save(false);

                    if ($ok) {
                        $transaction->commit();
                        return $this->notifyActionMessage(static::NOTIFY_ACTION_SUCCESS, Module::t('partnershipprofiles', 'Messaggio inviato correttamente'));
                    } else {
                        $transaction->rollBack();
                        return $this->notifyActionMessage(static::NOTIFY_ACTION_ERROR, Module::t('partnershipprofiles', 'Errore invio messaggio'));
                    }
                } else {
                    $transaction->rollBack();
                    return $this->notifyActionMessage(static::NOTIFY_ACTION_ERROR, Module::t('partnershipprofiles', 'Errore invio messaggio'));
                }
            } catch (Exception $exception) {
                $transaction->rollBack();
            }
        }

        return $this->notifyActionMessage(static::NOTIFY_ACTION_ERROR, Module::t('partnershipprofiles', 'Errore invio messaggio'));
    }

    /**
     * This action sends an invite to EROE
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionContattaUsersAjax() {

        $post = Yii::$app->request->post();

        if ($post) {

            $ids = explode(',', $post['notify_api_id']);
            $text = $post['notify_text'];

            try {

                $modelAnimationMms = UsersAnimationMm::find()
                                ->andWhere(['id' => $ids])->all();
            } catch (NotFoundHttpException $exception) {
                return $this->notifyActionMessage(static::NOTIFY_ACTION_ERROR, Module::t('partnershipprofiles', 'Errore invio messaggio 1'));
            }

            if (is_null($this->model)) {
                return $this->notifyActionMessage(static::NOTIFY_ACTION_ERROR, Module::t('partnershipprofiles', 'Errore invio messaggio 2'));
            }
            try {

                $transaction = Yii::$app->db->beginTransaction();
                foreach ($modelAnimationMms as $model) {
                    $msgInvitation = new Message();
                    $msgInvitation->text = '<p>' . $text . '</p>';
                    $msgInvitation->sender_id = Yii::$app->getUser()->getId();
                    $msgInvitation->receiver_id = $model->user_id;
                    $msgInvitation->is_new = 1;

                    $ok = $msgInvitation->save();

                    if ($ok) {
                        $model->number_msg += 1;
                        $ok = $model->save(false);

                        if (!$ok) {

                            $transaction->rollBack();
                            return $this->notifyActionMessage(static::NOTIFY_ACTION_ERROR, Module::t('partnershipprofiles', 'Errore invio messaggio 3'));
                        }
                    } else {
                        $transaction->rollBack();
                        return $this->notifyActionMessage(static::NOTIFY_ACTION_ERROR, Module::t('partnershipprofiles', 'Errore invio messaggio 4'));
                    }
                }
                $transaction->commit();
                return $this->notifyActionMessage(static::NOTIFY_ACTION_SUCCESS, Module::t('partnershipprofiles', 'Messaggio inviato correttamente'));
            } catch (Exception $exception) {
                $transaction->rollBack();
            }
        }

        return $this->notifyActionMessage(static::NOTIFY_ACTION_ERROR, Module::t('partnershipprofiles', 'Errore invio messaggio 5'));
    }

    /**
     * Method useful to notify messages in actionSendNotifyAjax.
     * @param string $errorMessage
     * @return string
     */
    private function notifyActionMessage($success, $errorMessage) {
        $retArray = [
            'success' => $success,
            'message' => $errorMessage
        ];
        return json_encode($retArray);
    }

    /**
     * @inheritdoc
     */
    public function afterAssociateOneToMany($event) {


        try {
            //$pp_class = get_class(Module::instance()->createModel('PartnershipProfiles'));
            //&& $event->sender instanceof PartnershipProfiles

            if (!empty($event->sender) && is_object($event->sender)) {

                $pp = $event->sender;
                \backend\modules\aster_partnership_profiles\utility\PartnershipProfilesUtility::updateUserProfileOnChangeMentor($pp);
            }
        } catch (Exception $ex) {
            Yii::getLogger()->log($ex->getMessage(), \yii\log\Logger::LEVEL_ERROR);
        }
    }
    
    /**
     * @param string|null $currentView
     * @return string
     */
    public function actionClosed($currentView = null)
    {
        $this->setDataProvider($this->modelSearch->searchArchivedClosed(Yii::$app->request->getQueryParams()));
        return $this->baseListsAction('Closed', $currentView);
    }
    
    /**
     * @param int $id Document id.
     * @return \yii\web\Response
     */
    public function actionClosePartnershipProfile($id)
    {
        /** @var PartnershipProfiles $partnershipProfilesModel */
        $partnershipProfilesModel = $this->partnerProfModule->createModel('PartnershipProfiles');
        $model = $partnershipProfilesModel::findOne($id);
        if (!Yii::$app->user->can('CM_SFIDE') && !Yii::$app->user->can('PARTNERSHIP_PROFILES_ADMINISTRATOR') && (Yii::$app->user->id != $model->created_by)) {
            throw new ForbiddenHttpException(BaseAmosModule::t('amoscore', 'Non sei autorizzato a visualizzare questa pagina'));
        }
        if (!in_array($model->status, [PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED, PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_FEEDBACKRECEIVED])) {
            throw new Exception(Module::t('amospartnershipprofiles', '#error_cannot_close_partnership_profile'));
        }
        try {
            $model->sendToStatus(PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_CLOSED);
            $ok = $model->save(false);
            if ($ok) {
                Yii::$app->session->addFlash('success', Module::t('amospartnershipprofiles', '#partnership_profile_successfully_closed'));
            } else {
                Yii::$app->session->addFlash('danger', Module::t('amospartnershipprofiles', '#error_closing_partnership_profile'));
            }
        } catch (WorkflowException $e) {
            Yii::$app->session->addFlash('danger', $e->getMessage());
        }
        return $this->redirect(Url::previous());
    }
    /**
     * @param PartnershipProfiles $model
     * @return bool
     */
    public function viewCreateProjectGroupBtn($model)
    {
        return false;
    }

    /**
     * @param PartnershipProfiles $model
     * @return bool
     */
    public function viewAccessProjectGroupBtn($model)
    {
        return false;
    }
}
