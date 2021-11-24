--TEST--
Test symfony_debug_backtrace in case of fatal error
--SKIPIF--
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
 if (!extension_loaded('symfony_debug')) {
    echo 'skip';
} ?>
--FILE--
<?php

function bar()
{
    foo();
}

function foo()
{
    notexist();
}

function bt()
{
    print_r(symfony_debug_backtrace());
}

register_shutdown_function('bt');

bar();

?>
--EXPECTF--
Fatal error: Call to undefined function notexist() in %s on line %d
Array
(
    [0] => Array
        (
            [function] => bt
            [args] => Array
                (
                )

        )

    [1] => Array
        (
            [file] => %s
            [line] => %d
            [function] => foo
            [args] => Array
                (
                )

        )

    [2] => Array
        (
            [file] => %s
            [line] => %d
            [function] => bar
            [args] => Array
                (
                )

        )

)
