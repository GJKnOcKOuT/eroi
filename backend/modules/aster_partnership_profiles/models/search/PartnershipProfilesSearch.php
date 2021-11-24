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

use arter\amos\notificationmanager\models\NotificationChannels;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * Class PartnershipProfilesSearch
 * @package backend\modules\aster_partnership_profiles\models\search
 */
class PartnershipProfilesSearch extends \arter\amos\partnershipprofiles\models\search\PartnershipProfilesSearch
{
    /**
     * @param ActiveQuery $query
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    private function notificationOff($query)
    {
        $notify = $this->getNotifier();
        if ($notify) {
            /** @var \arter\amos\notificationmanager\AmosNotify $notify */
            $notify->notificationOff(\Yii::$app->getUser()->id, $this->partnerProfModule->model('PartnershipProfiles'), $query, NotificationChannels::CHANNEL_READ);
        }
    }
    
    /**
     * @param array $params
     * @return ActiveQuery
     */
    public function searchArchivedClosedQuery($params)
    {
        $query = $this->baseSearch($params);
        $query->andWhere(['status' => [self::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_ARCHIVED, self::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_CLOSED]]);
        return $query;
    }
    
    /**
     * @param array $params
     * @return ActiveDataProvider
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function searchArchivedClosed($params)
    {
        $query = $this->searchArchivedClosedQuery($params);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $this->setSearchSort($dataProvider);
        $this->notificationOff($query);
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        $this->baseFilter($query);
        
        return $dataProvider;
    }
}
