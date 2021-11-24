<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\basic\template
 * @category   CategoryName
 */

namespace backend\controllers;


use yii\web\Controller;

class RolesCheckerController extends Controller
{

    public $layout = '@vendor/arter/amos-core/views/layouts/main';

    public function actionIndex()
    {
        $Roles = \Yii::$app->getAuthManager()->getRoles();

        return $this->render('index', [
            'Roles' => $Roles
        ]);


    }

}