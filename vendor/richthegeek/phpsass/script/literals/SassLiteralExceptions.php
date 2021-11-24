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
 * Sass literal exception classes.
 * @author      Chris Yates <chris.l.yates@gmail.com>
 * @copyright   Copyright (c) 2010 PBM Web Development
 * @license      http://phamlp.googlecode.com/files/license.txt
 * @package      PHamlP
 * @subpackage  Sass.script.literals
 */

require_once(dirname(__FILE__).'/../SassScriptParserExceptions.php');

/**
 * Sass literal exception.
 * @package      PHamlP
 * @subpackage  Sass.script.literals
 */
class SassLiteralException extends SassScriptParserException {}

/**
 * SassBooleanException class.
 * @package      PHamlP
 * @subpackage  Sass.script.literals
 */
class SassBooleanException extends SassLiteralException {}

/**
 * SassColourException class.
 * @package      PHamlP
 * @subpackage  Sass.script.literals
 */
class SassColourException extends SassLiteralException {}

/**
 * SassListException class.
 * @package      PHamlP
 * @subpackage  Sass.script.literals
 */
class SassListException extends SassLiteralException {}

/**
 * SassNumberException class.
 * @package      PHamlP
 * @subpackage  Sass.script.literals
 */
class SassNumberException extends SassLiteralException {}

/**
 * SassStringException class.
 * @package      PHamlP
 * @subpackage  Sass.script.literals
 */
class SassStringException extends SassLiteralException {}
