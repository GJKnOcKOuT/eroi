--TEST--
Test DebugClassLoader with previously loaded parents
--FILE--
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


namespace Symfony\Component\Debug\Tests\Fixtures;

use Symfony\Component\Debug\DebugClassLoader;

$vendor = __DIR__;
while (!file_exists($vendor.'/vendor')) {
    $vendor = \dirname($vendor);
}
require $vendor.'/vendor/autoload.php';

class_exists(FinalMethod::class);

set_error_handler(function ($type, $msg) { echo $msg, "\n"; });

DebugClassLoader::enable();

class_exists(ExtendedFinalMethod::class);

?>
--EXPECTF--
The "Symfony\Component\Debug\Tests\Fixtures\FinalMethod::finalMethod()" method is considered final since version 3.3. It may change without further notice as of its next major version. You should not extend it from "Symfony\Component\Debug\Tests\Fixtures\ExtendedFinalMethod".
The "Symfony\Component\Debug\Tests\Fixtures\FinalMethod::finalMethod2()" method is considered final. It may change without further notice as of its next major version. You should not extend it from "Symfony\Component\Debug\Tests\Fixtures\ExtendedFinalMethod".
