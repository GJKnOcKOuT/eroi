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


namespace app\controllers;

use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'wizflow' => [
              'class' => '\arter\amos\wizflow\WizardPlayAction'
            ]
        ];
    }

    public function actionFinish()
    {
    	return $this->render('finish',[
    		'path' => Yii::$app->wizflowManager->getPath()
    	]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
