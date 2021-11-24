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

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'tHEEpO05IXv2Bw151VukkkPymGxoaJQn',
        ],
    ],
    'name' => 'Emilia-Romagna Open Innovation',
    'bootstrap' => [
        'arter\amos\admin\bootstrap\FirstAccessWizard'
    ],
];


if (!YII_ENV_PROD) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*']

    ];
    $config['modules']['gii']['generators'] = [
        'giiamos-crud' => ['class' => 'arter\amos\core\giiamos\crud\Generator'],
        'giiamos-model' => ['class' => 'arter\amos\core\giiamos\model\Generator'],
    ];
}

return $config;
