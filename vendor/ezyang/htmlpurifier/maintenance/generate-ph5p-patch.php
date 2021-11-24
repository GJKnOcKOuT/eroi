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
 * @file
 * This file compares our version of PH5P with Jero's original version, and
 * generates a patch of the differences. This script should be run whenever
 * library/HTMLPurifier/Lexer/PH5P.php is modified.
 */

$orig = realpath(dirname(__FILE__) . '/PH5P.php');
$new  = realpath(dirname(__FILE__) . '/../library/HTMLPurifier/Lexer/PH5P.php');
$newt = dirname(__FILE__) . '/PH5P.new.php'; // temporary file

// minor text-processing of new file to get into same format as original
$new_src = file_get_contents($new);
$new_src = '<?php' . PHP_EOL . substr($new_src, strpos($new_src, 'class HTML5 {'));

file_put_contents($newt, $new_src);
shell_exec("diff -u \"$orig\" \"$newt\" > PH5P.patch");
unlink($newt);

// vim: et sw=4 sts=4
