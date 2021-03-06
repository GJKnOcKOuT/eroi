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

/* SVN FILE: $Id: SassDebugNode.php 49 2010-04-04 10:51:24Z chris.l.yates $ */
/**
 * SassDebugNode class file.
 * @author      Chris Yates <chris.l.yates@gmail.com>
 * @copyright   Copyright (c) 2010 PBM Web Development
 * @license      http://phamlp.googlecode.com/files/license.txt
 * @package      PHamlP
 * @subpackage  Sass.tree
 */

/**
 * SassDebugNode class.
 * Represents a Sass @debug or @warn directive.
 * @package      PHamlP
 * @subpackage  Sass.tree
 */
class SassDebugNode extends SassNode
{
  const IDENTIFIER = '@';
  const MATCH = '/^@(?:debug|warn)\s+(.+?)\s*;?$/';
  const MESSAGE = 1;

  /**
   * @var string the debug/warning message
   */
  private $message;
  /**
   * @var array parameters for the message;
   * only used by internal warning messages
   */
  private $params;
  /**
   * @var boolean true if this is a warning
   */
  private $warning;

  /**
   * SassDebugNode.
   * @param object $token source token
   * @param mixed string: an internally generated warning message about the
   * source
   * boolean: the source token is a @debug or @warn directive containing the
   * message; True if this is a @warn directive
   * @param array $message parameters for the message
   * @return SassDebugNode
   */
  public function __construct($token, $message = false)
  {
    parent::__construct($token);
    if (is_string($message)) {
      $this->message = $message;
      $this->warning = true;
    } else {
      preg_match(self::MATCH, $token->source, $matches);
      $this->message = $matches[self::MESSAGE];
      $this->warning = $message;
    }
  }

  /**
   * Parse this node.
   * This raises an error.
   * @return array An empty array
   */
  public function parse($context)
  {
    if (!$this->warning) {
      $result = $this->evaluate($this->message, $context)->toString();

      $cb = SassParser::$instance->options['callbacks']['debug'];
      if ($cb) {
        call_user_func($cb, $result, $context);
      } else {
        set_error_handler(array($this, 'errorHandler'));
        trigger_error($result);
        restore_error_handler();
      }
    }

    return array();
  }

  /**
   * Error handler for degug and warning statements.
   * @param int $errno Error number
   * @param string $message Message
   */
  public function errorHandler($errno, $message)
  {
    echo '<div style="background-color:#ce4dd6;border-bottom:1px dashed #88338d;color:white;font:10pt verdana;margin:0;padding:0.5em 2%;width:96%;"><p style="height:auto;margin:0.25em 0;padding:0;width:100%;"><span style="font-weight:bold;">SASS '.($this->warning ? 'WARNING' : 'DEBUG').":</span> $message</p><p style=\"margin:0.1em;padding:0;padding-left:0.5em;width:100%;\">{$this->filename}::{$this->line}</p><p style=\"margin:0.1em;padding:0;padding-left:0.5em;width:100%;\">Source: {$this->source}</p></div>";
  }
}
