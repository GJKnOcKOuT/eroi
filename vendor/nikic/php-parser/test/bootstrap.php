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


namespace PhpParser;

require __DIR__ . '/../vendor/autoload.php';

function canonicalize($str) {
    // normalize EOL style
    $str = str_replace("\r\n", "\n", $str);

    // trim newlines at end
    $str = rtrim($str, "\n");

    // remove trailing whitespace on all lines
    $lines = explode("\n", $str);
    $lines = array_map(function($line) {
        return rtrim($line, " \t");
    }, $lines);
    return implode("\n", $lines);
}
