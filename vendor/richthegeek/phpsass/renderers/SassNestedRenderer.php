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
 * SassNestedRenderer class file.
 * @author      Chris Yates <chris.l.yates@gmail.com>
 * @copyright   Copyright (c) 2010 PBM Web Development
 * @license      http://phamlp.googlecode.com/files/license.txt
 * @package      PHamlP
 * @subpackage  Sass.renderers
 */

require_once 'SassExpandedRenderer.php';

/**
 * SassNestedRenderer class.
 * Nested style is the default Sass style, because it reflects the structure of
 * the document in much the same way Sass does. Each rule is indented based on
 * how deeply it's nested. Each property has its own line and is indented
 * within the rule.
 * @package      PHamlP
 * @subpackage  Sass.renderers
 */
class SassNestedRenderer extends SassExpandedRenderer
{
  /**
   * Renders the brace at the end of the rule
   * @return string the brace between the rule and its properties
   */
  protected function end()
  {
    return " }\n";
  }

  /**
   * Returns the indent string for the node
   * @param SassNode $node the node being rendered
   * @return string the indent string for this SassNode
   */
  protected function getIndent($node)
  {
    return str_repeat(self::INDENT, $node->level);
  }

  /**
   * Renders a directive.
   * @param SassNode $node the node being rendered
   * @param array $properties properties of the directive
   * @return string the rendered directive
   */
  public function renderDirective($node, $properties)
  {
    $directive = $this->getIndent($node) . $node->directive . $this->between() . $this->renderProperties($node, $properties);

    return preg_replace('/(.*})\n$/', '\1', $directive) . $this->end();
  }

  /**
   * Renders rule selectors.
   * @param SassNode $node the node being rendered
   * @return string the rendered selectors
   */
  protected function renderSelectors($node)
  {
    $selectors = array();
    foreach ($node->selectors as $selector) {
      if (!$node->isPlaceholder($selector)) {
        $selectors[] = $selector;
      }
    }

    $indent = $this->getIndent($node);

    return $indent.join(",\n$indent", $selectors);
  }
}
