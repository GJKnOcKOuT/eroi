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
 * SassNode exception classes.
 * @author      Chris Yates <chris.l.yates@gmail.com>
 * @copyright   Copyright (c) 2010 PBM Web Development
 * @license      http://phamlp.googlecode.com/files/license.txt
 * @package      PHamlP
 * @subpackage  Sass.tree
 */

require_once(dirname(__FILE__).'/../SassException.php');

/**
 * SassNodeException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassNodeException extends SassException {}

/**
 * SassContextException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassContextException extends SassNodeException {}

/**
 * SassCommentNodeException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassCommentNodeException extends SassNodeException {}

/**
 * SassDebugNodeException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassDebugNodeException extends SassNodeException {}

/**
 * SassDirectiveNodeException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassDirectiveNodeException extends SassNodeException {}

/**
 * SassEachNodeException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassEachNodeException extends SassNodeException {}

/**
 * SassExtendNodeException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassExtendNodeException extends SassNodeException {}

/**
 * SassForNodeException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassForNodeException extends SassNodeException {}

/**
 * SassFunctionDefinitionNodeException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassFunctionDefinitionNodeException extends SassNodeException {}

/**
 * SassIfNodeException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassIfNodeException extends SassNodeException {}

/**
 * SassImportNodeException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassImportNodeException extends SassNodeException {}

/**
 * SassMixinDefinitionNodeException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassMixinDefinitionNodeException extends SassNodeException {}

/**
 * SassMixinNodeException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassMixinNodeException extends SassNodeException {}

/**
 * SassPropertyNodeException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassPropertyNodeException extends SassNodeException {}

/**
 * SassRuleNodeException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassRuleNodeException extends SassNodeException {}

/**
 * SassVariableNodeException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassVariableNodeException extends SassNodeException {}

/**
 * SassWhileNodeException class.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassWhileNodeException extends SassNodeException {}
