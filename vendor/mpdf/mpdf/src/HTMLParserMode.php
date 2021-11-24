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


namespace Mpdf;

class HTMLParserMode
{
	/**
	 * Parses a whole $html document
	 */
	const DEFAULT_MODE = 0;

	/**
	 * Parses the $html as styles and stylesheets only
	 */
	const HEADER_CSS = 1;

	/**
	 * Parses the $html as output elements only
	 */
	const HTML_BODY = 2;

	/**
	 * (For internal use only - parses the $html code without writing to document)
	 *
	 * @internal
	 */
	const HTML_PARSE_NO_WRITE = 3;

	/**
	 * (For internal use only - writes the $html code to a buffer)
	 *
	 * @internal
	 */
	const HTML_HEADER_BUFFER = 4;

	public static function getAllModes()
	{
		return [
			self::DEFAULT_MODE,
			self::HEADER_CSS,
			self::HTML_BODY,
			self::HTML_PARSE_NO_WRITE,
			self::HTML_HEADER_BUFFER,
		];
	}
}
