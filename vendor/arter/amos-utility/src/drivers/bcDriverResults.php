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

use amos\results\models\ResultProposal;
use amos\results\models\search\ResultProposalSearch;
use amos\results\models\search\ResultSearch;

use amos\results\widgets\icons\WidgetIconResultProposalsCreatedBy;
use amos\results\widgets\icons\WidgetIconResultProposalsToValidate;
use amos\results\widgets\icons\WidgetIconResults;
use amos\results\widgets\icons\WidgetIconResultsAll;
use amos\results\widgets\icons\WidgetIconResultsCreatedBy;
use amos\results\widgets\icons\WidgetIconResultsToValidate;

/**
 * 
 */
class bcDriverResults extends bcDriver
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->modelClassName = ResultProsal::className(); // put here your model
        $this->widgetIconNames = [
            WidgetIconResultProposalsCreatedBy::getWidgetIconName() => WidgetIconResultProposalsCreatedBy::classname(),
            WidgetIconResultProposalsToValidate::getWidgetIconName() => WidgetIconResultProposalsToValidate::classname(),
            WidgetIconResults::getWidgetIconName() => WidgetIconResults::className(),
            WidgetIconResultsAll::getWidgetIconName() => WidgetIconResultsAll::classname(),
            WidgetIconResultsCreatedBy::getWidgetIconName() => WidgetIconResultsCreatedBy::classname(),
            WidgetIconResultsToValidate::getWidgetIconName() => WidgetIconResultsToValidate::classname(),
        ];
    }
    
    /**
     * Put here your search queries
     */
    public function searchWidgetIconResultProposalsCreatedBy() {
        $search = new ResultProposalSearch();
        $this->query = $search->buildQuery([], 'created-by');

//        $search = new ResultProposalSearch();
//        $this->setBulletCount(
//            $this->makeBulletCounter(
//                Yii::$app->getUser()->getId(),
//                ResultProposal::className(),
//                $search->buildQuery([], 'created-by')
//            )
//        );

    }
    
    public function searchWidgetIconResultProposalsToValidate() {
        $search = new ResultProposalSearch();
        $this->query = $search->buildQuery([], 'to-validate');

        //        if ($this->disableBulletCounters == false) {
//            $search = new ResultProposalSearch();
//            $this->setBulletCount(
//                $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    ResultProposal::className(),
//                    $search->buildQuery([], 'to-validate')
//                )
//            );
//        }

    }
    
    public function searchWidgetIconResults() {
        $search = new ResultSearch();
        $this->query = $search->buildQuery([], 'own-interest');

        //        if ($this->disableBulletCounters == false) {
//            $search = new ResultSearch();
//            $this->setBulletCount(
//                $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    Result::className(),
//                    $search->buildQuery([], 'own-interest')
//                )
//            );
////            $this->trigger(self::EVENT_AFTER_COUNT);
//        }

    }
    
    public function searchWidgetIconResultsAll() {
        $search = new ResultSearch();
        $this->query = $search->buildQuery([], 'all');

    ////        if ($this->disableBulletCounters == false) {
    //            $search = new ResultSearch();
    //            $this->setBulletCount(
    //                $this->makeBulletCounter(
    //                    Yii::$app->getUser()->getId(),
    //                    Result::className(),
    //                    $search->buildQuery([], 'all')
    //                )
    //            );
    ////            $this->trigger(self::EVENT_AFTER_COUNT);
    //        }

        
    }
    
    public function searchWidgetIconResultsCreatedBy() {
        $search = new ResultSearch();
        $this->query = $search->buildQuery([], 'created-by');

        //        $search = new ResultSearch();
//        $this->setBulletCount(
//            $this->makeBulletCounter(
//                Yii::$app->getUser()->getId(),
//                Result::className(),
//                $search->buildQuery([], 'created-by')
//            )
//        );

    }
    
    public function searchWidgetIconResultsToValidate() {
        $search = new ResultSearch();
        $this->query = $search->buildQuery([], 'to-validate');

        //        if ($this->disableBulletCounters == false) {
//            $search = new ResultSearch();
//            $this->setBulletCount(
//                $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    Result::className(),
//                    $search->buildQuery([], 'to-validate')
//                )
//            );
//        }

    }
    
}
