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
 * SassContentNode class file.
 * @author      Richard Lyon
 * @copyright   Copyright (c) 2010 PBM Web Development
 * @license      http://phamlp.googlecode.com/files/license.txt
 * @package      PHamlP
 * @subpackage  Sass.tree
 */

/**
 * SassContentNode class.
 * Represents a Content.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassContentNode extends SassNode
{
  const MATCH = '/^(@content)(.*)$/i';
  const IDENTIFIER = 1;

  /**
   * @var mixed statement to execute and return
   */
  private $statement;

  /**
   * SassContentNode constructor.
   * @param object $token source token
   * @return SassContentNode
   */
  public function __construct($token)
  {
    parent::__construct($token);
    preg_match(self::MATCH, $token->source, $matches);

    if (empty($matches)) {
      return new SassBoolean('false');
    }
  }

  /**
   * Parse this node.
   * Set passed arguments and any optional arguments not passed to their
   * defaults, then render the children of the return definition.
   * @param SassContext $pcontext the context in which this node is parsed
   * @return array the parsed node
   */
  public function parse($pcontext)
  {
    $return = $this;
    $context = new SassContext($pcontext);

    $children = array();
    foreach ($context->getContent() as $child) {
      $child->parent = $this->parent;
      $ctx = new SassContext($pcontext->parent);
      $ctx->variables = $pcontext->variables;
      $children = array_merge($children, $child->parse($ctx));
    }

    return $children;
  }

  /**
   * Contents a value indicating if the token represents this type of node.
   * @param object $token token
   * @return boolean true if the token represents this type of node, false if not
   */
  public static function isa($token)
  {
    return $token->source[0] === self::IDENTIFIER;
  }
}
