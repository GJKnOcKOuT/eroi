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
 * This file is intended to be used in conjunction with Apache2's mod_actions,
 * wherein you can have a .htaccess file like so for automatic compilation:
 *     Action compile-sass /git/phpsass/compile-apache.php
 *     AddHandler compile-sass .sass .scss
 */

header('Content-type: text/css');

require_once './SassParser.php';

function warn($text, $context) {
	print "/** WARN: $text, on line {$context->node->token->line} of {$context->node->token->filename} **/\n";
}
function debug($text, $context) {
	print "/** DEBUG: $text, on line {$context->node->token->line} of {$context->node->token->filename} **/\n";
}


$file = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['PATH_INFO'];
$syntax = substr($file, -4, 4);

$options = array(
	'style' => 'expanded',
	'cache' => FALSE,
	'syntax' => $syntax,
	'debug' => FALSE,
	'callbacks' => array(
		'warn' => 'warn',
		'debug' => 'debug'
	),
);

// Execute the compiler.
$parser = new SassParser($options);
try {
	print "\n\n" . $parser->toCss($file);
} catch (Exception $e) {
	print $e->getMessage();	
}