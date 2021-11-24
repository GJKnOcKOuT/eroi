<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

namespace frontend\controllers;

use arter\amos\comuni\models\IstatProvince;
use yii\helpers\ArrayHelper;

class FrontendUtility
{

    public static function getIstatProvince()
    {
        return ArrayHelper::map(IstatProvince::find()->orderBy('nome')->asArray()->all(), 'id', 'nome');
    }
}