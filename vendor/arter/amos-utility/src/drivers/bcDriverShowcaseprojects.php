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

use arter\amos\showcaseprojects\models\ShowcaseProject;
use arter\amos\showcaseprojects\models\search\ShowcaseProjectSearch;
use arter\amos\showcaseprojects\models\search\ShowcaseProjectProposalSearch;
use arter\amos\showcaseprojects\models\search\InitiativeSearch;

use arter\amos\showcaseprojects\widgets\icons\WidgetIconInitiativesCreatedBy;
use arter\amos\showcaseprojects\widgets\icons\WidgetIconInitiativesProposalToValidate;
use arter\amos\showcaseprojects\widgets\icons\WidgetIconInitiativesToValidate;
use arter\amos\showcaseprojects\widgets\icons\WidgetIconShowcaseProjectProposalsCreatedBy;
use arter\amos\showcaseprojects\widgets\icons\WidgetIconShowcaseProjectProposalsToValidate;
use arter\amos\showcaseprojects\widgets\icons\WidgetIconShowcaseProjects;
use arter\amos\showcaseprojects\widgets\icons\WidgetIconShowcaseProjectsAll;
use arter\amos\showcaseprojects\widgets\icons\WidgetIconShowcaseProjectsCreatedBy;
use arter\amos\showcaseprojects\widgets\icons\WidgetIconShowcaseProjectsToValidate;

/**
 * 
 */
class bcDriverShowcaseprojects extends bcDriver
{
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->modelClassName = ShowcaseProject::className();
        $this->widgetIconNames = [
            WidgetIconInitiativesCreatedBy::getWidgetIconName() => WidgetIconInitiativesCreatedBy::classname(),
            WidgetIconInitiativesProposalToValidate::getWidgetIconName() => WidgetIconInitiativesProposalToValidate::classname(),
            WidgetIconInitiativesToValidate::getWidgetIconName() => WidgetIconInitiativesToValidate::classname(),
            WidgetIconShowcaseProjectProposalsCreatedBy::getWidgetIconName() => WidgetIconShowcaseProjectProposalsCreatedBy::classname(),
            WidgetIconShowcaseProjectProposalsToValidate::getWidgetIconName() => WidgetIconShowcaseProjectProposalsToValidate::classname(),
            WidgetIconShowcaseProjects::getWidgetIconName() => WidgetIconShowcaseProjects::classname(),
            WidgetIconShowcaseProjectsAll::getWidgetIconName() => WidgetIconShowcaseProjectsAll::classname(),
            WidgetIconShowcaseProjectsCreatedBy::getWidgetIconName() => WidgetIconShowcaseProjectsCreatedBy::classname(),
            WidgetIconShowcaseProjectsToValidate::getWidgetIconName() => WidgetIconShowcaseProjectsToValidate::classname(),
        ];
    }
    
    /**
     * Put here your search queries
     */
    public function searchWidgetIconInitiativesCreatedBy() {
        $search = new InitiativeSearch();
        $this->query = $search->buildQuery([], 'created-by');

        //        if ($this->disableBulletCounters == false) {
//            $search = new InitiativeSearch();
//            $this->setBulletCount(
//                $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    Initiative::className(),
//                    $search->buildQuery([], 'created-by')
//                )
//            );
//        }
    }
    
    public function searchWidgetIconInitiativesProposalToValidate() {
        $search = new InitiativeSearch();
        if (Yii::$app->user->can($search->getValidatorRole())) {
            $this->query = Initiative::find()
                ->andWhere([
                    'status' => Initiative::INITIATIVE_WORKFLOW_STATUS_PROSPOSALTOVALIDATE
                ]);
        }
        
            //        if ($this->disableBulletCounters == false) {
//            $count = 0;
//            $search = new InitiativeSearch();
//            if (Yii::$app->user->can($search->getValidatorRole())) {
//                $dataProvider = new ActiveDataProvider([
//                    'query' => Initiative::find()
//                        ->andWhere(['status' => Initiative::INITIATIVE_WORKFLOW_STATUS_PROSPOSALTOVALIDATE])
//                ]);
//                $count = $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    Initiative::className(),
//                    $dataProvider
//                );
//            }
//
//            $this->setBulletCount($count);
//        }
    }
    
    public function searchWidgetIconInitiativesToValidate() {
        $search = new InitiativeSearch();
        if (Yii::$app->user->can($search->getValidatorRole())) {
            $this->query = $search->buildQuery([], 'to-validate');
        }

        //        if ($this->disableBulletCounters == false) {
//            $count = 0;
//            $search = new InitiativeSearch();
//            if (Yii::$app->user->can($search->getValidatorRole())) {
//                $count = $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    Initiative::className(),
//                    $search->buildQuery([], 'to-validate')
//                );
//            }
//
//            $this->setBulletCount($count);
//        }
    }
    
    public function searchWidgetIconShowcaseProjectProposalsCreatedBy() {
        $search = new ShowcaseProjectProposalSearch();
        $this->query = $search->buildQuery([], 'created-by');
        
        //        $search = new ShowcaseProjectProposalSearch();
//        $this->setBulletCount(
//            $this->makeBulletCounter(
//                Yii::$app->getUser()->getId(),
//                ShowcaseProjectProposal::className(),
//                $search->buildQuery([], 'created-by')
//            )
//        );
    }
    
    public function searchWidgetIconShowcaseProjectProposalsToValidate() {
        $search = new ShowcaseProjectProposalSearch();
        if (Yii::$app->user->can($search->getValidatorRole())) {
            $this->query = $search->buildQuery([], 'to-validate');
        }

//            $this->setBulletCount($count);
//        }
        //        if ($this->disableBulletCounters == false) {
//            $count = 0;
//            $search = new ShowcaseProjectProposalSearch();
//            if (Yii::$app->user->can($search->getValidatorRole())) {
//                $count = $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    ShowcaseProjectProposal::className(),
//                    $search->buildQuery([], 'to-validate')
//                );
//            }
//
//            $this->setBulletCount($count);
//        }
    }
    
    public function searchWidgetIconShowcaseProjects() {
        $search = new ShowcaseProjectSearch();
        $this->query = $search->buildQuery([], 'own-interest');

//        if ($this->disableBulletCounters == false) {
//            $search = new ShowcaseProjectSearch();
//            $search->setEventAfterCounter();
//            $query = $search->buildQuery([], 'own-interest');
//            
//            $this->setBulletCount(
//                $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    ShowcaseProject::className(),
//                    $query
//                )
//            );
//            
//            \Yii::$app->session->set('_offQuery', $query);
//            $this->trigger(self::EVENT_AFTER_COUNT);
//        }
    }
    
    public function searchWidgetIconShowcaseProjectsAll() {
        $search = new ShowcaseProjectSearch();
        $this->query = $search->buildQuery([], 'all');
        //        if ($this->disableBulletCounters == false) {
//            $search = new ShowcaseProjectSearch();
//            $search->setEventAfterCounter();
//            $query = $search->buildQuery([], 'all');
//            
//            $this->setBulletCount(
//                $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    ShowcaseProject::class,
//                    $query
//                )
//            );
//            
//            \Yii::$app->session->set('_offQuery', $query);
//            $this->trigger(self::EVENT_AFTER_COUNT);
//        }
    }
    
    public function searchWidgetIconShowcaseProjectsCreatedBy() {
        $search = new ShowcaseProjectSearch();
        $this->query = $search->buildQuery([], 'created-by');
        
        //        if ($this->disableBulletCounters == false) {
//            $search = new ShowcaseProjectSearch();
//            $this->setBulletCount(
//                $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    ShowcaseProject::className(),
//                    $search->buildQuery([], 'created-by')
//                )
//            );
//            $this->trigger(self::EVENT_AFTER_COUNT);
//        }
    }
    
    public function searchWidgetIconShowcaseProjectsToValidate() {
        $search = new ShowcaseProjectSearch();
        $this->query = $search->buildQuery([], 'to-validate');

        //        if ($this->disableBulletCounters == false) {
//            $search = new ShowcaseProjectSearch();
//            $this->setBulletCount(
//                $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    ShowcaseProject::className(),
//                    $search->buildQuery([], 'to-validate')
//                )
//            );
//            $this->trigger(self::EVENT_AFTER_COUNT);
//        }
    }
                    
}
