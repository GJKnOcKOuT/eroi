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


ini_set('xdebug.trace_format', 1);
ini_set('xdebug.show_mem_delta', true);

if (file_exists('Trace.xt')) {
    echo "Previous trace Trace.xt must be removed before this script can be run.";
    exit;
}

xdebug_start_trace(dirname(__FILE__) . '/Trace');
require_once '../library/HTMLPurifier.auto.php';

$purifier = new HTMLPurifier();

$data = $purifier->purify(file_get_contents('samples/Lexer/4.html'));
xdebug_stop_trace();

echo "Trace finished.";

// vim: et sw=4 sts=4
