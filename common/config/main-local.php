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
    'name' => 'Emilia-Romagna Open Innovation',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=eroi',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'enableSchemaCache' => false,
            'schemaCacheDuration' => 88000,
            'schemaCache' => 'schemaCache',
            'attributes' => [
                PDO::ATTR_PERSISTENT => true
            ]
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'XXXXXXX',
                'username' => 'XXXXXX',
                'password' => 'XXXXX',
                'port' => '25',
                //'encryption' => 'tls',
            ],
            'messageConfig' => [
                'priority' => 3
            ]
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'extraCategoryPaths' => [
                        'amosadmin' => '@common/translation/amosadmin/i18n',
                        'amosbestpractice' => '@common/translation/amosbestpractice/i18n',
                        'amoscommunity' => '@common/translation/amoscommunity/i18n',
                        'amoscore' => '@common/translation/amoscore/i18n',
                        'amosinvitations' => '@common/translation/amosinvitations/i18n',
                        'amoslayout' => '@common/translation/amoslayout/i18n',
                        'amosmyactivities' => '@common/translation/amosmyactivities/i18n',
                        'amosnews' => '@common/translation/amosnews/i18n',
                        'amosorganizzazioni' => '@common/translation/amosorganizzazioni/i18n',
                        'amospartnershipprofiles' => '@common/translation/amospartnershipprofiles/i18n',
                        'amostag' => '@common/translation/amostag/i18n',
                        'amosticket' => '@common/translation/amosticket/i18n',
                        'asterplatform' => '@common/translation/asterplatform/i18n',
                        'logininforequest' => '@common/translation/logininforequest/i18n',
                    ]
                ]
            ]
        ]
    ]
];
