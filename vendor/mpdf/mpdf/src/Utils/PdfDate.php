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


namespace Mpdf\Utils;

class PdfDate
{

	/**
	 * PDF documents use the internal date format: (D:YYYYMMDDHHmmSSOHH'mm'). The date format has these parts:
	 *
	 *   YYYY The full four-digit year. (For example, 2004)
	 *   MM   The month from 01 to 12.
	 *   DD   The day from 01 to 31.
	 *   HH   The hour from 00 to 23.
	 *   mm   The minute from 00 to 59.
	 *   SS   The seconds from 00 to 59.
	 *   O    The relationship of local time to Universal Time (UT), as denoted by one of the characters +, -, or Z.
	 *   HH   The absolute value of the offset from UT in hours specified as 00 to 23.
	 *   mm   The absolute value of the offset from UT in minutes specified as 00 to 59.
	 *
	 * @return string
	 */
	public static function format($date)
	{
		$z = date('O'); // +0200
		$offset = substr($z, 0, 3) . "'" . substr($z, 3, 2) . "'"; // +02'00'
		return date('YmdHis', $date) . $offset;
	}

}
