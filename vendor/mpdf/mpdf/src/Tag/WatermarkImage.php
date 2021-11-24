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


namespace Mpdf\Tag;

class WatermarkImage extends Tag
{

	public function open($attr, &$ahtml, &$ihtml)
	{
		$src = '';
		if (isset($attr['SRC'])) {
			$src = $attr['SRC'];
		}

		$alpha = -1;
		if (isset($attr['ALPHA']) && $attr['ALPHA'] > 0) {
			$alpha = $attr['ALPHA'];
		}

		$size = 'D';
		if (!empty($attr['SIZE'])) {
			$size = $attr['SIZE'];
			if (strpos($size, ',')) {
				$size = explode(',', $size);
			}
		}

		$pos = 'P';
		if (!empty($attr['POSITION'])) {  // mPDF 5.7.2
			$pos = $attr['POSITION'];
			if (strpos($pos, ',')) {
				$pos = explode(',', $pos);
			}
		}
		$this->mpdf->SetWatermarkImage($src, $alpha, $size, $pos);
	}

	public function close(&$ahtml, &$ihtml)
	{
	}
}
