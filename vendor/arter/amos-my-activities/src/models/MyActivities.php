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
 * @package    arter\amos\myactivities\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\myactivities\models;

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\base\UserProfile;
use arter\amos\admin\models\UserContact;
use arter\amos\core\user\User;
use arter\amos\myactivities\AmosMyActivities;
use arter\amos\myactivities\basic\CommunityToValidate;
use arter\amos\myactivities\basic\DiscussionToValidate;
use arter\amos\myactivities\basic\DocumentToValidate;
use arter\amos\myactivities\basic\EenExpressionOfInterestToTakeover;
use arter\amos\myactivities\basic\EventToValidate;
use arter\amos\myactivities\basic\ExpressionOfInterestToEvaluate;
use arter\amos\myactivities\basic\MyActivitiesList;
use arter\amos\myactivities\basic\NewsToValidate;
use arter\amos\myactivities\basic\OrganizationsToValidate;
use arter\amos\myactivities\basic\PartnershipProfileToValidate;
use arter\amos\myactivities\basic\ReportToRead;
use arter\amos\myactivities\basic\RequestToJoinOrganizzazioniForReferees;
use arter\amos\myactivities\basic\RequestToJoinOrganizzazioniSediForReferees;
use arter\amos\myactivities\basic\RequestToParticipateCommunity;
use arter\amos\myactivities\basic\RequestToParticipateCommunityForManager;
use arter\amos\myactivities\basic\ResultsProposalToValidate;
use arter\amos\myactivities\basic\ResultsToValidate;
use arter\amos\myactivities\basic\ShowcaseProjectToValidate;
use arter\amos\myactivities\basic\ShowcaseProjectUserToAccept;
use arter\amos\myactivities\basic\UserProfileActivationRequest;
use arter\amos\myactivities\basic\UserProfileToValidate;
use arter\amos\myactivities\basic\WaitingContacts;
use arter\amos\myactivities\models\search\MyActivitiesModelSearch;
use arter\amos\organizzazioni\models\ProfiloSedi;
use arter\amos\partnershipprofiles\models\PartnershipProfiles;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * Class MyActivities
 * @package arter\amos\myactivities\models
 */
class MyActivities extends Model
{
    /**
     * @var MyActivitiesList $myActivitiesList
     */
    private $myActivitiesList;

    /**
     * @var array $queryParams
     */
    private $queryParams;

    /**
     * @var int $user_id
     */
    private $user_id;

    /**
     * @var bool $countOnly
     */
    static $countOnly = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->myActivitiesList = new MyActivitiesList();
        $this->user_id = Yii::$app->user->id;

        parent::init();
    }

    /**
     * @param bool $count
     * @return bool|int|mixed
     * @throws \yii\base\InvalidConfigException
     */
    public static function getCountActivities($count = false)
    {
        self::$countOnly = $count;
        $model = new MyActivities;

        $allMyActivities = $model->getMyActivities(null, false);

        $counter = 0;
        foreach ($allMyActivities as $activity => $count) {
            $counter += $count;
        }

        return $counter;
    }

    /**
     * @param MyActivitiesModelSearch|null $modelSearch
     * @param bool $enableOrder
     * @return array
     * @throws \arter\amos\core\exceptions\AmosException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function getMyActivities($modelSearch = null, $enableOrder = true)
    {
        $this->queryParams = Yii::$app->request->getQueryParams();

        $this->myActivitiesList->addModelSet($this->getWaitingContacts());
        $this->myActivitiesList->addModelSet($this->getNewsToValidate($enableOrder));
        $this->myActivitiesList->addModelSet($this->getRequestToParticipateCommunity());
        $this->myActivitiesList->addModelSet($this->getUserProfileToValidate());
        $this->myActivitiesList->addModelSet($this->getComunityToValidate($enableOrder));
        $this->myActivitiesList->addModelSet($this->getDiscussionToValidate($enableOrder));
        $this->myActivitiesList->addModelSet($this->getDocumentToValidate($enableOrder));
        $this->myActivitiesList->addModelSet($this->getEventsToValidate($enableOrder));

        $this->myActivitiesList->addModelSet($this->getOrganizationsToValidate($enableOrder));

        $this->myActivitiesList->addModelSet($this->getShowcaseProjectToValidate($enableOrder));
        $this->myActivitiesList->addModelSet($this->getResultsToValidate($enableOrder));
        $this->myActivitiesList->addModelSet($this->getEenExpressionOfInterestToTakeover($enableOrder));
        $this->myActivitiesList->addModelSet($this->getProposalResultsToValidate($enableOrder));
        $this->myActivitiesList->addModelSet($this->getPartnershipProfilesToValidate($enableOrder));
        $this->myActivitiesList->addModelSet($this->getUserProfileActivationRequest());
        $this->myActivitiesList->addModelSet($this->getShowcaseProjectUserToAccept($enableOrder));

        /* NOT IMPLEMENTED
          $this->myActivitiesList->addModelSet($this->getSurveyToValidate());
          $this->myActivitiesList->addModelSet($this->getExpressionOfInterestToEvaluate());
         */

        $this->myActivitiesList->addModelSet($this->getRequestToParticipateCommunityForManager());
        $this->myActivitiesList->addModelSet($this->getReportToRead());
        $this->myActivitiesList->addModelSet($this->getRequestToJoinOrganizzazioniForReferees());
        $this->myActivitiesList->addModelSet($this->getRequestToJoinOrganizzazioniSediForReferees());

        if (self::$countOnly == false) {
            $this->myActivitiesList->applySort($modelSearch);
            $this->myActivitiesList->applyFilter($modelSearch);
        }

        return $this->myActivitiesList->getMyActivitiesList();
    }

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    private function getWaitingContacts()
    {
        if (Yii::$app->hasModule('admin')) {
            /** @var ActiveQuery $query */
            $query = WaitingContacts::find()
                ->innerJoinWith('user')
                ->andWhere([
                    WaitingContacts::tableName() . '.contact_id' => $this->user_id,
                    WaitingContacts::tableName() . '.status' => UserContact::STATUS_INVITED
                ]);

            if (self::$countOnly) {
                return [WaitingContacts::className() => $query->asArray()->count()];
            }

            return $query->all();
        }

        return [];
    }

    /**
     * @param bool $enableOrder
     * @return array|\yii\db\ActiveRecord[]
     * @throws \yii\base\InvalidConfigException
     */
    private function getNewsToValidate($enableOrder)
    {
        if (Yii::$app->hasModule('news')) {
            $modelSearch = new NewsToValidate();
            /** @var ActiveDataProvider $dataProvider */
            $dataProvider = $modelSearch->searchToValidateNews($this->queryParams);
            if (!$enableOrder) {
                $dataProvider->sort = false;
            }
            $ids = ArrayHelper::map($dataProvider->models, 'id', 'id');

            /** @var ActiveQuery $query */
            $query = NewsToValidate::find()
                ->andWhere(['id' => $ids]);

            if (self::$countOnly) {
                return [NewsToValidate::className() => $query->asArray()->count()];
            }

            return $query->all();
        }

        return [];
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     * @throws \yii\base\InvalidConfigException
     */
    private function getRequestToParticipateCommunity()
    {
        if (Yii::$app->hasModule('community')) {
            /** @var ActiveQuery $query */
            $query = RequestToParticipateCommunity::find()
                ->joinWith('community')
                ->andWhere([
                    'community.validated_once' => 1,
                    'community_user_mm.user_id' => $this->user_id,
                    'community_user_mm.status' => \arter\amos\community\models\CommunityUserMm::STATUS_WAITING_OK_USER
                ]);

            if (self::$countOnly) {
                return [RequestToParticipateCommunity::className() => $query->asArray()->count()];
            }

            return $query->all();
        }

        return [];
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     * @throws \yii\base\InvalidConfigException
     */
    private function getUserProfileToValidate()
    {
        if (Yii::$app->hasModule('admin')) {
            /** @var ActiveQuery|null $query */
            $query = null;
            if (\Yii::$app->user->can('FACILITATOR')) {
                /** @var User $user */
                $user = Yii::$app->user->identity;
                $query = UserProfileToValidate::find()
                    ->andWhere([
                        'status' => \arter\amos\admin\models\UserProfile::USERPROFILE_WORKFLOW_STATUS_TOVALIDATE,
                        'attivo' => 1,
                        'facilitatore_id' => $user->userProfile->id
                    ]);
            } else if (\Yii::$app->user->can('VALIDATOR')) {
                $query = UserProfileToValidate::find()
                    ->andWhere([
                        'status' => \arter\amos\admin\models\UserProfile::USERPROFILE_WORKFLOW_STATUS_TOVALIDATE,
                        'attivo' => 1
                    ]);
            }

            if (self::$countOnly) {
                return [UserProfileToValidate::className() => (!empty($query) ? $query->asArray()->count() : 0)];
            }

            return (!empty($query) ? $query->all() : []);
        }

        return [];
    }

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    private function getUserProfileActivationRequest()
    {
        if (Yii::$app->hasModule('admin')) {
            if (Yii::$app->user->can('ADMIN')) {
                /** @var ActiveQuery $query */
                $query = UserProfileActivationRequest::find()
                    ->innerJoinWith('userProfileReactivationRequest')
                    ->andWhere(['user_profile.attivo' => 0]);

                if (self::$countOnly) {
                    return [UserProfileActivationRequest::className() => $query->asArray()->count()];
                }

                return $query->all();
            }
        }

        return [];
    }

    /**
     * @param bool $enableOrder
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    private function getComunityToValidate($enableOrder)
    {
        if (Yii::$app->hasModule('community')) {
            $communitySearch = new CommunityToValidate;
            $dataProvider = $communitySearch->searchToValidateCommunities($this->queryParams);
            if (!$enableOrder) {
                $dataProvider->sort = false;
            }
            $ids = ArrayHelper::map($dataProvider->models, 'id', 'id');

            /** @var ActiveQuery $query */
            $query = CommunityToValidate::find()
                ->andWhere(['id' => $ids]);

            if (self::$countOnly) {
                return [CommunityToValidate::className() => $query->asArray()->count()];
            }

            return $query->all();
        }

        return [];
    }

    /**
     * @@param bool $enableOrder
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    private function getDiscussionToValidate($enableOrder)
    {
        if (Yii::$app->hasModule('discussioni')) {
            $modelSearch = new DiscussionToValidate;
            $notifyModule = \Yii::$app->getModule('notify');
            if ($notifyModule) {
                $modelSearch->setNotifier(new \arter\amos\notificationmanager\base\NotifyWidgetDoNothing());
            }

            $dataProvider = $modelSearch->searchToValidate($this->queryParams);
            if (!$enableOrder) {
                $dataProvider->sort = false;
            }
            $ids = ArrayHelper::map($dataProvider->models, 'id', 'id');

            /** @var ActiveQuery $query */
            $query = DiscussionToValidate::find()
                ->andWhere(['id' => $ids]);

            if (self::$countOnly) {
                return [DiscussionToValidate::className() => $query->asArray()->count()];
            }

            return $query->all();
        }

        return [];
    }

    /**
     * @param bool $enableOrder
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    private function getDocumentToValidate($enableOrder)
    {
        if (Yii::$app->hasModule('documenti')) {
            $modelSearch = new DocumentToValidate();
            $dataProvider = $modelSearch->searchToValidateDocuments($this->queryParams);
            if (!$enableOrder) {
                $dataProvider->sort = false;
            }
            $ids = ArrayHelper::map($dataProvider->models, 'id', 'id');

            /** @var ActiveQuery $query */
            $query = DocumentToValidate::find()
                ->andWhere(['id' => $ids]);

            if (self::$countOnly) {
                return [DocumentToValidate::className() => $query->asArray()->count()];
            }

            return $query->all();
        }

        return [];
    }

    /**
     * @@param bool $enableOrder
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    private function getEventsToValidate($enableOrder)
    {
        if (Yii::$app->hasModule('events')) {
            $modelSearch = new EventToValidate();
            /** @var ActiveDataProvider $dataProvider */
            $dataProvider = $modelSearch->searchToValidate($this->queryParams);
            if (!$enableOrder) {
                $dataProvider->sort = false;
            }
            $ids = ArrayHelper::map($dataProvider->models, 'id', 'id');

            /** @var ActiveQuery $query */
            $query = EventToValidate::find()
                ->andWhere(['id' => $ids]);

            if (self::$countOnly) {
                return [EventToValidate::className() => $query->asArray()->count()];
            }

            return $query->all();
        }

        return [];
    }

    /**
     * @param bool $enableOrder
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    private function getOrganizationsToValidate($enableOrder)
    {
        if (Yii::$app->hasModule('organizations')) {
            $modelSearch = new OrganizationsToValidate();
            $dataProvider = $modelSearch
                ->searchToValidateOrganizations(
                    $this->queryParams,
                    null,
                    false,
                    self::$countOnly
                );

            if (!$enableOrder) {
                $dataProvider->sort = false;
            }

            $ids = ArrayHelper::map($dataProvider->models, 'id', 'id');

            /** @var ActiveQuery $query */
            $query = OrganizationsToValidate::find()
                ->andWhere(['id' => $ids]);

            if (self::$countOnly) {
                return [OrganizationsToValidate::className() => $query->asArray()->count()];
            }

            return $query->all();
        }

        return [];
    }

    /**
     * @return array|RequestToJoinOrganizzazioniForReferees[]
     * @throws \arter\amos\core\exceptions\AmosException
     * @throws \yii\base\InvalidConfigException
     */
    private function getRequestToJoinOrganizzazioniForReferees()
    {
        $organizzazioniModule = Yii::$app->getModule('organizzazioni');
        /** @var \arter\amos\organizzazioni\Module $organizzazioniModule */
        if (!is_null($organizzazioniModule)
            && $organizzazioniModule->hasProperty('enableConfirmUsersJoinRequests')
            && $organizzazioniModule->enableConfirmUsersJoinRequests
        ) {
            $organizationsIds = $organizzazioniModule
                ->getOrganizationsRepresentedOrReferredByUserId($this->user_id, true);

            /** @var UserProfile $userProfileModel */
            $userProfileModel = AmosAdmin::instance()->createModel('UserProfile');

            $userProfileTable = $userProfileModel::tableName();
            $requestToJoinOrganizzazioniForRefereesTable = RequestToJoinOrganizzazioniForReferees::tableName();

            /** @var ActiveQuery $query */
            $query = RequestToJoinOrganizzazioniForReferees::find()
                ->innerJoin(
                    $userProfileTable,
                    $userProfileTable . '.user_id = ' . $requestToJoinOrganizzazioniForRefereesTable . '.user_id AND '
                    . $userProfileTable . '.deleted_at IS NULL'
                )
                ->andWhere([
                    'profilo_id' => $organizationsIds,
                    $requestToJoinOrganizzazioniForRefereesTable . '.status' => RequestToJoinOrganizzazioniForReferees::STATUS_WAITING_REQUEST_CONFIRM
                ]);

            if (self::$countOnly) {
                return [RequestToJoinOrganizzazioniForReferees::className() => $query->asArray()->count()];
            }

            return $query->all();
        }

        return [];
    }

    /**
     * @return array|RequestToJoinOrganizzazioniSediForReferees[]
     * @throws \arter\amos\core\exceptions\AmosException
     * @throws \yii\base\InvalidConfigException
     */
    private function getRequestToJoinOrganizzazioniSediForReferees()
    {
        $organizzazioniModule = Yii::$app->getModule('organizzazioni');
        /** @var \arter\amos\organizzazioni\Module $organizzazioniModule */
        if (!is_null($organizzazioniModule)
            && $organizzazioniModule->hasProperty('enableConfirmUsersJoinRequests')
            && $organizzazioniModule->enableConfirmUsersJoinRequests
        ) {
            $organizationsIds = $organizzazioniModule
                ->getOrganizationsRepresentedOrReferredByUserId($this->user_id, true);

            /** @var UserProfile $userProfileModel */
            $userProfileModel = AmosAdmin::instance()->createModel('UserProfile');
            /** @var ProfiloSedi $profiloSediModel */
            $profiloSediModel = \arter\amos\organizzazioni\Module::instance()->createModel('ProfiloSedi');

            $userProfileTable = $userProfileModel::tableName();
            $requestToJoinOrganizzazioniSediForRefereesTable = RequestToJoinOrganizzazioniSediForReferees::tableName();

            /** @var ActiveQuery $query */
            $query = RequestToJoinOrganizzazioniSediForReferees::find()
                ->innerJoin($userProfileTable,
                    $userProfileTable . '.user_id = ' . $requestToJoinOrganizzazioniSediForRefereesTable . '.user_id AND '
                    . $userProfileTable . '.deleted_at IS NULL'
                )
                ->innerJoinWith('profiloSedi')
                ->andWhere([
                    $profiloSediModel::tableName() . '.profilo_id' => $organizationsIds,
                    $requestToJoinOrganizzazioniSediForRefereesTable . '.status' => RequestToJoinOrganizzazioniSediForReferees::STATUS_WAITING_REQUEST_CONFIRM
                ]);

            if (self::$countOnly) {
                return [RequestToJoinOrganizzazioniSediForReferees::className() => $query->asArray()->count()];
            }

            return $query->all();
        }

        return [];
    }

    /**
     * @param bool $enableOrder
     * @return array|\yii\db\ActiveRecord[]
     * @throws \yii\base\InvalidConfigException
     */
    private function getEenExpressionOfInterestToTakeover($enableOrder)
    {
        if (Yii::$app->hasModule('een')) {
            $modelSearch = new EenExpressionOfInterestToTakeover();
            $dataProvider = $modelSearch->searchEoiToTakeOver($this->queryParams);
            if (!$enableOrder) {
                $dataProvider->sort = false;
            }
            $ids = ArrayHelper::map($dataProvider->models, 'id', 'id');

            /** @var ActiveQuery $query */
            $query = EenExpressionOfInterestToTakeover::find()
                ->andWhere(['een_expr_of_interest.id' => $ids]);

            if (self::$countOnly) {
                return [EenExpressionOfInterestToTakeover::className() => $query->asArray()->count()];
            }

            return $query->all();
        }

        return [];
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     * @throws \yii\base\InvalidConfigException
     */
    private function getRequestToParticipateCommunityForManager()
    {

        if (Yii::$app->hasModule('community')) {
            $communityModule = Yii::$app->getModule('community');
            $communitiesIds = $communityModule->getCommunitiesManagedByUserId($this->user_id, true);
            if (count($communitiesIds) > 0) {
                /** @var ActiveQuery $query */
                $query = RequestToParticipateCommunityForManager::find()
                    ->innerJoin(
                        UserProfile::tableName(),
                        UserProfile::tableName() . '.user_id = ' . RequestToParticipateCommunityForManager::tableName()
                        . '.user_id and ' . UserProfile::tableName() . '.deleted_at is NULL'
                    )
                    ->andWhere([
                        'community_id' => $communitiesIds,
                        RequestToParticipateCommunityForManager::tableName() . '.status' => \arter\amos\community\models\CommunityUserMm::STATUS_WAITING_OK_COMMUNITY_MANAGER
                    ]);

                if (self::$countOnly) {
                    return [RequestToParticipateCommunityForManager::className() => $query->asArray()->count()];
                }

                return $query->all();
            }
        }

        return [];
    }

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    private function getReportToRead()
    {
        if (Yii::$app->hasModule('report')) {
            $reportMyInterest = [];
            $reportModule = Yii::$app->getModule('report');
            $ids = $reportModule->getOwnUnreadReports()->select('report.id');

            $allReport = ReportToRead::find()
                ->andWhere(['id' => $ids])
                ->andWhere(['read_at' => null])
                ->all();

            foreach ($allReport as $report) {
                if (Yii::$app->hasModule('news') && ($report->classname == \arter\amos\news\models\News::className())) {
                    $model = \arter\amos\news\models\News::find()
                        ->andWhere(['id' => $report->context_id])
                        ->one();

                    if (!empty($model)) {
                        // Check if user logged is creator
                        if ($model->created_by == $this->user_id) {
                            $reportMyInterest[] = $report;
                            continue;
                        }

                        // Check if user logged is facilitator
                        /** @var UserProfile $userProfileReport */
                        $userProfileReport = UserProfile::find()
                            ->andWhere(['user_id' => $model->created_by])
                            ->one();
                        if ($userProfileReport->facilitatore_id == $this->user_id) {
                            $reportMyInterest[] = $report;
                            continue;
                        }

                        // Check if user logged is validator
                        $valUserId = $model
                            ->getStatusLastUpdateUser(\arter\amos\news\models\News::NEWS_WORKFLOW_STATUS_VALIDATO);
                        if (!is_null($valUserId) && ($valUserId == $this->user_id)) {
                            $reportMyInterest[] = $report;
                            continue;
                        }
                    }
                }

                if (Yii::$app->hasModule('discussioni') && ($report->classname == \arter\amos\discussioni\models\DiscussioniTopic::className())) {
                    $model = \arter\amos\discussioni\models\DiscussioniTopic::find()
                        ->andWhere(['id' => $report->context_id])
                        ->one();
                    if (!empty($model)) {
                        // Check if user logged is creator
                        if ($model->created_by == $this->user_id) {
                            $reportMyInterest[] = $report;
                            continue;
                        }

                        // Check if user logged is facilitator
                        /** @var UserProfile $userProfileReport */
                        $userProfileReport = UserProfile::find()
                            ->andWhere(['user_id' => $model->created_by])
                            ->one();
                        if ($userProfileReport->facilitatore_id == $this->user_id) {
                            $reportMyInterest[] = $report;
                            continue;
                        }

                        // Check if user logged is validator
                        $valUserId = $model->getStatusLastUpdateUser(
                            \arter\amos\discussioni\models\DiscussioniTopic::DISCUSSIONI_WORKFLOW_STATUS_ATTIVA
                        );
                        if (!is_null($valUserId) && ($valUserId == $this->user_id)) {
                            $reportMyInterest[] = $report;
                            continue;
                        }
                    }
                }

                if (Yii::$app->hasModule('documenti') && ($report->classname == \arter\amos\documenti\models\Documenti::className())) {
                    $model = \arter\amos\documenti\models\Documenti::find()
                        ->andWhere(['id' => $report->context_id])
                        ->one();
                    if (!empty($model)) {
                        // Check if user logged is creator
                        if ($model->created_by == $this->user_id) {
                            $reportMyInterest[] = $report;
                            continue;
                        }
                        // Check if user logged is facilitator
                        /** @var UserProfile $userProfileReport */
                        $userProfileReport = UserProfile::find()
                            ->andWhere(['user_id' => $model->created_by])
                            ->one();
                        if ($userProfileReport->facilitatore_id == $this->user_id) {
                            $reportMyInterest[] = $report;
                            continue;
                        }

                        // Check if user logged is validator
                        $valUserId = $model
                            ->getStatusLastUpdateUser(\arter\amos\documenti\models\Documenti::DOCUMENTI_WORKFLOW_STATUS_VALIDATO);
                        if (!is_null($valUserId) && ($valUserId == $this->user_id)) {
                            $reportMyInterest[] = $report;
                            continue;
                        }
                    }
                }

                if (Yii::$app->hasModule('community') && ($report->classname == \arter\amos\community\models\Community::className())) {
                    $model = \arter\amos\community\models\Community::find()
                        ->andWhere(['id' => $report->context_id])
                        ->one();
                    if (!empty($model)) {
                        // Check if user logged is creator
                        if ($model->created_by == $this->user_id) {
                            $reportMyInterest[] = $report;
                            continue;
                        }
                        // Check if user logged is facilitator
                        /** @var UserProfile $userProfileReport */
                        $userProfileReport = UserProfile::find()
                            ->andWhere(['user_id' => $model->created_by])
                            ->one();
                        if ($userProfileReport->facilitatore_id == $this->user_id) {
                            $reportMyInterest[] = $report;
                            continue;
                        }
                        // Check if user logged is validator
                        $valUserId = $model
                            ->getStatusLastUpdateUser(\arter\amos\community\models\Community::COMMUNITY_WORKFLOW_STATUS_VALIDATED);
                        if (!is_null($valUserId) && ($valUserId == $this->user_id)) {
                            $reportMyInterest[] = $report;
                            continue;
                        }
                    }
                }
            }

            if (self::$countOnly) {
                return [ReportToRead::className() => count($reportMyInterest)];
            }

            return $reportMyInterest;
        }

        return [];
    }

    /**
     * TODO Not yet terminated
     * @return array
     */
    private function getSurveyToValidate()
    {
        if (Yii::$app->hasModule('sondaggi')) {
            return []; // SurveyToValidate::find()->all();
        }

        return [];
    }

    /**
     * @@param bool $enableOrder
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    private function getShowcaseProjectToValidate($enableOrder)
    {
        if (Yii::$app->hasModule('showcaseprojects')) {
            $modelSearch = new ShowcaseProjectToValidate();
            $dataProvider = $modelSearch->searchToValidateShowcaseProjects($this->queryParams);
            if (!$enableOrder) {
                $dataProvider->sort = false;
            }
            $ids = ArrayHelper::map($dataProvider->models, 'id', 'id');

            /** @var ActiveQuery $query */
            $query = ShowcaseProjectToValidate::find()
                ->andWhere(['id' => $ids]);

            if (self::$countOnly) {
                return [ShowcaseProjectToValidate::className() => $query->asArray()->count()];
            }

            return $query->all();
        }

        return [];
    }

    /**
     * @param bool $enableOrder
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    private function getShowcaseProjectUserToAccept($enableOrder)
    {
        if (Yii::$app->hasModule('showcaseprojects')) {
            $modelSearch = new ShowcaseProjectUserToAccept();
            $query = $modelSearch->searchShowcaseProjectUserToAccept($this->queryParams);

            $ids = ArrayHelper::map($query->all(), 'id', 'id');

            /** @var ActiveQuery $query */
            $query = ShowcaseProjectUserToAccept::find()
                ->andWhere(['id' => $ids]);

            if (self::$countOnly) {
                return [ShowcaseProjectUserToAccept::className() => $query->asArray()->count()];
            }

            return $query->all();
        }

        return [];
    }

    /**
     * @@param bool $enableOrder
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    private function getResultsToValidate($enableOrder)
    {
        if (Yii::$app->hasModule('results')) {
            $modelSearch = new ResultsToValidate();
            $dataProvider = $modelSearch->searchToValidateResults($this->queryParams);
            if (!$enableOrder) {
                $dataProvider->sort = false;
            }
            $ids = ArrayHelper::map($dataProvider->models, 'id', 'id');

            /** @var ActiveQuery $query */
            $query = ResultsToValidate::find()
                ->andWhere(['id' => $ids]);

            if (self::$countOnly) {
                return [ResultsToValidate::className() => $query->asArray()->count()];
            }

            return $query->all();
        }

        return [];
    }

    /**
     * @@param bool $enableOrder
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    private function getProposalResultsToValidate($enableOrder)
    {
        if (Yii::$app->hasModule('results')) {
            $modelSearch = new ResultsProposalToValidate();
            $dataProvider = $modelSearch->searchToValidateResultProposals($this->queryParams);
            if (!$enableOrder) {
                $dataProvider->sort = false;
            }
            $ids = ArrayHelper::map($dataProvider->models, 'id', 'id');

            /** @var ActiveQuery $query */
            $query = ResultsProposalToValidate::find()
                ->andWhere(['id' => $ids]);

            if (self::$countOnly) {
                return [ResultsProposalToValidate::className() => $query->asArray()->count()];
            }

            return $query->all();
        }

        return [];
    }

    /**
     * @@param bool $enableOrder
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    private function getPartnershipProfilesToValidate($enableOrder)
    {
        if (Yii::$app->hasModule('partnershipprofiles')) {
            $modelSearch = new PartnershipProfileToValidate();
            $dataProvider = $modelSearch->searchForFacilitator($this->queryParams);
            $dataProvider->query->andWhere(['status' => PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_TOVALIDATE]);
            if (!$enableOrder) {
                $dataProvider->sort = false;
            }
            $ids = ArrayHelper::map($dataProvider->models, 'id', 'id');

            /** @var ActiveQuery $query */
            $query = PartnershipProfileToValidate::find()
                ->andWhere(['id' => $ids]);

            if (self::$countOnly) {
                return [PartnershipProfileToValidate::className() => $query->asArray()->count()];
            }
            return $query->all();
        }

        return [];
    }

    /**
     * TODO Not yet terminated
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    private function getExpressionOfInterestToEvaluate()
    {
        if (Yii::$app->hasModule('partnershipprofiles')) {
            $modelSearch = new ExpressionOfInterestToEvaluate();
            $dataProvider = $modelSearch->searchForFacilitator($this->queryParams);
            $ids = ArrayHelper::map($dataProvider->models, 'id', 'id');

            /** @var ActiveQuery $query */
            $query = ExpressionOfInterestToEvaluate::find()
                ->andWhere(['id' => $ids]);

            if (self::$countOnly) {
                return [ExpressionOfInterestToEvaluate::className() => $query->asArray()->count()];
            }

            return $query->all();
        }

        return [];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return AmosMyActivities::t('amosmyactivities', 'My activities');
    }
}
