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
 * SassRenderer class file.
 * @author      Chris Yates <chris.l.yates@gmail.com>
 * @copyright   Copyright (c) 2010 PBM Web Development
 * @license      http://phamlp.googlecode.com/files/license.txt
 * @package      PHamlP
 * @subpackage  Sass.renderers
 */

#require_once 'SassCompactRenderer.php';
#require_once 'SassCompressedRenderer.php';
#require_once 'SassExpandedRenderer.php';
#require_once 'SassNestedRenderer.php';

/**
 * SassRenderer class.
 * @package      PHamlP
 * @subpackage  Sass.renderers
 */
class SassRenderer
{
  /**#@+
   * Output Styles
   */
  const STYLE_COMPRESSED = 'compressed';
  const STYLE_COMPACT    = 'compact';
  const STYLE_EXPANDED    = 'expanded';
  const STYLE_NESTED      = 'nested';
  /**#@-*/

  const INDENT = '  ';

  /**
   * Returns the renderer for the required render style.
   * @param string $style render style
   * @return SassRenderer
   */
  public static function getRenderer($style)
  {
    switch ($style) {
      case self::STYLE_COMPACT:
        return new SassCompactRenderer();
      case self::STYLE_COMPRESSED:
        return new SassCompressedRenderer();
      case self::STYLE_EXPANDED:
        return new SassExpandedRenderer();
      case self::STYLE_NESTED:
        return new SassNestedRenderer();
    } // switch
  }
}
