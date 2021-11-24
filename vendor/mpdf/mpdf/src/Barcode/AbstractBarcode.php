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


namespace Mpdf\Barcode;

abstract class AbstractBarcode
{

	/**
	 * @var mixed[]
	 */
	protected $data;

	/**
	 * @return mixed[]
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @param string $key
	 *
	 * @return mixed
	 */
	public function getKey($key)
	{
		return isset($this->data[$key]) ? $this->data[$key] : null;
	}

	/**
	 * @return string
	 */
	public function getChecksum()
	{
		return $this->getKey('checkdigit');
	}

	/**
	 * Convert binary barcode sequence to barcode array
	 *
	 * @param string $seq
	 * @param mixed[] $barcodeData
	 *
	 * @return mixed[]
	 */
	protected function binseqToArray($seq, array $barcodeData)
	{
		$len = strlen($seq);
		$w = 0;
		$k = 0;
		for ($i = 0; $i < $len; ++$i) {
			$w += 1;
			if (($i == ($len - 1)) or (($i < ($len - 1)) and ($seq[$i] != $seq[($i + 1)]))) {
				if ($seq[$i] == '1') {
					$t = true; // bar
				} else {
					$t = false; // space
				}
				$barcodeData['bcode'][$k] = ['t' => $t, 'w' => $w, 'h' => 1, 'p' => 0];
				$barcodeData['maxw'] += $w;
				++$k;
				$w = 0;
			}
		}
		return $barcodeData;
	}

}
