<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/* @var $this YiiRequirementChecker */
/* @var $summary array */
/* @var $requirements array[] */

echo "\nYii Application Requirement Checker\n\n";

echo "This script checks if your server configuration meets the requirements\n";
echo "for running Yii application.\n";
echo "It checks if the server is running the right version of PHP,\n";
echo "if appropriate PHP extensions have been loaded, and if php.ini file settings are correct.\n";

$header = 'Check conclusion:';
echo "\n{$header}\n";
echo str_pad('', strlen($header), '-') . "\n\n";

foreach ($requirements as $key => $requirement) {
    if ($requirement['condition']) {
        echo $requirement['name'] . ": OK\n";
        echo "\n";
    } else {
        echo $requirement['name'] . ': ' . ($requirement['mandatory'] ? 'FAILED!!!' : 'WARNING!!!') . "\n";
        echo 'Required by: ' . strip_tags($requirement['by']) . "\n";
        $memo = strip_tags($requirement['memo']);
        if (!empty($memo)) {
            echo 'Memo: ' . strip_tags($requirement['memo']) . "\n";
        }
        echo "\n";
    }
}

$summaryString = 'Errors: ' . $summary['errors'] . '   Warnings: ' . $summary['warnings'] . '   Total checks: ' . $summary['total'];
echo str_pad('', strlen($summaryString), '-') . "\n";
echo $summaryString;

echo "\n\n";
