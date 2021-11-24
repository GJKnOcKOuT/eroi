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


namespace Mpdf\Css;

class TextVars
{

	// font-decoration
	const FD_UNDERLINE = 1;
	const FD_LINETHROUGH = 2;
	const FD_OVERLINE = 4;

	// font-(vertical)-align
	const FA_SUPERSCRIPT = 8;
	const FA_SUBSCRIPT = 16;

	// font-transform
	const FT_UPPERCASE = 32;
	const FT_LOWERCASE = 64;
	const FT_CAPITALIZE = 128;

	// font-(other)-controls
	const FC_KERNING = 256;
	const FC_SMALLCAPS = 512;
}
