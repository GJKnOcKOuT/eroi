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

/**
 * This is the configuration for generating message translations
 * for the Yii framework. It is used by the 'yiic message' command.
 */
return array(
    'sourcePath' => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'backend',
    'messagePath' => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'backend/messages',
    'languages' => ['it', 'en'],
    'fileTypes' => array('php'),
    'overwrite' => true,
    'exclude' => array(
        '.svn',

        'yiilite.php',
        'yiit.php',
        '/i18n/data',
        '/messages',
        '/web/js',
    ),
);
