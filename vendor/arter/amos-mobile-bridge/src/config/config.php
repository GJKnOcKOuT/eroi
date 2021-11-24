<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\mobile\bridge
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
// Server API Key (you can get it here: https://firebase.google.com/docs/server/setup#prerequisites)
$firebaseApiKey = isset(Yii::$app->params['firebaseApiKey']) ? Yii::$app->params['firebaseApiKey'] : null;

return [
    'modules' => [
        'v1' => [
            'class' => \arter\amos\mobile\bridge\modules\v1\V1::className()
        ]
    ],
    'components' => [
        'user' => [
            'class' => 'arter\amos\core\user\AmosUser',
            'identityClass' => 'arter\amos\mobile\bridge\modules\v1\models\User',
            'enableAutoLogin' => true,
        ],
        'request' => [
            'class' => \yii\web\Request::className(),
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'fcm' => [
            'class' => 'understeam\fcm\Client',
            'apiKey' => $firebaseApiKey,
        ],
        'expo' => [
            'class' => 'arter\expo\ExpoPush'
        ],
    ]
];
