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

/**
 * @file
 * Removes trailing whitespace from files.
 */

chdir(dirname(__FILE__) . '/..');
$FS = new FSTools();

$files = $FS->globr('.', '{,.}*', GLOB_BRACE);
foreach ($files as $file) {
    if (
        !is_file($file) ||
        prefix_is('./.git', $file) ||
        prefix_is('./docs/doxygen', $file) ||
        postfix_is('.ser', $file) ||
        postfix_is('.tgz', $file) ||
        postfix_is('.patch', $file) ||
        postfix_is('.dtd', $file) ||
        postfix_is('.ent', $file) ||
        $file == './library/HTMLPurifier/Lexer/PH5P.php' ||
        $file == './maintenance/PH5P.php'
    ) continue;
    $contents = file_get_contents($file);
    $result = preg_replace('/^(.*?)[ \t]+(\r?)$/m', '\1\2', $contents, -1, $count);
    if (!$count) continue;
    echo "$file\n";
    file_put_contents($file, $result);
}

// vim: et sw=4 sts=4
