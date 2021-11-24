<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\basic\template
 * @category   CategoryName
 */

return [
    
    'assetManager' => [
        'appendTimestamp' => true,
        'forceCopy' => false,
        'hashCallback' => function ($path) {
            return hash('md4', $path);
        },
        'converter' => [
            'class' => 'cakebake\lessphp\AssetConverter',
            'compress' => true,
            'useCache' => false,
            //'cacheDir' => null,
            'cacheSuffix' => true,
        ],
    ],
    'authManager' => [
        'class' => 'arter\amos\core\rbac\DbManagerCached',
        'cache' => 'rbacCache'
    ],
    'breadcrumbcache' => [
        'class' => 'yii\caching\FileCache',
        'cachePath' => '@runtime/breadcrumbcache'
    ],
    'cache' => [
        //'class' => 'yii\caching\FileCache',
        'class' => 'yii\caching\DummyCache',
    ],
    'composition' => [
        'hidden' => false, // no languages in your url (most case for pages which are not multi lingual)
        'pattern' => '<langShortCode:[a-z]{2}>',
        'default' => ['langShortCode' => 'it'], // the default language for the composition should match your default language shortCode in the language table.
    ],
    'errorHandler' => [
        'class' => 'app\modules\cms\error\ErrorHandler',
    ],
    'i18n' => [
        'translations' => [
            '*' => [
                'class' => 'arter\amos\core\i18n\MessageSource',
                'db' => 'db',
                'sourceLanguage' => 'it-IT', // Developer language
                'sourceMessageTable' => '{{%language_source}}',
                'messageTable' => '{{%language_translate}}',
                'cachingDuration' => 86400,
                'enableCaching' => false,
                'forceTranslation' => true,
                'autoUpdate' => true,
                'extraCategoryPaths' => [
                    'amoscore' => '@vendor/arter/amos-core/i18n',
                    'amos' => '@common/translation/amos/i18n',
                    'amosplatform' => '@common/translation/amosplatform/i18n',
                    'amosapp' => '@common/translation/amosapp/i18n',
                    'cruds' => '@common/translation/cruds/i18n',
                    'giiamos' => '@common/translation/giiamos/i18n',
                    'javascript' => '@common/translation/javascript/i18n',
                    'site' => '@common/translation/site/i18n',
                    'wizard' => '@common/translation/wizard/i18n',
                ],
            ],
        ],
    ],
    'rbacCache' => [
        'class' => 'yii\caching\FileCache',
        'cachePath' => '@runtime/rbacCache'
    ],
    /*'request' => [
        'csrfParam' => '_csrf-frontend',
    ],*/
    'schemaCache' => [
        'class' => 'yii\caching\FileCache',
        'cachePath' => '@runtime/schemaCache'
    ],
    /*'session' => [
        'class' => 'yii\web\CacheSession',
        // this is the name of the session cookie used for login on the frontend
        'name' => 'advanced-frontend',
    ],*/
    'storage' => [
        'class' => 'app\modules\cms\storage\AmosFileSystem'
    ],
    'translateCache' => [
        'class' => 'yii\caching\FileCache',
        'cachePath' => '@runtime/translateCache'
    ],
    'translatemanager' => [
        'class' => 'lajax\translatemanager\Component'
    ],
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
    ],
    'view' => [
        'class' => 'app\modules\cms\base\CmsView',
    ],
    'adminuser' => [
        'class' => 'app\modules\cms\components\AdminUser',
        'defaultLanguage' => 'it',
        'enableAutoLogin' => true,
        /*'identityCookie' => [
            'name' => '_identity-luya',
            'httpOnly' => true,
            'secure' => true,
            'domain' => ".demotestwip.it",
        ],*/
    ],
];
