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
 * This file is part of Mustache.php.
 *
 * (c) 2010-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require dirname(__FILE__) . '/../src/Mustache/Autoloader.php';
Mustache_Autoloader::register();
Mustache_Autoloader::register(dirname(__FILE__) . '/../test');

require dirname(__FILE__) . '/../vendor/yaml/lib/sfYamlParser.php';

/**
 * Minimal stream wrapper to test protocol-based access to templates.
 */
class TestStream
{
    private $filehandle;

    /**
     * Always returns false.
     *
     * @param string $path
     * @param int    $flags
     *
     * @return array
     */
    public function url_stat($path, $flags)
    {
        return false;
    }

    /**
     * Open the file.
     *
     * @param string $path
     * @param string $mode
     *
     * @return bool
     */
    public function stream_open($path, $mode)
    {
        $path = preg_replace('-^test://-', '', $path);
        $this->filehandle = fopen($path, $mode);

        return $this->filehandle !== false;
    }

    /**
     * @return array
     */
    public function stream_stat()
    {
        return array();
    }

    /**
     * @param int $count
     *
     * @return string
     */
    public function stream_read($count)
    {
        return fgets($this->filehandle, $count);
    }

    /**
     * @return bool
     */
    public function stream_eof()
    {
        return feof($this->filehandle);
    }

    /**
     * @return bool
     */
    public function stream_close()
    {
        return fclose($this->filehandle);
    }
}

if (!stream_wrapper_register('test', 'TestStream')) {
    die('Failed to register protocol');
}
