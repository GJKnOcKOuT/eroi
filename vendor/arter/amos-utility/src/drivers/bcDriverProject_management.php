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

use arter\amos\projectmanagement\models\Projects;
use arter\amos\projectmanagement\models\search\ProjectsSearch;

use arter\amos\projectmanagement\widgets\icons\WidgetIconCreatedByProjects;
use arter\amos\projectmanagement\widgets\icons\WidgetIconMyProjects;
use arter\amos\projectmanagement\widgets\icons\WidgetIconProjectsActivities;

/**
 * 
 */
class bcDriverProject_management extends bcDriver
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->modelClassName = Project::className(); // put here your model
        $this->widgetIconNames = [
//            WidgetIconCreatedByProjects::getWidgetIconName() => WidgetIconCreatedByProjects::classname(),
//            WidgetIconMyProjects::getWidgetIconName() => WidgetIconMyProjects::classname(),
//            WidgetIconProjectsActivities::getWidgetIconName() => WidgetIconProjectsActivities::classname(),
        ];
    }
    
    /**
     * Put here your search queries
     */
    public function searchWidgetIconCreatedByProjects() {
        $search = new ProjectsSearch();
        $this->query =  $search->searchCreatedByProjects([])->query;
        
//        $projectsSearch = new ProjectsSearch();
//        $this->setBulletCount(
//            $this->makeBulletCounter(
//                Yii::$app->getUser()->getId(),
//                Projects::className(),
//                $projectsSearch->searchCreatedByProjects([])->query
//            )
//        );
    }
    
    public function searchWidgetIconMyProjects() {
        $search = new ProjectsSearch();
        $this->query = $search->searchMyProjects([])->query;

        //        if ($this->disableBulletCounters == false) {
//            $projectsSearch = new ProjectsSearch();
//            $this->setBulletCount(
//                $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    Projects::className(),
//                    $projectsSearch->searchMyProjects([])->query
//                )
//            );
//        }
    }
    
    public function searchWidgetIconProjectsActivities() {
        $search = new ProjectsSearch();
        $this->query = $search->searchMyProjects([])->query;

        //        if ($this->disableBulletCounters == false) {
//            $projectsSearch = new ProjectsSearch();
//            $this->setBulletCount(
//                $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    Projects::className(),
//                    $projectsSearch->searchMyProjects([])->query
//                )
//            );
//        }
    }
    
}
