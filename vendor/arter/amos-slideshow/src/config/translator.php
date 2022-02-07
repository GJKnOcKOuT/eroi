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
 * @package    arter\amos\slideshow
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * This is the configuration for generating message translations
 * for the Yii framework. It is used by the 'yiic message' command.
 */
return [
    'translator' => 'AmosNews::t',
    'sourcePath' => __DIR__ . '/../',
    'messagePath' => __DIR__ . '/../messages',
    'languages' => [
        'it-IT',
        'en-US'
    ],
    'fileTypes' => ['php'],
    'overwrite' => true,
    'exclude' => [
        '.svn',
        'messages'
    ]
];