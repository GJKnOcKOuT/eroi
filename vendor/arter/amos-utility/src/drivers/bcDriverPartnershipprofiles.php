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
 * @package    arter\amos\utility\drivers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\utility\drivers;

use arter\amos\utility\drivers\base\bcDriver;

use arter\amos\partnershipprofiles\models\ExpressionsOfInterest;
use arter\amos\partnershipprofiles\models\search\ExpressionsOfInterestSearch;
use arter\amos\partnershipprofiles\models\search\PartnershipProfilesSearch;
use arter\amos\partnershipprofiles\models\PartnershipProfiles;

use arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestCreatedBy;
use arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestReceived;
use arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesAll;
use arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesCreatedBy;

/**
 * 
 */
class bcDriverPartnershipprofiles extends bcDriver
{
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->modelClassName = PartnershipProfiles::className(); // put here your model
        $this->widgetIconNames = [
//            WidgetIconExpressionsOfInterestCreatedBy::getWidgetIconName() => WidgetIconExpressionsOfInterestCreatedBy::classname(),
            WidgetIconExpressionsOfInterestReceived::getWidgetIconName() => WidgetIconExpressionsOfInterestReceived::classname(),
            WidgetIconPartnershipProfilesAll::getWidgetIconName() => WidgetIconPartnershipProfilesAll::classname(),
//            WidgetIconPartnershipProfilesCreatedBy::getWidgetIconName() = WidgetIconPartnershipProfilesCreatedBy::classname(),
        ];
    }
    
    /**
     * Put here your search queries
     */
    public function searchWidgetIconExpressionsOfInterestCreatedBy() {
        $search = new ExpressionsOfInterestSearch();
        $this->query = $search->searchCreatedByQuery([]);
        $this->query
            ->andWhere([
            ExpressionsOfInterestSearch::tableName() . '.status' => ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_DRAFT
        ]);

        //        $search = new ExpressionsOfInterestSearch();
//        $query = $search->searchCreatedByQuery([]);
//        $query->andWhere([
//            ExpressionsOfInterestSearch::tableName() . '.status' => ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_DRAFT
//        ]);
//        
//        $this->setBulletCount(
//            $this->makeBulletCounter(
//                Yii::$app->getUser()->getId(),
//                ExpressionsOfInterest::className(),
//                $query
//            )
//        );
    }
    
    public function searchWidgetIconPartnershipProfilesCreatedBy() {
        $search = new PartnershipProfilesSearch();
        $this->query = $search->searchCreatedByQuery([]);
        
        //        $search = new PartnershipProfilesSearch();
//        $this->setBulletCount(
//            $this->makeBulletCounter(
//                Yii::$app->getUser()->getId(),
//                PartnershipProfiles::className(),
//                $search->searchCreatedByQuery([])
//            )
//        );
    }
    
    
    
    public function searchWidgetIconExpressionsOfInterestReceived() {
//        echo 'WidgetIconExpressionsOfInterestReceived' . PHP_EOL;

        $loggedUser = \Yii::$app->user->identity;
        $search = new ExpressionsOfInterestSearch();
        $this->query = $search->searchReceivedQuery([]);
        $this->query->andWhere([
            '>=',
            ExpressionsOfInterest::tableName() . '.created_at',
            $loggedUser->userProfile->ultimo_logout]
        );

//// Query originale del 2018        
//    public function makeBulletCount()
//    {
//        /** @var User $loggedUser */
//        $loggedUser = \Yii::$app->user->identity;
//        $modelSearch = new ExpressionsOfInterestSearch();
//        $query = $modelSearch->searchReceivedQuery([]);
//        $query->andWhere(['>=', ExpressionsOfInterest::tableName() . '.created_at', $loggedUser->userProfile->ultimo_logout]);
//        $count = $query->count();
//        return $count;
//    }
        
        
//        if ($this->disableBulletCounters == false) {
//            $loggedUser = \Yii::$app->user->identity;
//            $search = new ExpressionsOfInterestSearch();
//            $query = $search->searchReceivedQuery([]);
//            $query->andWhere([
//                '>=',
//                ExpressionsOfInterest::tableName() . '.created_at',
//                $loggedUser->userProfile->ultimo_logout]
//            );
//
////            $search->setEventAfterCounter();
//            $query = $search->searchReceivedQuery([]);
//            
//            $this->setBulletCount(
//                $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    ExpressionsOfInterest::className(),
//                    $query
//                )
//            );
//                
//            \Yii::$app->session->set('_offQuery', $query);
//            $this->trigger(self::EVENT_AFTER_COUNT);
//        }        
    }
    
    public function searchWidgetIconPartnershipProfilesAll() {
//        echo 'WidgetIconPartnershipProfilesAll' . PHP_EOL;
        
        $search = new PartnershipProfilesSearch();
        $this->query = $search->searchAllQuery([]);
        
//// Query originale del 2018
//    public function makeBulletCount()
//    {
//        $modelSearch = new PartnershipProfilesSearch();
//        $notifier = \Yii::$app->getModule('notify');
//        $count = 0;
//        if ($notifier) {
//            /** @var \arter\amos\notificationmanager\AmosNotify $notifier */
//            $count = $notifier->countNotRead(\Yii::$app->getUser()->id, PartnershipProfiles::class, $modelSearch->searchAllQuery([]));
//        }
//        return $count;
//    }
//}
        

//        if ($this->disableBulletCounters == false) {
//            $search = new PartnershipProfilesSearch();
//            $search->setEventAfterCounter();
//            $query = $search->searchAllQuery([]);
//            
//            $this->setBulletCount(
//                $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    PartnershipProfiles::class,
//                    $query
//                )
//            );
//            
//            \Yii::$app->session->set('_offQuery', $query);
//            $this->trigger(self::EVENT_AFTER_COUNT);
//        }
    }
    
}
