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

spl_autoload_register(function ($class) {
    include 'phar://PHPExcel/' . str_replace('_', '/', $class) . '.php';
});

try {
    Phar::mapPhar();
    include 'phar://PHPExcel/PHPExcel.php';
} catch (PharException $e) {
    error_log($e->getMessage());
    exit(1);
}

__HALT_COMPILER();