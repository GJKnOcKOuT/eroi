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
 * @copyright Copyright (c) 2014 Carsten Brandt
 * @license https://github.com/cebe/markdown/blob/master/LICENSE
 * @link https://github.com/cebe/markdown#readme
 */

namespace cebe\markdown\inline;

/**
 * Adds inline code elements
 */
trait CodeTrait
{
	/**
	 * Parses an inline code span `` ` ``.
	 * @marker `
	 */
	protected function parseInlineCode($text)
	{
		if (preg_match('/^(``+)\s(.+?)\s\1/s', $text, $matches)) { // code with enclosed backtick
			return [
				[
					'inlineCode',
					$matches[2],
				],
				strlen($matches[0])
			];
		} elseif (preg_match('/^`(.+?)`/s', $text, $matches)) {
			return [
				[
					'inlineCode',
					$matches[1],
				],
				strlen($matches[0])
			];
		}
		return [['text', $text[0]], 1];
	}

	protected function renderInlineCode($block)
	{
		return '<code>' . htmlspecialchars($block[1], ENT_NOQUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</code>';
	}
}
