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


namespace Mpdf\Pdf\Protection;

class UniqidGenerator
{

	public function __construct()
	{
		if (!function_exists('random_int') || !function_exists('random_bytes')) {
			throw new \Mpdf\MpdfException(
				'Unable to set PDF file protection, CSPRNG Functions are not available. '
				. 'Use paragonie/random_compat polyfill or upgrade to PHP 7.'
			);
		}
	}

	/**
	 * @return string
	 */
	public function generate()
	{
		$chars = 'ABCDEF1234567890';
		$id = '';

		for ($i = 0; $i < 32; $i++) {
			$id .= $chars[random_int(0, 15)];
		}

		return md5($id);
	}
}
