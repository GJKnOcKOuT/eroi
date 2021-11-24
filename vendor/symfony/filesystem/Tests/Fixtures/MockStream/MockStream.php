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
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Filesystem\Tests\Fixtures\MockStream;

/**
 * Mock stream class to be used with stream_wrapper_register.
 * stream_wrapper_register('mock', 'Symfony\Component\Filesystem\Tests\Fixtures\MockStream\MockStream').
 */
class MockStream
{
    /**
     * Opens file or URL.
     *
     * @param string $path        Specifies the URL that was passed to the original function
     * @param string $mode        The mode used to open the file, as detailed for fopen()
     * @param int    $options     Holds additional flags set by the streams API
     * @param string $opened_path If the path is opened successfully, and STREAM_USE_PATH is set in options,
     *                            opened_path should be set to the full path of the file/resource that was actually opened
     *
     * @return bool
     */
    public function stream_open($path, $mode, $options, &$opened_path)
    {
        return true;
    }

    /**
     * @param string $path  The file path or URL to stat
     * @param array  $flags Holds additional flags set by the streams API
     *
     * @return array File stats
     */
    public function url_stat($path, $flags)
    {
        return [];
    }
}
