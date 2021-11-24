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

class ErrorHandlerThatUsesThePreviousOne
{
    private static $previous;

    public static function register()
    {
        $handler = new static();

        self::$previous = set_error_handler([$handler, 'handleError']);

        return $handler;
    }

    public function handleError()
    {
        return \call_user_func_array(self::$previous, \func_get_args());
    }
}
