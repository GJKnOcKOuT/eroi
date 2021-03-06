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
 * @package    arter\amos\slideshow
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\slideshow\models;

use mdm\admin\models\Route;
use yii\helpers\ArrayHelper;
use arter\amos\slideshow\AmosSlideshow;
use yii\db\Query;

/**
 * Class SlideshowRoute
 * @package arter\amos\slideshow\models
 *
 * This is the model class for table "slideshow_route".
 */
class SlideshowRoute extends \arter\amos\slideshow\models\base\SlideshowRoute {

    public function getRotte($slideshowId = NULL, $role = 'TUTTI') {
        $slideshowRoute = SlideshowRoute::find();
//        if($role != 'TUTTI'){
//                $slideshowRoute->andWhere("role is null OR role = '$role'");
//        }
        $assegnati = [];
//        if ($slideshowRoute->count()) {
//            foreach ($slideshowRoute->asArray()->all() as $Route) {
//                $assegnati[] = $Route['route'];
//            }
//        }
        $daAggiungere = NULL;
        if ($slideshowId != NULL) {
            $daAggiungere = SlideshowRoute::findOne(['slideshow_id' => $slideshowId]);
        }
        $model = new Route;
        $modules = \Yii::$app->getModules();
        $rotte = [];
        foreach ($modules as $key => $value) {
            $rotte = array_merge($rotte, $model->getAppRoutes($key));
        }
        $filename = \Yii::$app->basePath . '/config/main.php';
        if (file_exists($filename)) {
            $fileConfig = require($filename);
        }


        $rotte = array_merge($rotte, $model->getAppRoutes());
        $Rotte = [];
        foreach ($rotte as $rotta) {
            if (!strpos($rotta, '*') && !in_array($rotta, $assegnati)) {
                $Rotte[$rotta] = $rotta;
            } else if (strpos($rotta, '*')) {
                $rotta = str_replace('/*', '', $rotta);
                $Rotte[$rotta] = $rotta;
            }
        }
        if ($filename) {
            if (!empty($fileConfig['components']['urlManager']['rules'])) {
                $rules = $fileConfig['components']['urlManager']['rules'];
                foreach ((array) $rules as $key => $value) {
                    $newKey = (strpos($key, "/") === 0) ? $key : "/" . $key;
                    $Rotte[$newKey] = $newKey;
                }
            }
        }
        if($slideshowId && $daAggiungere){
            if(isset($daAggiungere->route)){
                $Rotte[$daAggiungere->route] = $daAggiungere->route;
            }
        }
        return $Rotte;
    }
    
    public function getAllRoles(){
       $roles = (new Query())->from('auth_item')->andWhere(['type' => 1])->all(); 
       $allRoles = [];
       $allRoles['TUTTI'] = 'TUTTI';
       foreach ((array) $roles as $role){    
           $allRoles[$role['name']] = $role['name'];
       }
       return $allRoles;
    }
}
