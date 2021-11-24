<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\basic\template
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

return [
    'errorHandler' => [
        'errorAction' => 'site/error',
    ],
    'eventSequence' => [
        'class' => '\raoul2000\workflow\events\BasicEventSequence',
    ],
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
                'logVars' => ['_SERVER'],
            ],
        ],
    ],/*
    'maintenanceMode' => [
        'class' => 'brussens\maintenance\MaintenanceMode',
        'enabled' => false,
        'route' => '/layout/maintenance/maintenance',
        'message' => '',

        // Allowed IP addresses
        'ips' => [
            '77.89.1.132',
            '127.0.0.1',
            '172.17.0.1',
        ],
    ],*/
    'request' => [
        'csrfParam' => '_csrf-backend',
    ],
    'session' => [
        // this is the name of the session cookie used for login on the backend
        'name' => 'advanced-backend',
		'class' => 'yii\web\DbSession',
    ],
    'user' => [
        'class' => 'arter\amos\core\user\AmosUser',
        'identityClass' => 'arter\amos\core\user\User',
        'loginUrl' => '/admin/security/login',
        'enableAutoLogin' => true,
        'identityCookie' => [
            'name' => '_identity-backend',
            'httpOnly' => true,
            'secure' => true
        ],
    ],
    'socialShare' => [
            'class' => \arter\amos\core\components\ConfiguratorSocialShare::class,
        ],
];
