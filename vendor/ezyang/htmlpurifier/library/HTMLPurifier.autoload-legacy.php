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
 * Legacy autoloader for systems lacking spl_autoload_register
 *
 * Must be separate to prevent deprecation warning on PHP 7.2
 */

function __autoload($class)
{
    return HTMLPurifier_Bootstrap::autoload($class);
}

// vim: et sw=4 sts=4
