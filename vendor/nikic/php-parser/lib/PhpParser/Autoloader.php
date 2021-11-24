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


namespace PhpParser;

/**
 * @codeCoverageIgnore
 */
class Autoloader
{
    /** @var bool Whether the autoloader has been registered. */
    private static $registered = false;

    /**
     * Registers PhpParser\Autoloader as an SPL autoloader.
     *
     * @param bool $prepend Whether to prepend the autoloader instead of appending
     */
    static public function register($prepend = false) {
        if (self::$registered === true) {
            return;
        }

        spl_autoload_register(array(__CLASS__, 'autoload'), true, $prepend);
        self::$registered = true;
    }

    /**
     * Handles autoloading of classes.
     *
     * @param string $class A class name.
     */
    static public function autoload($class) {
        if (0 === strpos($class, 'PhpParser\\')) {
            $fileName = __DIR__ . strtr(substr($class, 9), '\\', '/') . '.php';
            if (file_exists($fileName)) {
                require $fileName;
            }
        }
    }
}
