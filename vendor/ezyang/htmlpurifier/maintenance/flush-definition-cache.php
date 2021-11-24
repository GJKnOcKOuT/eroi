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
 * Flushes the definition serial cache. This file should be
 * called if changes to any subclasses of HTMLPurifier_Definition
 * or related classes (such as HTMLPurifier_HTMLModule) are made. This
 * may also be necessary if you've modified a customized version.
 *
 * @param Accepts one argument, cache type to flush; otherwise flushes all
 *      the caches.
 */

echo "Flushing cache... \n";

require_once(dirname(__FILE__) . '/../library/HTMLPurifier.auto.php');

$config = HTMLPurifier_Config::createDefault();

$names = array('HTML', 'CSS', 'URI', 'Test');
if (isset($argv[1])) {
    if (in_array($argv[1], $names)) {
        $names = array($argv[1]);
    } else {
        throw new Exception("Cache parameter {$argv[1]} is not a valid cache");
    }
}

foreach ($names as $name) {
    echo " - Flushing $name\n";
    $cache = new HTMLPurifier_DefinitionCache_Serializer($name);
    $cache->flush($config);
}

echo "Cache flushed successfully.\n";

// vim: et sw=4 sts=4
