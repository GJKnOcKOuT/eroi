<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\basic\template
 * @category   CategoryName
 */

namespace backend\components;

use yii\base\BootstrapInterface;

/**
 * Multi-language support
 * @package backend\components
 */
class LanguageSelector implements BootstrapInterface
{
    /**
     * Supported-languages array
     * @var array
     */
    public $supportedLanguages = [];

    /**
     * Bootstrap for multi-language support
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        $preferredLanguage = isset($app->request->cookies['language']) ? (string)$app->request->cookies['language'] : null;
        // or in case of database:
        // $preferredLanguage = $app->user->language;

        if (empty($preferredLanguage)) {
            $preferredLanguage = $app->request->getPreferredLanguage($this->supportedLanguages);
        }

        $app->language = $preferredLanguage;
    }
}