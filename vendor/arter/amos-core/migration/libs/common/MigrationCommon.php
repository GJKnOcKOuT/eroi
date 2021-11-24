<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\core\migration\libs\common
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\migration\libs\common;

/**
 * Class MigrationCommon
 *
 * Common class for migrations libraries. There are common methods and utilities in this class.
 *
 * @package arter\amos\core\migration\libs\common
 */
class MigrationCommon
{
    /**
     * Useful to print a console message.
     * @param mixed $msg
     */
    public static function printConsoleMessage($msg)
    {
        print_r($msg);
        print_r("\n");
    }

    /**
     * Print console message for check structure.
     * @param array $authorization
     * @param string $msg
     */
    public static function printCheckStructureError($authorization, $msg)
    {
        self::printConsoleMessage($msg);
        self::printConsoleMessage($authorization);
    }
}
