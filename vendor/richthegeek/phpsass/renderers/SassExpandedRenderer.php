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
 * SassExpandedRenderer class file.
 * @author      Chris Yates <chris.l.yates@gmail.com>
 * @copyright   Copyright (c) 2010 PBM Web Development
 * @license      http://phamlp.googlecode.com/files/license.txt
 * @package      PHamlP
 * @subpackage  Sass.renderers
 */

require_once 'SassCompactRenderer.php';

/**
 * SassExpandedRenderer class.
 * Expanded is the typical human-made CSS style, with each property and rule
 * taking up one line. Properties are indented within the rules, but the rules
 * are not indented in any special way.
 * @package      PHamlP
 * @subpackage  Sass.renderers
 */
class SassExpandedRenderer extends SassCompactRenderer
{
  /**
   * Renders the brace between the selectors and the properties
   * @return string the brace between the selectors and the properties
   */
  protected function between()
  {
    return " {\n" ;
  }

  /**
   * Renders the brace at the end of the rule
   * @return string the brace between the rule and its properties
   */
  protected function end()
  {
    return "\n}\n\n";
  }

  /**
   * Renders a comment.
   * @param SassNode $node the node being rendered
   * @return string the rendered commnt
   */
  public function renderComment($node)
  {
    $indent = $this->getIndent($node);
    $lines = explode("\n", $node->value);
    foreach ($lines as &$line) {
      $line = trim($line);
    }

    return "$indent/*\n$indent * ".join("\n$indent * ", $lines)."\n$indent */".(empty($indent)?"\n":'');
  }

  /**
   * Renders properties.
   * @param mixed $node
   * @param array $properties properties to render
   * @return string the rendered properties
   */
  public function renderProperties($node, $properties)
  {
    $indent = $this->getIndent($node).self::INDENT;

    return $indent.join("\n$indent", $properties);
  }
}
