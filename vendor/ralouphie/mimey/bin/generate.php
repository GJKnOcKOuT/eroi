#!/usr/bin/env php
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


require_once dirname(__DIR__) . '/vendor/autoload.php';

$mime_types_custom_text = file_get_contents(dirname(__DIR__) . '/mime.types.custom');
$mime_types_text = file_get_contents(dirname(__DIR__) . '/mime.types');

$generator = new \Mimey\MimeMappingGenerator($mime_types_custom_text . PHP_EOL . $mime_types_text);
$mapping_code = $generator->generateMappingCode();

file_put_contents(dirname(__DIR__) . '/mime.types.php', $mapping_code);
