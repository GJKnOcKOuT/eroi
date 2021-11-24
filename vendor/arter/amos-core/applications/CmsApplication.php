<?php

namespace arter\amos\core\applications;

/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    [NAMESPACE_HERE]
 * @category   CategoryName
 */
use luya\web\Application as WebApplication;
use Yii;

class CmsApplication extends WebApplication
{

    public function getHomeUrl()
    {
        return self::toUrl(parent::getHomeUrl());
    }

    /**
     *
     * @param string $url
     * @return string
     */
    public static function toUrl($url)
    {
        $languageString = '/'.Yii::$app->composition['langShortCode'];
        if (strncmp($url, $languageString, strlen($languageString)) === 0) {
            $languageString = "";
        }
        $url = (strcmp($url, '/') === 0)  ? "": $url;
        return $languageString.'/'.$url;
    }
}