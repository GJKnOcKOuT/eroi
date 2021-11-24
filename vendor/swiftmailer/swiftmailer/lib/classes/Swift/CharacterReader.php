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
 * Analyzes characters for a specific character set.
 *
 * @author Chris Corbyn
 * @author Xavier De Cock <xdecock@gmail.com>
 */
interface Swift_CharacterReader
{
    const MAP_TYPE_INVALID = 0x01;
    const MAP_TYPE_FIXED_LEN = 0x02;
    const MAP_TYPE_POSITIONS = 0x03;

    /**
     * Returns the complete character map.
     *
     * @param string $string
     * @param int    $startOffset
     * @param array  $currentMap
     * @param mixed  $ignoredChars
     *
     * @return int
     */
    public function getCharPositions($string, $startOffset, &$currentMap, &$ignoredChars);

    /**
     * Returns the mapType, see constants.
     *
     * @return int
     */
    public function getMapType();

    /**
     * Returns an integer which specifies how many more bytes to read.
     *
     * A positive integer indicates the number of more bytes to fetch before invoking
     * this method again.
     *
     * A value of zero means this is already a valid character.
     * A value of -1 means this cannot possibly be a valid character.
     *
     * @param int[] $bytes
     * @param int   $size
     *
     * @return int
     */
    public function validateByteSequence($bytes, $size);

    /**
     * Returns the number of bytes which should be read to start each character.
     *
     * For fixed width character sets this should be the number of octets-per-character.
     * For multibyte character sets this will probably be 1.
     *
     * @return int
     */
    public function getInitialByteSize();
}
