#!/usr/bin/php
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


chdir(dirname(__FILE__));
require_once 'common.php';
assertCli();

echo "Please do not run this script. It is here for historical purposes only.";
exit;

/**
 * @file
 * Removes ConfigSchema function calls from source files.
 */

chdir(dirname(__FILE__) . '/../library/');
$FS = new FSTools();

$files = $FS->globr('.', '*.php');
foreach ($files as $file) {
    if (substr_count(basename($file), '.') > 1) continue;
    $old_code = file_get_contents($file);
    $new_code = preg_replace("#^HTMLPurifier_ConfigSchema::.+?\);[\n\r]*#ms", '', $old_code);
    if ($old_code !== $new_code) {
        file_put_contents($file, $new_code);
    }
    if (preg_match('#^\s+HTMLPurifier_ConfigSchema::#m', $new_code)) {
        echo "Indented ConfigSchema call in $file\n";
    }
}

// vim: et sw=4 sts=4
