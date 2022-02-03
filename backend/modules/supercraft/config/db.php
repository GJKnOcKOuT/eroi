<?php

return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=mydb',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'enableSchemaCache' => false,
        'schemaCacheDuration' => 88000,
        'schemaCache' => 'schemaCache',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
