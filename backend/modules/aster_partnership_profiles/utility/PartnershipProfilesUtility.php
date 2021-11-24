<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles\utility
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_partnership_profiles\utility;

use backend\modules\aster_admin\models\UserProfile;
use backend\modules\aster_partnership_profiles\models\PartnershipProfiles;
use backend\modules\aster_partnership_profiles\models\UsersAnimationMm;
use arter\amos\admin\models\UserContact;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\user\User;
use arter\amos\core\utilities\Email;
use arter\amos\invitations\models\Invitation;
use arter\amos\partnershipprofiles\Module;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\web\ForbiddenHttpException;

class PartnershipProfilesUtility extends \arter\amos\partnershipprofiles\utility\PartnershipProfilesUtility {

    /**
     * Return true if the logged user is plugin administrator or TMB
     * @return bool
     */
    public static function loggedUserIsAnimationOrCM() {
        if (\Yii::$app instanceof \yii\console\Application) {
            return true;
        }
        return (\Yii::$app->user->can('CM_SFIDE') || \Yii::$app->user->can('PARTNERSHIP_PROFILES_FACILITATOR'));
    }

    public static function renderViewAnimationTab($model) {

        $renderTab = (!is_null($model->partnershipProfileFacilitator) && ($model->partnershipProfileFacilitator->user_id == \Yii::$app->user->id)) && (\Yii::$app->user->can('CM_SFIDE') || \Yii::$app->user->can('PARTNERSHIP_PROFILES_FACILITATOR')) && (in_array($model->status, [
                    PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED,
                    PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_FEEDBACKRECEIVED
                ]));

        return $renderTab;
    }

    /**
     * @param PartnershipProfiles $model
     * @return bool
     */
    public static function canView($model) {
        $loggedUserId = \Yii::$app->user->id;

        // Check if logged user is the partnership profile creator
        if ($model->created_by == $loggedUserId) {
            return true;
        }

        // Check if logged user is the partnership profile facilitator
        $eroeCreate = \backend\modules\aster_admin\models\UserProfile::find()
                        ->andWhere(['user_id' => $model->created_by])->one();
        $facilitatoreEroe = $eroeCreate->facilitatore;

        if ((!is_null($model->partnershipProfileFacilitator) && ($model->partnershipProfileFacilitator->user_id == $loggedUserId)) || (!is_null($facilitatoreEroe) && $facilitatoreEroe->user_id == $loggedUserId)) {

            return true;
        }

        // Check if logged user have role "PARTNERSHIP_PROFILES_VALIDATOR"
        if (\Yii::$app->user->can('PARTNERSHIP_PROFILES_VALIDATOR', ['model' => $model]) ||
                \Yii::$app->user->can('CM_SFIDE')) {
            return true;
        }

        if (!(
                ($model->status == PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_DRAFT) ||
                ($model->status == PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_TOVALIDATE))
        ) {
            return true;
        }

        return false;
    }

    /**
     * Return all PartnershipProfiles tags
     * @return array
     */
    public static function getTagsPartnershipProfiles($partnership_profile_id) {
        $listTagId = [];
        $listTagId = PartnershipProfiles::find()->select('t.id')
                        ->innerJoin('entitys_tags_mm e_tag', "e_tag.record_id=" . PartnershipProfiles::tableName() . ".id AND e_tag.deleted_at IS NULL AND e_tag.classname='" . addslashes(PartnershipProfiles::className()) . "'")
                        ->innerJoin('tag t', "e_tag.tag_id=t.id")
                        ->andWhere([PartnershipProfiles::tableName() . ".id" => $partnership_profile_id])
                        ->asArray()->column();

        return $listTagId;
    }

    /**
     *
     * @param type $user_id
     * @return type
     */
    public static function getQueryTagUserMatchSfida($model) {

        $tagsSfida = self::getTagsPartnershipProfiles($model->partnership_profile_id);
        $query = UserProfile::find()
                ->select('count(tag.id) as num_tag')
                ->innerJoin('cwh_tag_owner_interest_mm', 'record_id = user_profile.id')
                ->innerJoin('tag', 'tag.id = cwh_tag_owner_interest_mm.tag_id')
                ->andWhere(['cwh_tag_owner_interest_mm.classname' => UserProfile::className()])
                ->andWhere(['cwh_tag_owner_interest_mm.interest_classname' => 'simple-choice']);
        if (!empty($tagsSfida)) {
            $query->andWhere(['in', 'tag_id', $tagsSfida]);
        }

        $query->andWhere(['cwh_tag_owner_interest_mm.deleted_at' => null])
                ->andWhere(['user_profile.user_id' => $model->user_id]);

        return $query;
    }

    /**
     *
     * @param type $tagsPartnershipProfiles
     * @return type
     */
    public static function getTagUserNotMatchSfida($tagsPartnershipProfiles) {

        $query = UserProfile::find()
                ->select('user_profile.user_id')
                ->innerJoin('cwh_tag_owner_interest_mm', 'record_id = user_profile.id')
                ->innerJoin('tag', 'tag.id = cwh_tag_owner_interest_mm.tag_id')
                ->andWhere(['cwh_tag_owner_interest_mm.classname' => UserProfile::className()])
                ->andWhere(['cwh_tag_owner_interest_mm.interest_classname' => 'simple-choice']);

        if (!empty($tagsPartnershipProfiles)) {
            $query->andWhere(['not in', 'tag_id', $tagsPartnershipProfiles]);
        }

        $query->andWhere(['cwh_tag_owner_interest_mm.deleted_at' => null]);


        return $query;
    }

    /**
     *
     * @param type $tagsPartnershipProfiles
     * @return type
     */
    public static function getTagUserMatchSfida($tagsPartnershipProfiles) {

        $query = UserProfile::find()
                ->select('user_profile.user_id')
                ->innerJoin('cwh_tag_owner_interest_mm', 'cwh_tag_owner_interest_mm.record_id = user_profile.id')
                ->innerJoin('tag', 'tag.id = cwh_tag_owner_interest_mm.tag_id')
                ->andWhere(['cwh_tag_owner_interest_mm.classname' => UserProfile::className()])
                ->andWhere(['cwh_tag_owner_interest_mm.interest_classname' => 'simple-choice']);
        if (!empty($tagsPartnershipProfiles)) {
            $query->andWhere(['in', 'cwh_tag_owner_interest_mm.tag_id', $tagsPartnershipProfiles]);
        }

        $query->andWhere(['cwh_tag_owner_interest_mm.deleted_at' => null]);
        $query->groupBy('user_profile.user_id');

        return $query;
    }

    /**
     *
     * @param type $model
     * @param type $withoutTags
     * @param type $keyword
     * @return type
     */
    public static function getQueryToAssociateUsersTags($model, $withoutTags, $keyword) {
        $subquerytot = User::find()
                ->andWhere(['not in', 'id', $model->getUsers()->select('id')]);

        if ($withoutTags) {

            $subQuery = self::getTagUserMatchSfida(self::getTagsPartnershipProfiles($model->id));
            $subQuery->andWhere(['<>', UserProfile::tableName() . '.nome', \arter\amos\admin\utility\UserProfileUtility::DELETED_ACCOUNT_NAME]);
            if (!empty($keyword)) {
                //$query->innerJoinWith('userProfile');

                $subQuery->andFilterWhere(['or',
                    ['like', UserProfile::tableName() . '.cognome', $keyword],
                    ['like', UserProfile::tableName() . '.nome', $keyword],
                    ['like', "CONCAT( " . UserProfile::tableName() . ".nome , ' ', " . UserProfile::tableName() . ".cognome )", $keyword],
                    ['like', "CONCAT( " . UserProfile::tableName() . ".cognome , ' ', " . UserProfile::tableName() . ".nome )", $keyword],
                    ['like', UserProfile::tableName() . '.codice_fiscale', $keyword],
                    ['like', UserProfile::tableName() . '.domicilio_indirizzo', $keyword],
                    ['like', UserProfile::tableName() . '.indirizzo_residenza', $keyword],
                    ['like', UserProfile::tableName() . '.domicilio_localita', $keyword],
                    ['like', UserProfile::tableName() . '.domicilio_cap', $keyword],
                    ['like', UserProfile::tableName() . '.cap_residenza', $keyword],
                    ['like', UserProfile::tableName() . '.numero_civico_residenza', $keyword],
                    ['like', UserProfile::tableName() . '.domicilio_civico', $keyword],
                    ['like', UserProfile::tableName() . '.telefono', $keyword],
                    ['like', UserProfile::tableName() . '.cellulare', $keyword],
                    ['like', UserProfile::tableName() . '.email_pec', $keyword],
                    ['like', UserProfile::tableName() . '.presentazione_breve', $keyword],
                    ['like', UserProfile::tableName() . '.presentazione_personale', $keyword],
                    ['like', UserProfile::tableName() . '.user_profile_role_other', $keyword],
                ]);
            }

            $subquerytot->innerJoin(['`userstags`' => $subQuery], '`userstags`.`user_id` = `user`.`id`');
            $query = User::find()
                    ->innerJoin('user_profile', 'user_profile.user_id = user.id');
            if (!empty($keyword)) {
                $query->andFilterWhere(['or',
                    ['like', UserProfile::tableName() . '.cognome', $keyword],
                    ['like', UserProfile::tableName() . '.nome', $keyword],
                    ['like', "CONCAT( " . UserProfile::tableName() . ".nome , ' ', " . UserProfile::tableName() . ".cognome )", $keyword],
                    ['like', "CONCAT( " . UserProfile::tableName() . ".cognome , ' ', " . UserProfile::tableName() . ".nome )", $keyword],
                    ['like', UserProfile::tableName() . '.codice_fiscale', $keyword],
                    ['like', UserProfile::tableName() . '.domicilio_indirizzo', $keyword],
                    ['like', UserProfile::tableName() . '.indirizzo_residenza', $keyword],
                    ['like', UserProfile::tableName() . '.domicilio_localita', $keyword],
                    ['like', UserProfile::tableName() . '.domicilio_cap', $keyword],
                    ['like', UserProfile::tableName() . '.cap_residenza', $keyword],
                    ['like', UserProfile::tableName() . '.numero_civico_residenza', $keyword],
                    ['like', UserProfile::tableName() . '.domicilio_civico', $keyword],
                    ['like', UserProfile::tableName() . '.telefono', $keyword],
                    ['like', UserProfile::tableName() . '.cellulare', $keyword],
                    ['like', UserProfile::tableName() . '.email_pec', $keyword],
                    ['like', UserProfile::tableName() . '.presentazione_breve', $keyword],
                    ['like', UserProfile::tableName() . '.presentazione_personale', $keyword],
                    ['like', UserProfile::tableName() . '.user_profile_role_other', $keyword],]);
            }
            $query->andWhere(['<>', UserProfile::tableName() . '.nome', \arter\amos\admin\utility\UserProfileUtility::DELETED_ACCOUNT_NAME])
                    ->andWhere(['not in', 'user.id', $subquerytot->asArray()->column()])
                    ->andWhere(['not in', 'user.id', $model->getUsers()->select('id')]);
        } else {
            $subQuery = self::getTagUserMatchSfida(self::getTagsPartnershipProfiles($model->id));
            $subQuery->andWhere(['<>', UserProfile::tableName() . '.nome', \arter\amos\admin\utility\UserProfileUtility::DELETED_ACCOUNT_NAME]);
            if (!empty($keyword)) {
                //$query->innerJoinWith('userProfile');

                $subQuery->andFilterWhere(['or',
                    ['like', UserProfile::tableName() . '.cognome', $keyword],
                    ['like', UserProfile::tableName() . '.nome', $keyword],
                    ['like', "CONCAT( " . UserProfile::tableName() . ".nome , ' ', " . UserProfile::tableName() . ".cognome )", $keyword],
                    ['like', "CONCAT( " . UserProfile::tableName() . ".cognome , ' ', " . UserProfile::tableName() . ".nome )", $keyword],
                    ['like', UserProfile::tableName() . '.codice_fiscale', $keyword],
                    ['like', UserProfile::tableName() . '.domicilio_indirizzo', $keyword],
                    ['like', UserProfile::tableName() . '.indirizzo_residenza', $keyword],
                    ['like', UserProfile::tableName() . '.domicilio_localita', $keyword],
                    ['like', UserProfile::tableName() . '.domicilio_cap', $keyword],
                    ['like', UserProfile::tableName() . '.cap_residenza', $keyword],
                    ['like', UserProfile::tableName() . '.numero_civico_residenza', $keyword],
                    ['like', UserProfile::tableName() . '.domicilio_civico', $keyword],
                    ['like', UserProfile::tableName() . '.telefono', $keyword],
                    ['like', UserProfile::tableName() . '.cellulare', $keyword],
                    ['like', UserProfile::tableName() . '.email_pec', $keyword],
                    ['like', UserProfile::tableName() . '.presentazione_breve', $keyword],
                    ['like', UserProfile::tableName() . '.presentazione_personale', $keyword],
                    ['like', UserProfile::tableName() . '.user_profile_role_other', $keyword],
                    ['like', 'tag.nome', $keyword]
                ]);
            }

            $subquerytot->innerJoin(['`userstags`' => $subQuery], '`userstags`.`user_id` = `user`.`id`');
            $query = User::find()
                    ->andWhere(['in', 'user.id', $subquerytot->asArray()->column()]);
        }

        return $query;
    }

    public static function initInvitation($contextModelId) {
        /** @var ActiveQuery $query */
        $query = Invitation::find();
        $query->select('user.id as userid');
        $query->innerJoinWith('invitationUser');
        $query->innerJoin('user', 'user.email = invitation_user.email');
        $query->andWhere(['=', 'context_model_id', $contextModelId]);
        $query->andWhere(['=', 'module_name', 'partnershipprofiles']);

        $invitationsComplete = $query->asArray()->all();

        foreach ($invitationsComplete as $invitation) {

            $usersAnimationMmExist = new \yii\db\Query();
            $usersAnimationMmExist->select('*');
            $usersAnimationMmExist->from(UsersAnimationMm::tableName())
                    ->andWhere(['user_id' => $invitation['userid']])
                    ->andWhere(['partnership_profile_id' => $contextModelId])
                    ->all();
            $dataProvider = new ActiveDataProvider([
                'query' => $usersAnimationMmExist
            ]);

            if ($dataProvider->totalCount == 0) {

                $usersAnimationMm = new UsersAnimationMm();
                $usersAnimationMm->user_id = $invitation['userid'];
                $usersAnimationMm->partnership_profile_id = $contextModelId;

                $usersAnimationMm->save(false);
            }
        }
    }

    /**
     *
     * SELECT * FROM `expressions_of_interest` WHERE (`expressions_of_interest`.`deleted_at` IS NULL) AND (`expressions_of_interest`.`status`='ExpressionsOfInterestWorkflow/ACTIVE') AND (`expressions_of_interest`.`created_by`=610) AND (`partnership_profile_id`=52)
     * @param type $interested
     * @return type
     */
        public static function getQueryToListUserAnimation($model, $interested, $params) {
        if ($interested) {

            $subQuery = self::getTagUserMatchSfida(self::getTagsPartnershipProfiles($model->id));

            $subQuery1 = self::getTagsPartnershipProfiles($model->id);

            $query1 = UsersAnimationMm::find()
                    ->select(['users_animation_mm.id, users_animation_mm.partnership_profile_id, `users_animation_mm`.user_id, `users_animation_mm`.select_keyword , `users_animation_mm`.number_msg, `users_animation_mm`.`created_at`,  user_profile.cognome as name, count(tag.id) as num_tag,  max(`expressions_of_interest`.`id`) as solution_sent'])
                    ->innerJoin('user_profile', 'user_profile.user_id = users_animation_mm.user_id')
                    ->innerJoin('cwh_tag_owner_interest_mm', 'record_id = user_profile.id')
                    ->innerJoin('tag', 'tag.id = cwh_tag_owner_interest_mm.tag_id')
                    ->leftJoin('`expressions_of_interest`', 'expressions_of_interest.partnership_profile_id = users_animation_mm.partnership_profile_id')
                    ->andWhere(['cwh_tag_owner_interest_mm.classname' => UserProfile::className()])
                    ->andWhere(['cwh_tag_owner_interest_mm.interest_classname' => 'simple-choice'])
                    ->andWhere(['cwh_tag_owner_interest_mm.deleted_at' => null])
                    ->andWhere(['`expressions_of_interest`.`deleted_at`' => null])
                    ->andWhere(['<>', '`expressions_of_interest`.`status`', 'ExpressionsOfInterestWorkflow/DRAFT'])
                    ->andWhere('expressions_of_interest.created_by = users_animation_mm.user_id')
                    ->andWhere(['`expressions_of_interest`.`partnership_profile_id`' => $model->id])
                    ->andWhere(['in', 'tag.id', $subQuery1])
                    ->andWhere(['`users_animation_mm`.partnership_profile_id' => $model->id])
                    ->andWhere(['in', 'users_animation_mm.user_id', $subQuery->asArray()->column()])
					->andWhere(['user_profile.deleted_at' => null])
					->andWhere(['cwh_tag_owner_interest_mm.deleted_at' => null])
					->andWhere(['tag.deleted_at' => null])
                    ->groupBy('users_animation_mm.user_id');

            if (!empty($params)) {

                $query1->andFilterWhere(['or',
                    ['like', UserProfile::tableName() . '.cognome', $params],
                    ['like', UserProfile::tableName() . '.nome', $params],
                    ['like', 'users_animation_mm.select_keyword', $params],
                ]);
            }
            $query2 = UsersAnimationMm::find()
                    ->select(['`users_animation_mm`.`id`, `users_animation_mm`.`partnership_profile_id`, `users_animation_mm`.`user_id`, `users_animation_mm`.`select_keyword` , `users_animation_mm`.`number_msg`, `users_animation_mm`.`created_at`, `user_profile`.`cognome` as name, count(distinct(`tag`.`id`)) as num_tag, null as `solution_sent`'])
                    ->innerJoin('user_profile', 'user_profile.user_id = users_animation_mm.user_id')
                    ->innerJoin('cwh_tag_owner_interest_mm', 'record_id = user_profile.id')
                    ->innerJoin('tag', 'tag.id = cwh_tag_owner_interest_mm.tag_id')
                    ->leftJoin('`expressions_of_interest`', 'expressions_of_interest.partnership_profile_id = users_animation_mm.partnership_profile_id')
                    ->andWhere(['cwh_tag_owner_interest_mm.classname' => UserProfile::className()])
                    ->andWhere(['cwh_tag_owner_interest_mm.interest_classname' => 'simple-choice'])
                    ->andWhere(['cwh_tag_owner_interest_mm.deleted_at' => null])
                    ->andWhere(['in', 'tag.id', $subQuery1])
                    ->andWhere(['`users_animation_mm`.partnership_profile_id' => $model->id])
                    ->andWhere(['in', 'users_animation_mm.user_id', $subQuery->asArray()->column()])
					->andWhere(['user_profile.deleted_at' => null])
					->andWhere(['cwh_tag_owner_interest_mm.deleted_at' => null])
					->andWhere(['tag.deleted_at' => null])
                    ->groupBy('users_animation_mm.user_id');

            if (!empty($params)) {

                $query2->andFilterWhere(['or',
                    ['like', UserProfile::tableName() . '.cognome', $params],
                    ['like', UserProfile::tableName() . '.nome', $params],
                    ['like', 'users_animation_mm.select_keyword', $params],
                ]);
            }
            $query = $query1->union($query2);
        } else {
//            SUM(IF( expressions_of_interest.status = "ExpressionsOfInterestWorkflow//ACTIVE",1,0))
            $subQuery = self::getTagUserMatchSfida(self::getTagsPartnershipProfiles($model->id));
            $query1 = UsersAnimationMm::find()
                    ->select(['`users_animation_mm`.id, `users_animation_mm`.partnership_profile_id, `users_animation_mm`.user_id, `users_animation_mm`.select_keyword , `users_animation_mm`.number_msg , `users_animation_mm`.`created_at`, max(`expressions_of_interest`.`id`) as solution_sent'])
                    ->innerJoin('user_profile', 'user_profile.user_id = users_animation_mm.user_id')
                    ->leftJoin('`expressions_of_interest`', 'expressions_of_interest.partnership_profile_id = users_animation_mm.partnership_profile_id')
                    ->andWhere(['`expressions_of_interest`.`deleted_at`' => null])
                    ->andWhere(['<>', '`expressions_of_interest`.`status`', 'ExpressionsOfInterestWorkflow/DRAFT'])
                    ->andWhere('expressions_of_interest.created_by = users_animation_mm.user_id')
                    ->andWhere(['or', ['`expressions_of_interest`.`partnership_profile_id`' => $model->id], ['`expressions_of_interest`.`partnership_profile_id`' => null]])
                    ->andWhere(['`users_animation_mm`.partnership_profile_id' => $model->id])
                    ->andWhere(['not in', 'users_animation_mm.user_id', $subQuery->asArray()->column()])
                    ->groupBy('users_animation_mm.user_id');


            if (!empty($params)) {

                $query1->andFilterWhere(['or',
                    ['like', UserProfile::tableName() . '.cognome', $params],
                    ['like', UserProfile::tableName() . '.nome', $params],
                    ['like', 'users_animation_mm.select_keyword', $params],
                ]);
            }
            $query2 = UsersAnimationMm::find()
                    ->select(['`users_animation_mm`.`id`, `users_animation_mm`.`partnership_profile_id`, `users_animation_mm`.`user_id`, `users_animation_mm`.`select_keyword` , `users_animation_mm`.`number_msg`, `users_animation_mm`.`created_at`, null as `solution_sent`'])
                    ->innerJoin('user_profile', 'user_profile.user_id = users_animation_mm.user_id')
                    ->leftJoin('`expressions_of_interest`', 'expressions_of_interest.partnership_profile_id = users_animation_mm.partnership_profile_id')
                    ->andWhere(['`users_animation_mm`.partnership_profile_id' => $model->id])
                    ->andWhere(['not in', 'users_animation_mm.user_id', $subQuery->asArray()->column()])
                    ->groupBy('users_animation_mm.user_id');


            if (!empty($params)) {

                $query2->andFilterWhere(['or',
                    ['like', UserProfile::tableName() . '.cognome', $params],
                    ['like', UserProfile::tableName() . '.nome', $params],
                    ['like', 'users_animation_mm.select_keyword', $params],
                ]);
            }
            $query = $query1->union($query2);
        }

       // pr($query->createCommand()->getRawSql());
        return $query;
    }

    /**
     *
     * @param type $useprofile
     */
    public static function updateUserProfileOnChangeMentor($partnershipProfile) {
        $facilitatore = $partnershipProfile->partnershipProfileFacilitator;
        $module = \backend\modules\aster_partnership_profiles\Module::instance();

        if (!$module->hidefacilitator && (\Yii::$app->user->can('CM_SFIDE') || \Yii::$app->user->can('PARTNERSHIP_PROFILES_FACILITATOR'))) {

            $eroeCreate = \backend\modules\aster_admin\models\UserProfile::find()
                            ->andWhere(['user_id' => $partnershipProfile->created_by])->one();

            $userContact = UserContact::findOne(['user_id' => $eroeCreate->user_id, 'contact_id' => $facilitatore->user_id]);

            if (is_null($userContact)) {
                $userContact = UserContact::findOne(['user_id' => $facilitatore->user_id, 'contact_id' => $useprofile->user_id]);

                if (is_null($userContact)) {
                    //if there is no connection between $userId and $contactId create a new userContact
                    $userContact = new UserContact();
                    $userContact->user_id = $eroeCreate->user_id;
                    $userContact->contact_id = $facilitatore->user_id;
                    $userContact->created_by = $facilitatore->user_id;
                }
            }
            $userContact->status = UserContact::STATUS_ACCEPTED;
            if ($userContact->save(false)) {


                self::sendEmailToAnimator($facilitatore, $partnershipProfile);

                self::sendEmailIToEroeCreate($eroeCreate, $partnershipProfile, $facilitatore);
            }
        }
    }

    /**
     * @param $facilitatore
     */
    public static function sendEmailToAnimator($facilitatore, $partnershipProfile) {
        $tos = [$facilitatore->user->email];

        $subject = Module::t('amospartnershipprofiles', "#animatore_assigned_obj");

        $text = Email::renderMailPartial('@app/modules/aster_partnership_profiles/views/partnership-profiles/email_to_animator_animatore_assigned', [
                    'partnershipProfile' => $partnershipProfile,
        ]);

        /** @var \arter\amos\emailmanager\AmosEmail $mailModule */
        $from = null;
        // controllo se esiste il controller perchè quando crea il timestamp del login il controller non esiste
        if (!empty(\Yii::$app->controller)) {
            $mailModule = \Yii::$app->getModule("email");
            if (isset($mailModule)) {
                if (is_null($from)) {
                    if (isset(\Yii::$app->params['email-assistenza'])) {
                        //use default platform email assistance
                        $from = \Yii::$app->params['email-assistenza'];
                    } else {
                        $from = 'noreply@emiliaromagnaopeninnovation.aster.it Piattaforma Open Innovation Emilia-Romagna';
                    }
                }
                return Email::sendMail($from, $tos, $subject, $text, [], [], [], 0, false);
            }
        }
        return false;
    }

    /**
     * @param $facilitatore
     */
    public static function sendEmailIToEroeCreate($eroeCreate, $partnershipProfile, $facilitatore) {
        $tos = [$eroeCreate->user->email];

        $subject = Module::t('amospartnershipprofiles', "#animatore_assigned_obj_to_eroe", ['sfida' => $partnershipProfile->title,]);

        $text = Email::renderMailPartial('@app/modules/aster_partnership_profiles/views/partnership-profiles/email_to_creator_animatore_assigned', [
                    'partnershipProfile' => $partnershipProfile,
        ]);

        /** @var \arter\amos\emailmanager\AmosEmail $mailModule */
        $from = null;
        // controllo se esiste il controller perchè quando crea il timestamp del login il controller non esiste
        if (!empty(\Yii::$app->controller)) {
            $mailModule = \Yii::$app->getModule("email");
            if (isset($mailModule)) {
                if (is_null($from)) {
                    if (isset(\Yii::$app->params['email-assistenza'])) {
                        //use default platform email assistance
                        $from = \Yii::$app->params['email-assistenza'];
                    } else {
                        $from = 'noreply@emiliaromagnaopeninnovation.aster.it Piattaforma Open Innovation Emilia-Romagna';
                    }
                }
                return Email::sendMail($from, $tos, $subject, $text, [], [], [], 0, false);
            }
        }
        return false;
    }

    /**
     * @param $facilitatore
     */
    public static function sendEmailIToMentorEroe($partnershipProfile) {
        $eroeCreate = \backend\modules\aster_admin\models\UserProfile::find()
                        ->andWhere(['user_id' => $partnershipProfile->created_by])->one();
        $facilitatore = $eroeCreate->facilitatore;
        $tos = [$facilitatore->user->email];

        $subject = Module::t('amospartnershipprofiles', "#mentor_eroe_to_create_obj");

        $text = Email::renderMailPartial('@app/modules/aster_partnership_profiles/views/partnership-profiles/partnershipprofile-to-validated-mentor', [
                    'partnershipProfile' => $partnershipProfile,
        ]);

        /** @var \arter\amos\emailmanager\AmosEmail $mailModule */
        $from = null;
        // controllo se esiste il controller perchè quando crea il timestamp del login il controller non esiste
        if (!empty(\Yii::$app->controller)) {
            $mailModule = \Yii::$app->getModule("email");
            if (isset($mailModule)) {
                if (is_null($from)) {
                    if (isset(\Yii::$app->params['email-assistenza'])) {
                        //use default platform email assistance
                        $from = \Yii::$app->params['email-assistenza'];
                    } else {
                        $from = 'noreply@emiliaromagnaopeninnovation.aster.it Piattaforma Open Innovation Emilia-Romagna';
                    }
                }
                return Email::sendMail($from, $tos, $subject, $text, [], [], [], 0, false);
            }
        }
        return false;
    }

    /**
     * @param PartnershipProfiles $partnershipProfile
     * @return bool
     */
    public static function sendEmailIToMentorSfide($partnershipProfile) {
        $tos = [$partnershipProfile->createdUserProfile->facilitatore->user->email];
        $subject = Module::t('amospartnershipprofiles', "#partnershipprofile_validated_mentor_mail_subject", ['sfida' => $partnershipProfile->getTitle()]);
        $text = Email::renderMailPartial('@app/modules/aster_partnership_profiles/views/partnership-profiles/partnershipprofile-validated-mentor', [
                    'partnershipProfile' => $partnershipProfile,
        ]);

        /** @var \arter\amos\emailmanager\AmosEmail $mailModule */
        $from = null;
        // controllo se esiste il controller perchè quando crea il timestamp del login il controller non esiste
        if (!empty(\Yii::$app->controller)) {
            $mailModule = \Yii::$app->getModule("email");
            if (isset($mailModule)) {
                if (is_null($from)) {
                    if (isset(\Yii::$app->params['email-assistenza'])) {
                        //use default platform email assistance
                        $from = \Yii::$app->params['email-assistenza'];
                    } else {
                        $from = 'noreply@emiliaromagnaopeninnovation.aster.it Piattaforma Open Innovation Emilia-Romagna';
                    }
                }
                return Email::sendMail($from, $tos, $subject, $text, [], [], [], 0, false);
            }
        }
        return false;
    }

    /**
     * @param PartnershipProfiles $partnershipProfile
     * @return bool
     */
    public static function sendEmailIToCMSfideToValidate($partnershipProfile) {
        $tos = $partnershipProfile->getValidatorUsersId();

        foreach ($tos as $id) {
            $user = User::findOne($id);
            if (!is_null($user)) {
                $to = [$user->email];
                $subject = Module::t('amospartnershipprofiles', "#partnershipprofile_to_validate_cm_mail_subject", ['sfida' => $partnershipProfile->getTitle()]);
                $text = Email::renderMailPartial('@app/modules/aster_partnership_profiles/views/partnership-profiles/partnershipprofile-to-validated-cm', [
                            'model' => $partnershipProfile,
                ]);

                /** @var \arter\amos\emailmanager\AmosEmail $mailModule */
                $from = null;
                // controllo se esiste il controller perchè quando crea il timestamp del login il controller non esiste
                if (!empty(\Yii::$app->controller)) {
                    $mailModule = \Yii::$app->getModule("email");
                    if (isset($mailModule)) {
                        if (is_null($from)) {
                            if (isset(\Yii::$app->params['email-assistenza'])) {
                                //use default platform email assistance
                                $from = \Yii::$app->params['email-assistenza'];
                            } else {
                                $from = 'noreply@emiliaromagnaopeninnovation.aster.it Piattaforma Open Innovation Emilia-Romagna';
                            }
                        }
                        return Email::sendMail($from, $to, $subject, $text, [], [], [], 0, false);
                    }
                }
            }
        }
        return false;
    }

    /**
     * @param PartnershipProfiles $partnershipProfile
     * @return bool
     */
    public static function sendEmailIToCMSfide($partnershipProfile) {
        $tos = $partnershipProfile->getValidatorUsersId();

        foreach ($tos as $id) {
            $user = User::findOne($id);
            if (!is_null($user)) {
                $to = [$user->email];
                $subject = Module::t('amospartnershipprofiles', "#partnershipprofile_validated_cm_mail_subject", ['sfida' => $partnershipProfile->getTitle()]);
                $text = Email::renderMailPartial('@app/modules/aster_partnership_profiles/views/partnership-profiles/partnershipprofile-validated-cm', [
                            'model' => $partnershipProfile,
                ]);

                /** @var \arter\amos\emailmanager\AmosEmail $mailModule */
                $from = null;
                // controllo se esiste il controller perchè quando crea il timestamp del login il controller non esiste
                if (!empty(\Yii::$app->controller)) {
                    $mailModule = \Yii::$app->getModule("email");
                    if (isset($mailModule)) {
                        if (is_null($from)) {
                            if (isset(\Yii::$app->params['email-assistenza'])) {
                                //use default platform email assistance
                                $from = \Yii::$app->params['email-assistenza'];
                            } else {
                                $from = 'noreply@emiliaromagnaopeninnovation.aster.it Piattaforma Open Innovation Emilia-Romagna';
                            }
                        }
                        return Email::sendMail($from, $to, $subject, $text, [], [], [], 0, false);
                    }
                }
            }
        }
        return false;
    }

    public static function sendEmailIToAnimatorSfide($partnershipProfile) {
        $facilitatore = $partnershipProfile->partnershipProfileFacilitator;

        $tos = [$facilitatore->user->email];
        $subject = Module::t('amospartnershipprofiles', '#partnershipprofile_validated_validator_mail_subject', ['sfida' => $partnershipProfile->getTitle()]);
        $text = Email::renderMailPartial('@app/modules/aster_partnership_profiles/views/partnership-profiles/partnershipprofile-validated-validator', [
                    'model' => $partnershipProfile,
        ]);

        /** @var \arter\amos\emailmanager\AmosEmail $mailModule */
        $from = null;
        // controllo se esiste il controller perchè quando crea il timestamp del login il controller non esiste
        if (!empty(\Yii::$app->controller)) {
            $mailModule = \Yii::$app->getModule("email");
            if (isset($mailModule)) {
                if (is_null($from)) {
                    if (isset(\Yii::$app->params['email-assistenza'])) {
                        //use default platform email assistance
                        $from = \Yii::$app->params['email-assistenza'];
                    } else {
                        $from = 'noreply@emiliaromagnaopeninnovation.aster.it Piattaforma Open Innovation Emilia-Romagna';
                    }
                }
                return Email::sendMail($from, $tos, $subject, $text, [], [], [], 0, false);
            }
        }
        return false;
    }
    
    /**
     * @param PartnershipProfiles $partnershipProfile
     * @param int $userId
     * @return bool
     */
    public static function userCanCloseChallenge($partnershipProfile, $userId = 0)
    {
        if ($userId == 0) {
            $userId = \Yii::$app->user->id;
        }
        $allowedStatuses = [
            PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED,
            PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_FEEDBACKRECEIVED
        ];
        return (
            (
                \Yii::$app->user->can('CM_SFIDE') ||
                \Yii::$app->user->can('PARTNERSHIP_PROFILES_ADMINISTRATOR') ||
                ($userId == $partnershipProfile->created_by)
            ) &&
            (in_array($partnershipProfile->status, $allowedStatuses))
        );
    }
}
