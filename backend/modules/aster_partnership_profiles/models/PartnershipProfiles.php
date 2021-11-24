<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_partnership_profiles\models;

use backend\modules\aster_partnership_profiles\events\PartnershipProfilesWorkflowEvent;
use arter\amos\admin\AmosAdmin;
use arter\amos\community\AmosCommunity;
use arter\amos\community\exceptions\CommunityException;
use arter\amos\community\models\CommunityContextInterface;
use arter\amos\community\models\CommunityType;
use arter\amos\community\models\CommunityUserMm;
use arter\amos\core\interfaces\OrganizationsModuleInterface;
use arter\amos\core\user\User;
use arter\amos\cwh\models\CwhConfigContents;
use arter\amos\cwh\models\CwhPubblicazioni;
use arter\amos\notificationmanager\models\ChangeStatusEmail;
use arter\amos\partnershipprofiles\Module;
use yii\helpers\ArrayHelper;
use yii\log\Logger;

/**
 * Class PartnershipProfiles
 * This is the model class for table "partnership_profiles".
 *
 * @method \cornernote\workflow\manager\components\WorkflowDbSource getWorkflowSource()
 * @method bool hasWorkflowStatus()
 * @method NULL|\raoul2000\workflow\base\Status getWorkflowStatus()
 * @method \yii\db\ActiveQuery hasOneFile($attribute = 'file', $sort = 'id')
 * @method \yii\db\ActiveQuery hasMultipleFiles($attribute = 'file', $sort = 'id')
 * @method string|null getRegolaPubblicazione()
 * @method array getTargets()
 *
 * @property string $partnershipProfileTypesString
 * @property string $expiredDate
 * @property int $facilitatoreUserProfileId
 *
 * @package arter\amos\partnershipprofiles\models
 */
class PartnershipProfiles extends \arter\amos\partnershipprofiles\models\PartnershipProfiles implements CommunityContextInterface {

    public $create_community_box;

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        $this->on('afterChangeStatusFrom{' . PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_DRAFT . '}to{' . PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_TOVALIDATE . '}',
                [new PartnershipProfilesWorkflowEvent(), 'sendEmailtoMentorOfEroe'],
                $this);
        $this->on('afterChangeStatusFrom{' . PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_TOVALIDATE . '}to{' . PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED . '}',
                [new PartnershipProfilesWorkflowEvent(), 'sendEmailIToMentorSfide'],
                $this);
        $this->on('afterChangeStatusFrom{' . PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_DRAFT . '}to{' . PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED . '}',
                [new PartnershipProfilesWorkflowEvent(), 'sendEmailIToMentorSfide'],
                $this);
//        $this->on('afterChangeStatusFrom{' . PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_TOVALIDATE . '}to{' . PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED . '}',
//                [new PartnershipProfilesWorkflowEvent(), 'sendEmailIToCMSfide'],
//                $this);
        $this->on('afterChangeStatusFrom{' . PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_DRAFT . '}to{' . PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED . '}',
                [new PartnershipProfilesWorkflowEvent(), 'sendEmailIToCMSfide'],
                $this);
        $this->on('afterChangeStatusFrom{' . PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_TOVALIDATE . '}to{' . PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED . '}',
                [new PartnershipProfilesWorkflowEvent(), 'sendEmailIToAnimatorSfide'],
                $this);
        $this->on('afterChangeStatusFrom{' . PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_DRAFT . '}to{' . PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED . '}',
                [new PartnershipProfilesWorkflowEvent(), 'sendEmailIToAnimatorSfide'],
                $this);
        $this->on('afterChangeStatusFrom{' . PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_DRAFT . '}to{' . PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_TOVALIDATE . '}',
                [new PartnershipProfilesWorkflowEvent(), 'sendEmailIToCMSfideToValidate'],
                $this);

        $this->setMailStatusesInit();
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        parent::afterFind();
        $this->setMailStatusesAfterFind();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['partnership_profile_facilitator_id'], 'required', 'when' => function ($model) {
                /** @var PartnershipProfiles $model */
                $isRequired = in_array($model->status, [
                    self::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED,
                    self::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_FEEDBACKRECEIVED
                ]);
                if ($isRequired && !$this->partnership_profile_facilitator_id) {
                    \Yii::$app->getSession()->addFlash('danger', Module::tHtml('amospartnershipprofiles', '#animator_required_error'));
                }
                return $isRequired;
            }],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return ArrayHelper::merge(parent::attributeLabels(), [
                    'create_community_box' => Module::t('amospartnershipprofiles', 'Crea Gruppo'),
                        ]
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersAnimationMms() {
        return $this->hasMany(UsersAnimationMm::className(), ['partnership_profile_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers() {
        return $this->hasMany(\arter\amos\core\user\User::className(), ['id' => 'user_id'])->via('usersAnimationMms');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActiveExpressionsOfInterestByUser($user_id) {
        return $this->hasOne(\arter\amos\partnershipprofiles\models\ExpressionsOfInterest::className(), ['partnership_profile_id' => 'id'])
                        ->andWhere([\arter\amos\partnershipprofiles\models\ExpressionsOfInterest::tableName() . '.status' => \arter\amos\partnershipprofiles\models\ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_ACTIVE])
                        ->andWhere([\arter\amos\partnershipprofiles\models\ExpressionsOfInterest::tableName() . '.created_by' => $user_id]);
    }

    /**
     * @param PartnershipProfiles $model
     * @param int[] $selectedUserIds
     * @return bool
     */
    public static function createAnimationCommunity($model, $selectedUserIds = []) {
        /** @var AmosCommunity $communityModule */
        $communityModule = \Yii::$app->getModule('community');
        $title = $model->title;
        $type = CommunityType::COMMUNITY_TYPE_CLOSED;
        $context = PartnershipProfiles::className();
        $managerRole = CommunityUserMm::ROLE_COMMUNITY_MANAGER;
        $description = $model->short_description;
        $managerStatus = CommunityUserMm::STATUS_ACTIVE;
        try {
            $model->sfide_community_id = $communityModule->createCommunity($title, $type, $context, $managerRole, $description, $model, $managerStatus);
            $ok = $model->save(false);
            if (!is_null($model->sfide_community_id)) {
//                $ok = PartnershipProfilesUtility::duplicatePartnershipProfilesTagForCommunity($model);
            }
        } catch (CommunityException $exception) {
            \Yii::getLogger()->log($exception->getMessage(), Logger::LEVEL_ERROR);
            $ok = false;
        }

        return $ok;
    }

    /**
     * @inheritdoc
     */
    public function getManagerRole() {
        return CommunityUserMm::ROLE_COMMUNITY_MANAGER;
    }

    /**
     * @inheritdoc
     */
    public function getContextRoles() {
        $roles = [
            CommunityUserMm::ROLE_COMMUNITY_MANAGER,
            CommunityUserMm::ROLE_PARTICIPANT
        ];
        return $roles;
    }

    /**
     * @inheritdoc
     */
    public function getBaseRole() {
        return CommunityUserMm::ROLE_PARTICIPANT;
    }

    /**
     * @inheritdoc
     */
    public function getRolePermissions($role) {
        switch ($role) {
            case CommunityUserMm::ROLE_PARTICIPANT:
                return ['CWH_PERMISSION_CREATE'];
                break;
            case CommunityUserMm::ROLE_COMMUNITY_MANAGER:
                return ['CWH_PERMISSION_CREATE', 'CWH_PERMISSION_VALIDATE'];
                break;
            default:
                return ['CWH_PERMISSION_CREATE'];
                break;
        }
    }

    /**
     * @inheritdoc
     */
    public function getPluginModule() {
        return 'partnershipprofiles';
    }

    /**
     * @inheritdoc
     */
    public function getPluginController() {
        return 'partnership-profiles';
    }

    /**
     * @inheritdoc
     */
    public function getCommunityModel() {
        return $this->community;
    }

    /**
     * @inheritdoc
     */
    public function getNextRole($role) {
        switch ($role) {
            case CommunityUserMm::ROLE_PARTICIPANT:
                return CommunityUserMm::ROLE_PARTICIPANT;
                break;
            case CommunityUserMm::ROLE_COMMUNITY_MANAGER:
                return CommunityUserMm::ROLE_COMMUNITY_MANAGER;
                break;
            default:
                return CommunityUserMm::ROLE_PARTICIPANT;
                break;
        }
    }

    /**
     * @inheritdoc
     */
    public function getRedirectAction() {
        return 'view';
    }

    public function getAdditionalAssociationTargetQuery($communityId) {
        
    }

    /**
     * @inheritdoc
     */
    public function getValidatorUsersId() {
        try {
            $authManager = \Yii::$app->authManager;
            $facilitators = $authManager->getUserIdsByRoleDirectlyAssigned('CM_SFIDE');
        } catch (\Exception $ex) {
            \Yii::getLogger()->log($ex->getMessage(), \yii\log\Logger::LEVEL_ERROR);
        }
        return $facilitators;
    }

    
    /**
     * @param $attribute
     * @param $params
     * @param $validator
     * @return bool
     */
    public function validateFacilitator($attribute, $params, $validator)
    {
        if (($this->status == self::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_DRAFT) || $this->isNewRecord) {
            return true;
        }

        $allOk = false;
        $cwhConfigContents = CwhConfigContents::findOne(['tablename' => \arter\amos\partnershipprofiles\models\PartnershipProfiles::tableName()]);
        $pubblicazione = CwhPubblicazioni::findOne(['content_id' => $this->id, 'cwh_config_contents_id' => $cwhConfigContents->id]);
        $cwhPubblicazioniCwhNodiValidatoriMms = $pubblicazione->cwhPubblicazioniCwhNodiValidatoriMms;

        foreach ($cwhPubblicazioniCwhNodiValidatoriMms as $cwhPubblicazioniCwhNodiValidatoriMm) {
            /** @var \arter\amos\cwh\models\CwhPubblicazioniCwhNodiValidatoriMm $cwhPubblicazioniCwhNodiValidatoriMm */
            $cwhConfig = $cwhPubblicazioniCwhNodiValidatoriMm->cwhConfig;

            /** @var AmosAdmin $adminModule */
            $adminModule = \Yii::$app->getModule('admin');
            $organizationsModuleName = $adminModule->getOrganizationModuleName();
            $organizzazioniModule = \Yii::$app->getModule($organizationsModuleName);

            $classNames = [
                "common\models\User",
                User::className()
            ];
            if (!is_null($organizzazioniModule)) {
                /** @var OrganizationsModuleInterface $organizzazioniModule */
                $classNames[] = $organizzazioniModule->getOrganizationModelClass();
            }

            $communityModule = \Yii::$app->getModule('community');

            if (in_array($cwhConfig->classname, $classNames)) {
               // $allPlatformFacilitatorIds = UserProfileUtility::getAllFacilitatorUserIds();
                $authManager = \Yii::$app->authManager;
                $allPlatformFacilitatorIds = $authManager->getUserIdsByRoleDirectlyAssigned('PARTNER_PROF_EXPR_OF_INT_ADMIN_FACILITATOR');
                if (in_array($this->partnership_profile_facilitator_id, $allPlatformFacilitatorIds)) {
                    $allOk = true;
                }
            } elseif (!is_null($communityModule)) {
                /** @var \arter\amos\community\AmosCommunity $communityModule */
                if ($cwhConfig->classname == \arter\amos\community\models\Community::className()) {
                    $community = \arter\amos\community\models\Community::findOne($cwhPubblicazioniCwhNodiValidatoriMm->cwh_network_id);
                    if (!is_null($community)) {
                        $communityManagers = $community->communityManagers;
                        foreach ($communityManagers as $communityManager) {
                            /** @var User $communityManager */
                            if ($communityManager->id == $this->partnershipProfileFacilitator->user_id) {
                                $allOk = true;
                            }
                        }
                    }
                }
            }
        }

        if (!$allOk) {
            $this->addError($attribute, Module::t('amospartnershipprofiles', 'Facilitator not valid'));
        }

        return $allOk;
    }

    public function setMailStatusesInit()
    {
        $mailStatuses = [];
        $toapprovedMail = new ChangeStatusEmail();
        $toapprovedMail->template = '@backend/modules/aster_partnership_profiles/views/partnership-profiles/partnershipprofile-to-validated-cm';
        $toapprovedMail->toCreator = false;
        $toapprovedMail->toValidator = true;
        $toapprovedMail->subject = Module::t('amospartnershipprofiles', '#partnershipprofile_to_validate_cm_mail_subject'); //Proposta di pubblicazione della scheda informativa di un nuovo progetto
        $toapprovedMail->startStatus = self::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_DRAFT;
        $mailStatuses[self::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_TOVALIDATE] = $toapprovedMail;
        $this->mailStatuses = $mailStatuses;
    }

    public function setMailStatusesAfterFind()
    {
        $mailStatuses = [];
        $approvedMail = new ChangeStatusEmail();
        $approvedMail->template = '@backend/modules/aster_partnership_profiles/views/partnership-profiles/partnershipprofile-validated-cm';
        $approvedMail->toCreator = false;
        $approvedMail->toValidator = false;
        $approvedMail->subject = Module::t('amospartnershipprofiles', '#partnershipprofile_validated_cm_mail_subject', ['sfida' => $this->getTitle()]); //Proposta di pubblicazione della sfida
        $approvedMail->startStatus = self::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_TOVALIDATE;
        $mailStatuses[self::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED] = $approvedMail;
        $this->mailStatuses = $mailStatuses;
    }
}
