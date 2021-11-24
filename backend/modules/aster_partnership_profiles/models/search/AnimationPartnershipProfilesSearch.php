<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles\models\search
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_partnership_profiles\models\search;

use \backend\modules\aster_partnership_profiles\models\PartnershipProfiles;
use yii\data\ActiveDataProvider;

class AnimationPartnershipProfilesSearch extends \arter\amos\partnershipprofiles\models\search\PartnershipProfilesSearch {

    /**
     * @param array $params
     * @return \yii\data\ActiveDataProvider
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function searchAnimationToValidate($params) {
        $query = $this->queryAnimationValidation($params, PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_TOVALIDATE);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);

//        pr($query->createCommand()->rawSql);
        $this->setSearchSort($dataProvider);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->baseFilter($query);

        return $dataProvider;
    }

    /**
     * @param array $params
     * @return \yii\data\ActiveDataProvider
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function searchAnimationValidated($params) {
        $query = $this->queryAnimationValidation($params, [PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED, PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_FEEDBACKRECEIVED]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setSearchSort($dataProvider);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->baseFilter($query);

        return $dataProvider;
    }

    /**
     * @param $params
     * @param $status
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function queryAnimationValidation($params, $status) {
        $query = $this->baseSearch($params);
        $query->andWhere(['status' => $status]);
        $loggedUser = \backend\modules\aster_admin\models\UserProfile::find()
                        ->andWhere(['user_id' => \Yii::$app->user->id])->one();

        if (\Yii::$app->user->can('CM_SFIDE') && \Yii::$app->user->can('PARTNERSHIP_PROFILES_FACILITATOR')) {
            $query->andFilterWhere(['or',
                ['partnership_profile_facilitator_id' => $loggedUser->user_id],
                ['partnership_profile_facilitator_id' => null],
                ['!=','partnership_profile_facilitator_id', $loggedUser->user_id],
            ]);
        } else if (\Yii::$app->user->can('PARTNERSHIP_PROFILES_FACILITATOR')){
            $query->andWhere(['partnership_profile_facilitator_id' => $loggedUser->user_id]);
        }

        return $query;
    }

    /**
     * @param $params
     * @param $status
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function queryAnimationAssign($params, $status) {
        $query = $this->baseSearch($params);
        $loggedUser = \backend\modules\aster_admin\models\UserProfile::find()
                        ->andWhere(['user_id' => \Yii::$app->user->id])
                        ->andWhere(['status' => $status])->one();

        if (\Yii::$app->user->can('CM_SFIDE') && \Yii::$app->user->can('PARTNERSHIP_PROFILES_FACILITATOR')) {
            $query->andFilterWhere(['or',
                ['partnership_profile_facilitator_id' => $loggedUser->user_id],
                ['partnership_profile_facilitator_id' => null],
                ['!=','partnership_profile_facilitator_id', $loggedUser->user_id],
            ]);
        } else if (\Yii::$app->user->can('PARTNERSHIP_PROFILES_FACILITATOR')){
            $query->andWhere(['partnership_profile_facilitator_id' => $loggedUser->user_id]);
        }

        return $query;
    }

    /**
     * @param array $params
     * @return \yii\data\ActiveDataProvider
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function searchAnimationToAssign($params) {
        $query = $this->baseSearch($params);
        $query->andWhere(['partnership_profile_facilitator_id' => null])
                ->andWhere(['status' => PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_TOVALIDATE]);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setSearchSort($dataProvider);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->baseFilter($query);

        return $dataProvider;
    }

    /**
     * @param array $params
     * @return \yii\data\ActiveDataProvider
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function searchAnimationAssigned($params) {
        $query = $this->baseSearch($params);
        $query->andWhere(['is not', 'partnership_profile_facilitator_id', null])
                ->andWhere(['status' => PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_TOVALIDATE]);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setSearchSort($dataProvider);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->baseFilter($query);

        return $dataProvider;
    }
    
    /**
     * @param array $params
     * @return \yii\data\ActiveDataProvider
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function searchAll($params, $limit = null) {
        $query = $this->baseSearch($params);
       
        $loggedUser = \backend\modules\aster_admin\models\UserProfile::find()
                        ->andWhere(['user_id' => \Yii::$app->user->id])->one();

        if (\Yii::$app->user->can('CM_SFIDE') && \Yii::$app->user->can('PARTNERSHIP_PROFILES_FACILITATOR')) {
            $query->andFilterWhere(['or',
                ['partnership_profile_facilitator_id' => $loggedUser->user_id],
                ['partnership_profile_facilitator_id' => null],
                ['!=','partnership_profile_facilitator_id', $loggedUser->user_id],
            ]);
        } else if (\Yii::$app->user->can('PARTNERSHIP_PROFILES_FACILITATOR')){
            $query->andWhere(['partnership_profile_facilitator_id' => $loggedUser->user_id]);
        }

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setSearchSort($dataProvider);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->baseFilter($query);

        return $dataProvider;
    }
    
    /**
     * @param array $params
     * @param null $limit
     * @return ActiveDataProvider
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function latestAnimationSearch($params, $limit = null)
    {
        $dataProvider = $this->searchAll($params);
        $dataProvider->query->orderBy(['created_at' => SORT_DESC]);
        $dataProvider->pagination->pageSize = $limit;
        return $dataProvider;
    }

}
