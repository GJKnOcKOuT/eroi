--TEST--
Test catching fatal errors when handlers are nested
--INI--
display_errors=0
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

set_error_handler('var_dump');
set_exception_handler('var_dump');

ErrorHandler::register(null, false);

if (true) {
    class foo extends missing
    {
    }
}

?>
--EXPECTF--
object(Symfony\Component\Debug\Exception\ClassNotFoundException)#%d (8) {
  ["message":protected]=>
  string(131) "Attempted to load class "missing" from namespace "Symfony\Component\Debug".
Did you forget a "use" statement for another namespace?"
  ["string":"Exception":private]=>
  string(0) ""
  ["code":protected]=>
  int(0)
  ["file":protected]=>
  string(%d) "%s"
  ["line":protected]=>
  int(%d)
  ["trace":"Exception":private]=>
  array(%d) {%A}
  ["previous":"Exception":private]=>
  NULL
  ["severity":protected]=>
  int(1)
}
