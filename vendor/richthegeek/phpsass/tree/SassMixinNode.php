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
 * SassMixinNode class file.
 * @author      Chris Yates <chris.l.yates@gmail.com>
 * @copyright   Copyright (c) 2010 PBM Web Development
 * @license      http://phamlp.googlecode.com/files/license.txt
 * @package      PHamlP
 * @subpackage  Sass.tree
 */

/**
 * SassMixinNode class.
 * Represents a Mixin.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassMixinNode extends SassNode
{
  const NODE_IDENTIFIER = '+';
  const MATCH = '/^(\+|@include\s+)([a-z0-9_-]+)\s*(?:\((.*?)\))?\s*$/i';
  const IDENTIFIER = 1;
  const NAME = 2;
  const ARGS = 3;

  /**
   * @var string name of the mixin
   */
  private $name;
  /**
   * @var array arguments for the mixin
   */
  private $args = '';

  /**
   * SassMixinDefinitionNode constructor.
   * @param object $token source token
   * @return SassMixinNode
   */
  public function __construct($token)
  {
    parent::__construct($token);
    preg_match(self::MATCH, $token->source, $matches);

    if (!isset($matches[self::NAME])) {
      throw new SassMixinNodeException('Invalid mixin invocation: ($token->source)', $this);
    }
    $this->name = $matches[self::NAME];
    if (isset($matches[self::ARGS]) && strlen($matches[self::ARGS])) {
      $this->args = $matches[self::ARGS];
    }
  }

  /**
   * Parse this node.
   * Set passed arguments and any optional arguments not passed to their
   * defaults, then render the children of the mixin definition.
   * @param SassContext $pcontext the context in which this node is parsed
   * @return array the parsed node
   */
  public function parse($pcontext)
  {
    $mixin = $pcontext->getMixin($this->name);
    $context = new SassContext($pcontext);
    $context->content = $this->children;
    $argc = count($this->args);
    $count = 0;

    $args = SassScriptFunction::extractArgs($this->args, false, $context);

    list($arguments) = SassScriptFunction::fill_parameters($mixin->args, $args, $context, $this);
    $context->setVariables($arguments);

    $children = array();
    foreach ($mixin->children as $child) {
	  /** @var $child SassNode */
      $child->parent = $this;
      $children = array_merge($children, $child->parse($context));
    }

    // $context->merge();
    return $children;
  }

  /**
   * Returns a value indicating if the token represents this type of node.
   * @param object $token token
   * @return boolean true if the token represents this type of node, false if not
   */
  public static function isa($token)
  {
    return $token->source[0] === self::NODE_IDENTIFIER;
  }
  
  /**
   * Resolves selectors.
   * Interpolates SassScript in selectors and resolves any parent references or
   * appends the parent selectors.
   * @param SassContext $context the context in which this node is parsed
   * @return array
   */
  public function resolveSelectors($context){
    return $this->parent->resolveSelectors($context);
  }
}
