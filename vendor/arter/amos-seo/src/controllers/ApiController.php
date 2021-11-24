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

class ApiController extends \yii\rest\Controller {
    
    public function init()
    {
        parent::init();
        
    }
    

    public function actionPrettyurl()
    {    
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $slug = Yii::$app->request->post('slug');
        $seo = new SeoData();
        return [
            'pretty_url' => $seo->generateUniqueSeoSlug($slug),
        ];
    }
}