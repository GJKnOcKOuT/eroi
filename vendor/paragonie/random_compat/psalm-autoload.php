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


require_once 'lib/byte_safe_strings.php';
require_once 'lib/cast_to_int.php';
require_once 'lib/error_polyfill.php';
require_once 'other/ide_stubs/libsodium.php';
require_once 'lib/random.php';

$int = random_int(0, 65536);
