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

/* SVN FILE: $Id: SassExtendNode.php 49 2010-04-04 10:51:24Z chris.l.yates $ */
/**
 * SassExtendNode class file.
 * @author      Chris Yates <chris.l.yates@gmail.com>
 * @copyright   Copyright (c) 2010 PBM Web Development
 * @license      http://phamlp.googlecode.com/files/license.txt
 * @package      PHamlP
 * @subpackage  Sass.tree
 */

/**
 * SassExtendNode class.
 * Represents a Sass @debug or @warn directive.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassExtendNode extends SassNode
{
  const IDENTIFIER = '@';
  const MATCH = '/^@extend\s+(.+)/i';
  const VALUE = 1;

  /**
   * @var string the directive
   */
  private $value;

  /**
   * SassExtendNode.
   * @param object $token source token
   * @return SassExtendNode
   */
  public function __construct($token)
  {
    parent::__construct($token);
    preg_match(self::MATCH, $token->source, $matches);
    $this->value = $matches[self::VALUE];
  }

  /**
   * Parse this node.
   * @return array An empty array
   */
  public function parse($context)
  {
    # resolve selectors in relation to variables
    # allows extend inside nested loops.
    $this->root->extend($this->value, $this->parent->resolveSelectors($context));

    return array();
  }
}
