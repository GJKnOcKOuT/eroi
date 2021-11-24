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


/*
 * This file is part of composer/xdebug-handler.
 *
 * (c) Composer <https://github.com/composer>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Composer\XdebugHandler;

/**
 * Process utility functions
 *
 * @author John Stevenson <john-stevenson@blueyonder.co.uk>
 */
class Process
{
    /**
     * Escapes a string to be used as a shell argument.
     *
     * From https://github.com/johnstevenson/winbox-args
     * MIT Licensed (c) John Stevenson <john-stevenson@blueyonder.co.uk>
     *
     * @param string $arg  The argument to be escaped
     * @param bool   $meta Additionally escape cmd.exe meta characters
     * @param bool $module The argument is the module to invoke
     *
     * @return string The escaped argument
     */
    public static function escape($arg, $meta = true, $module = false)
    {
        if (!defined('PHP_WINDOWS_VERSION_BUILD')) {
            return "'".str_replace("'", "'\\''", $arg)."'";
        }

        $quote = strpbrk($arg, " \t") !== false || $arg === '';

        $arg = preg_replace('/(\\\\*)"/', '$1$1\\"', $arg, -1, $dquotes);

        if ($meta) {
            $meta = $dquotes || preg_match('/%[^%]+%/', $arg);

            if (!$meta) {
                $quote = $quote || strpbrk($arg, '^&|<>()') !== false;
            } elseif ($module && !$dquotes && $quote) {
                $meta = false;
            }
        }

        if ($quote) {
            $arg = '"'.preg_replace('/(\\\\*)$/', '$1$1', $arg).'"';
        }

        if ($meta) {
            $arg = preg_replace('/(["^&|<>()%])/', '^$1', $arg);
        }

        return $arg;
    }

    /**
     * Escapes an array of arguments that make up a shell command
     *
     * @param array $args Argument list, with the module name first
     *
     * @return string The escaped command line
     */
    public static function escapeShellCommand(array $args)
    {
        $cmd = self::escape(array_shift($args), true, true);
        foreach ($args as $arg) {
            $cmd .= ' '.self::escape($arg);
        }

        return $cmd;
    }

    /**
     * Makes putenv environment changes available in $_SERVER and $_ENV
     *
     * @param string $name
     * @param string|null $value A null value unsets the variable
     *
     * @return bool Whether the environment variable was set
     */
    public static function setEnv($name, $value = null)
    {
        $unset = null === $value;

        if (!putenv($unset ? $name : $name.'='.$value)) {
            return false;
        }

        if ($unset) {
            unset($_SERVER[$name]);
        } else {
            $_SERVER[$name] = $value;
        }

        // Update $_ENV if it is being used
        if (false !== stripos((string) ini_get('variables_order'), 'E')) {
            if ($unset) {
                unset($_ENV[$name]);
            } else {
                $_ENV[$name] = $value;
            }
        }

        return true;
    }
}
