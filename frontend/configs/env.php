<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

$common = require(__DIR__ . '/../../common/config/main-local.php');
$modulesAmos = require(__DIR__ . '/../../common/config/modules-amos.php');

$modules = array_merge(
        $modulesAmos,require(__DIR__ . '/modules-amos.php'), require(__DIR__ . '/modules-others.php')
);

$components = array_merge(
         $common ['components'], require(__DIR__ . '/components-amos.php'), require(__DIR__ . '/components-others.php')
);

$bootstrap = require(__DIR__ . '/bootstrap.php');
$params = array_merge(
        require(__DIR__ . '/params.php'),
        require(__DIR__ . '/params-local.php')
        );

$config = [
    //'controllerNamespace' => 'frontend\controllers',
    'locales' => [
        'it' => 'it-IT',
        'en' => 'en-GB',
    ],
    
    'vendorPath' => dirname(__DIR__) . '/../vendor',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@common' => dirname(__DIR__) . '/../common',
        '@arter' => '@vendor/arter',
        '@frontend' => dirname(__DIR__),
        '@backend' => dirname(__DIR__) . '/../backend',
    ],
    'name' => 'Open Innovation',
    /*
     * For best interoperability it is recommend to use only alphanumeric characters when specifying an application ID.
     */
    'id' => 'myproject',
    /*
     * The name of your site, will be display on the login screen
     */
    'siteTitle' => 'Amos CMS',
    /*
     * Let the application know which module should be executed by default (if no url is set). This module must be included
     * in the modules section. In the most cases you are using the cms as default handler for your website. But the concept
     * of LUYA is also that you can use a website without the CMS module!
     */
    'defaultRoute' => 'cms',
    
    'consoleBaseUrl' => '/',
    'consoleHostInfo' => 'http://localhost',
    /*
     * Define the basePath of the project (Yii Configration Setup)
     */
    'basePath' => dirname(__DIR__),
    'modules' => $modules,
    'components' => $components,
    'bootstrap' => $bootstrap,
    'params' => $params,
];

if (YII_DEBUG)
{
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = ['class'=> 'yii\debug\Module', 'allowedIPs' => ['*']];
}
//return \yii\helpers\ArrayHelper::merge($config, require('env-local.php'));
return $config;