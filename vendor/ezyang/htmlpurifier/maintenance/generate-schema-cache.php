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


require_once dirname(__FILE__) . '/common.php';
require_once dirname(__FILE__) . '/../library/HTMLPurifier.auto.php';
assertCli();

/**
 * @file
 * Generates a schema cache file, saving it to
 * library/HTMLPurifier/ConfigSchema/schema.ser.
 *
 * This should be run when new configuration options are added to
 * HTML Purifier. A cached version is available via the repository
 * so this does not normally have to be regenerated.
 *
 * If you have a directory containing custom configuration schema files,
 * you can simple add a path to that directory as a parameter to
 * this, and they will get included.
 */

$target = dirname(__FILE__) . '/../library/HTMLPurifier/ConfigSchema/schema.ser';

$builder = new HTMLPurifier_ConfigSchema_InterchangeBuilder();
$interchange = new HTMLPurifier_ConfigSchema_Interchange();

$builder->buildDir($interchange);

$loader = dirname(__FILE__) . '/../config-schema.php';
if (file_exists($loader)) include $loader;
foreach ($_SERVER['argv'] as $i => $dir) {
    if ($i === 0) continue;
    $builder->buildDir($interchange, realpath($dir));
}

$interchange->validate();

$schema_builder = new HTMLPurifier_ConfigSchema_Builder_ConfigSchema();
$schema = $schema_builder->build($interchange);

echo "Saving schema... ";
file_put_contents($target, serialize($schema));
echo "done!\n";

// vim: et sw=4 sts=4
