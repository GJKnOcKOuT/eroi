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


function assertCli()
{
    if (php_sapi_name() != 'cli' && !getenv('PHP_IS_CLI')) {
        echo 'Script cannot be called from web-browser (if you are indeed calling via cli,
set environment variable PHP_IS_CLI to work around this).';
        exit(1);
    }
}

function prefix_is($comp, $subject)
{
    return strncmp($comp, $subject, strlen($comp)) === 0;
}

function postfix_is($comp, $subject)
{
    return strlen($subject) < $comp ? false : substr($subject, -strlen($comp)) === $comp;
}

// Load useful stuff like FSTools
require_once dirname(__FILE__) . '/../extras/HTMLPurifierExtras.auto.php';

// vim: et sw=4 sts=4
