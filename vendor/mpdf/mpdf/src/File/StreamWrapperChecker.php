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


namespace Mpdf\File;

use Mpdf\Mpdf;

final class StreamWrapperChecker
{

	private $mpdf;

	public function __construct(Mpdf $mpdf)
	{
		$this->mpdf = $mpdf;
	}

	/**
	 * @param string $filename
	 * @return bool
	 * @since 7.1.8
	 */
	public function hasBlacklistedStreamWrapper($filename)
	{
		if (strpos($filename, '://') > 0) {
			$wrappers = stream_get_wrappers();
			$whitelistStreamWrappers = $this->getWhitelistedStreamWrappers();
			foreach ($wrappers as $wrapper) {
				if (in_array($wrapper, $whitelistStreamWrappers)) {
					continue;
				}

				if (stripos($filename, $wrapper . '://') === 0) {
					return true;
				}
			}
		}

		return false;
	}

	public function getWhitelistedStreamWrappers()
	{
		return array_diff($this->mpdf->whitelistStreamWrappers, ['phar']); // remove 'phar' (security issue)
	}

}
