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

use Mpdf\Mpdf;

class Legend extends Tag
{

	public function open($attr, &$ahtml, &$ihtml)
	{
		$this->mpdf->InlineProperties['LEGEND'] = $this->mpdf->saveInlineProperties();
		$properties = $this->cssManager->MergeCSS('INLINE', 'LEGEND', $attr);
		if (!empty($properties)) {
			$this->mpdf->setCSS($properties, 'INLINE');
		}
	}

	public function close(&$ahtml, &$ihtml)
	{
		if (count($this->mpdf->textbuffer) && !$this->mpdf->tableLevel) {
			$leg = $this->mpdf->textbuffer[count($this->mpdf->textbuffer) - 1];
			unset($this->mpdf->textbuffer[count($this->mpdf->textbuffer) - 1]);
			$this->mpdf->textbuffer = array_values($this->mpdf->textbuffer);
			$this->mpdf->blk[$this->mpdf->blklvl]['border_legend'] = $leg;
			$this->mpdf->blk[$this->mpdf->blklvl]['margin_top'] += ($leg[11] / 2) / Mpdf::SCALE;
			$this->mpdf->blk[$this->mpdf->blklvl]['padding_top'] += ($leg[11] / 2) / Mpdf::SCALE;
		}
		if (isset($this->mpdf->InlineProperties['LEGEND'])) {
			$this->mpdf->restoreInlineProperties($this->mpdf->InlineProperties['LEGEND']);
		}
		unset($this->mpdf->InlineProperties['LEGEND']);
		$this->mpdf->ignorefollowingspaces = true; //Eliminate exceeding left-side spaces
	}
}
