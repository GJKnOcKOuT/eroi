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

/**
 * include.php
 *
 * @package default
 */


require "function_blank_lines.php";

require_once 'function_docblocks.php';

include_once "function_return_reference.php";

include DOCROOT."indent.php";

include $docroot . 'indent_elseif.php';

include $x."include.php";

include "include".$x.".php";

include $x;

include $x;

include $x.".php";

include "doesn't_exist";
