<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace arter\amos\seo\controllers;

use arter\amos\seo\models\SeoData;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use arter\amos\seo\AmosSeo;

/**
 * Tools for SEO
 *
 * @author matteo
 */
class ToolsController extends Controller {

    /**
     * Generates missing pretty urls for every object of the provided class
     * 
     * @param type $modelSearchClass
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
//                        'actions' => [
//                            'index',
//                            'generateMissingPrettyUrls'
//                        ],
                        'roles' => ['ADMIN']
                    ],
                ],
            ],
        ];
    }

    public $layout = "main";

    public function actionIndex() {
//        $modules = [];
//        foreach(Yii::$app->getModule('seo')->modulesEnabled as $module){
//            if (in_array('arter\\amos\\core\\interfaces\\CmsModuleInterface', class_implements($module))) {
//                $modules[] = $module;
//            }
//        }
        return $this->render('index',[
            'modules' => Yii::$app->getModule(AmosSeo::getModuleName())->modulesEnabled
        ]);
    }

    public function actionGenerateMissingPrettyUrls($moduleName) {
        $module = Yii::$app->getModule($moduleName);
        $errorMessage = null;
        if (in_array('arter\\amos\\core\\interfaces\\CmsModuleInterface', class_implements($module))) {
            $searchModelClass = $module::getModelSearchClassName();
            $searchModel = new $searchModelClass;
            $dataProvider = $searchModel->cmsSearch([], null);
            $modelsCount = 0;
            foreach ($dataProvider->models as $model) {
                $seoData = SeoData::findOne([
                            'classname' => $model->className(),
                            'content_id' => $model->id
                ]);

                if (is_null($seoData)) {
                    $seoData = new SeoData();
                    $seoData->classname = $model->className();
                    $seoData->content_id = $model->id;
                    $seoData->pretty_url = $seoData->generateUniqueSeoSlug($model[$model->titleAttribute]);
                    $seoData->created_by = $model->created_by;
                    $seoData->save();
                    $modelsCount++;
                }
            }
        } else {
            $errorMessage = \arter\amos\seo\AmosSeo::t('amosseo','Modulo non valido');
        }
        
        return $this->render('generateMissingPrettyUrls',[
            'modelsCount' => $modelsCount,
            'errorMessage' => $errorMessage
        ]);
    }

}
