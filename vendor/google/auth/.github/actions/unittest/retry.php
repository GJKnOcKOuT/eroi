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


function retry($f, $delay = 10, $retries = 3)
{
    try {
        return $f();
    } catch (Exception $e) {
        if ($retries > 0) {
            sleep($delay);
            return retry($f, $delay, $retries - 1);
        } else {
            throw $e;
        }
    }
}

retry(function () {
    global $argv;
    passthru($argv[1], $ret);

    if ($ret != 0) {
        throw new \Exception('err');
    }
}, 1);
