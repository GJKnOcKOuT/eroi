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


require "vendor/autoload.php";
require "compass.inc.php";

$scss = new scssc();
new scss_compass($scss);

echo $scss->compile('
	@import "compass";
	
	div {
		@include box-shadow(10px 10px 8px red);
	}
');

