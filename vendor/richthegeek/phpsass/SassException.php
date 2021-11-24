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

/**
 * General Sass exception.
 *
 * @author       Chris Yates <chris.l.yates@gmail.com>
 * @copyright    Copyright (c) 2010 PBM Web Development
 * @license      http://phamlp.googlecode.com/files/license.txt
 * @package      PHamlP
 * @subpackage   Sass
 */

/**
 * Sass exception class.
 *
 * @package      PHamlP
 * @subpackage   Sass
 */
class SassException extends Exception {

	/**
	 * Sass Exception.
	 *
	 * @param string $message                Exception message
	 * @param mixed  $additionalMessageMixed mixed resource for meta data
	 */
	public function __construct($message, $additionalMessageMixed = '') {
		if (is_object($additionalMessageMixed)) {
			$additionalMessageMixed = ": {$additionalMessageMixed->filename}::{$additionalMessageMixed->line}\nSource: {$additionalMessageMixed->source}";
		} else if (is_array($additionalMessageMixed)) {
			$additionalMessageMixed = var_export($additionalMessageMixed, TRUE);
		} else if (!is_scalar($additionalMessageMixed)) {
			$additionalMessageMixed = '';
		}
		parent::__construct($message . $additionalMessageMixed);
	}
}
