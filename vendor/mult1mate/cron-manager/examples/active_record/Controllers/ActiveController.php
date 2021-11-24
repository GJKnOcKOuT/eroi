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
 * @author mult1mate
 */
class ActiveController extends BaseController
{

    public function index()
    {

    }

    public function randomResult()
    {
        $rand = rand(1, 4);
        echo 'The winner is number ' . $rand . PHP_EOL;
        switch ($rand) {
            case 1:
                return true;
            case 2:
                return false;
            case 3:
                throw new Exception('Unexpected situation');
            case 4:
                $micro_seconds = rand(1000000, 4000000);
                echo 'Going to wait for some time' . PHP_EOL;
                usleep($micro_seconds);
                return true;
        }
        return false;
    }
}
