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
 * SassCommentNode class file.
 * @author      Chris Yates <chris.l.yates@gmail.com>
 * @copyright   Copyright (c) 2010 PBM Web Development
 * @license      http://phamlp.googlecode.com/files/license.txt
 * @package      PHamlP
 * @subpackage  Sass.tree
 */

/**
 * SassCommentNode class.
 * Represents a CSS comment.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassCommentNode extends SassNode
{
  const NODE_IDENTIFIER = '/';
  const MATCH = '%^/\*\s*?(.*?)\s*?(\*/)?$%s';
  const COMMENT = 1;

  private $value;

  /**
   * SassCommentNode constructor.
   * @param object $token source token
   */
  public function __construct($token)
  {
    parent::__construct($token);
    preg_match(self::MATCH, $token->source, $matches);
    $this->value = $matches[self::COMMENT];
  }

  protected function getValue()
  {
    return $this->value;
  }

  /**
   * Parse this node.
   * @param mixed $context
   * @return array the parsed node - an empty array
   */
  public function parse($context)
  {
    return array($this);
  }

  /**
   * Render this node.
   * @return string the rendered node
   */
  public function render()
  {
    return $this->renderer->renderComment($this);
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
}
