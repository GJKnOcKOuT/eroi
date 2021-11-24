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

//require_once '../library/HTMLPurifier.path.php';
shell_exec('php ../maintenance/generate-schema-cache.php');
require_once '../library/HTMLPurifier.path.php';
require_once 'HTMLPurifier.includes.php';

$begin = xdebug_memory_usage();

$schema = HTMLPurifier_ConfigSchema::makeFromSerial();

echo xdebug_memory_usage() - $begin;

// vim: et sw=4 sts=4
