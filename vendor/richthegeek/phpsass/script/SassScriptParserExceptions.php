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

/* SVN FILE: $Id$ */
/**
 * SassScript Parser exception class file.
 * @author      Chris Yates <chris.l.yates@gmail.com>
 * @copyright   Copyright (c) 2010 PBM Web Development
 * @license      http://phamlp.googlecode.com/files/license.txt
 * @package      PHamlP
 * @subpackage  Sass.script
 */

require_once(dirname(__FILE__).'/../SassException.php');

/**
 * SassScriptParserException class.
 * @package      PHamlP
 * @subpackage  Sass.script
 */
class SassScriptParserException extends SassException {}

/**
 * SassScriptLexerException class.
 * @package      PHamlP
 * @subpackage  Sass.script
 */
class SassScriptLexerException extends SassScriptParserException {}

/**
 * SassScriptOperationException class.
 * @package      PHamlP
 * @subpackage  Sass.script
 */
class SassScriptOperationException extends SassScriptParserException {}

/**
 * SassScriptFunctionException class.
 * @package      PHamlP
 * @subpackage  Sass.script
 */
class SassScriptFunctionException extends SassScriptParserException {}
