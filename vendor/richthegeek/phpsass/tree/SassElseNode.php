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

/* SVN FILE: $Id: SassIfNode.php 49 2010-04-04 10:51:24Z chris.l.yates $ */
/**
 * SassElseNode class file.
 * @author      Chris Yates <chris.l.yates@gmail.com>
 * @copyright   Copyright (c) 2010 PBM Web Development
 * @license      http://phamlp.googlecode.com/files/license.txt
 * @package      PHamlP
 * @subpackage  Sass.tree
 */

/**
 * SassElseNode class.
 * Represents Sass Else If and Else statements.
 * Else If and Else statement nodes are chained below the If statement node.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassElseNode extends SassIfNode
{
  /**
   * SassElseNode constructor.
   * @param object $token source token
   * @return SassElseNode
   */
  public function __construct($token)
  {
    parent::__construct($token, false);
  }
}
