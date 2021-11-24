--TEST--
Test catching fatal errors when handlers are nested
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


namespace Symfony\Component\Debug;

$vendor = __DIR__;
while (!file_exists($vendor.'/vendor')) {
    $vendor = \dirname($vendor);
}
require $vendor.'/vendor/autoload.php';

Debug::enable();
ini_set('display_errors', 0);

$eHandler = set_error_handler('var_dump');
$xHandler = set_exception_handler('var_dump');

var_dump([
    $eHandler[0] === $xHandler[0] ? 'Error and exception handlers do match' : 'Error and exception handlers are different',
]);

$eHandler[0]->setExceptionHandler('print_r');

if (true) {
    class Broken implements \Serializable
    {
    }
}

?>
--EXPECTF--
array(1) {
  [0]=>
  string(37) "Error and exception handlers do match"
}
object(Symfony\Component\Debug\Exception\FatalErrorException)#%d (%d) {
  ["message":protected]=>
  string(199) "Error: Class Symfony\Component\Debug\Broken contains 2 abstract methods and must therefore be declared abstract or implement the remaining methods (Serializable::serialize, Serializable::unserialize)"
%a
}
