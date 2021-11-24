--TEST--
Test rethrowing in custom exception handler
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

if (true) {
    class TestLogger extends \Psr\Log\AbstractLogger
    {
        public function log($level, $message, array $context = [])
        {
            echo $message, "\n";
        }
    }
}

set_exception_handler(function ($e) { echo 123; throw $e; });
ErrorHandler::register()->setDefaultLogger(new TestLogger());
ini_set('display_errors', 1);

throw new \Exception('foo');
?>
--EXPECTF--
Uncaught Exception: foo
123
Fatal error: Uncaught %s:25
Stack trace:
%a
