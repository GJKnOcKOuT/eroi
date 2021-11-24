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
    'formatter' => [
        'class' => 'arter\amos\core\formatter\Formatter',
        'dateFormat' => 'php:d/m/Y',
        'datetimeFormat' => 'php:d/m/Y H:i',
        'timeFormat' => 'php:H:i',
        'defaultTimeZone' => 'Europe/Rome',
        'timeZone' => 'Europe/Rome',
        'locale' => 'it-IT',
        'thousandSeparator' => '.',
        'decimalSeparator' => ',',
    ],
    'imageUtility' => [
        'class' => 'arter\amos\core\components\ImageUtility',
    ],
    'view' => [
         'class' => 'arter\amos\core\components\AmosView',
    ],
    'workflowSource' => [
        'class' => 'arter\amos\core\workflow\ContentDefaultWorkflowDbSource',
    ],
];
