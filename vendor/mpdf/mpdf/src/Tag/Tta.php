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

class Tta extends SubstituteTag
{

	public function open($attr, &$ahtml, &$ihtml)
	{
		$this->mpdf->tta = true;
		$this->mpdf->InlineProperties['TTA'] = $this->mpdf->saveInlineProperties();

		if (in_array($this->mpdf->FontFamily, $this->mpdf->mono_fonts)) {
			$this->mpdf->setCSS(['FONT-FAMILY' => 'ccourier'], 'INLINE');
		} elseif (in_array($this->mpdf->FontFamily, $this->mpdf->serif_fonts)) {
			$this->mpdf->setCSS(['FONT-FAMILY' => 'ctimes'], 'INLINE');
		} else {
			$this->mpdf->setCSS(['FONT-FAMILY' => 'chelvetica'], 'INLINE');
		}
	}

}
