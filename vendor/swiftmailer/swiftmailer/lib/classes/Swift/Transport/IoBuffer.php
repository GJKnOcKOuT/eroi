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
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Buffers input and output to a resource.
 *
 * @author Chris Corbyn
 */
interface Swift_Transport_IoBuffer extends Swift_InputByteStream, Swift_OutputByteStream
{
    /** A socket buffer over TCP */
    const TYPE_SOCKET = 0x0001;

    /** A process buffer with I/O support */
    const TYPE_PROCESS = 0x0010;

    /**
     * Perform any initialization needed, using the given $params.
     *
     * Parameters will vary depending upon the type of IoBuffer used.
     */
    public function initialize(array $params);

    /**
     * Set an individual param on the buffer (e.g. switching to SSL).
     *
     * @param string $param
     * @param mixed  $value
     */
    public function setParam($param, $value);

    /**
     * Perform any shutdown logic needed.
     */
    public function terminate();

    /**
     * Set an array of string replacements which should be made on data written
     * to the buffer.
     *
     * This could replace LF with CRLF for example.
     *
     * @param string[] $replacements
     */
    public function setWriteTranslations(array $replacements);

    /**
     * Get a line of output (including any CRLF).
     *
     * The $sequence number comes from any writes and may or may not be used
     * depending upon the implementation.
     *
     * @param int $sequence of last write to scan from
     *
     * @return string
     */
    public function readLine($sequence);
}
