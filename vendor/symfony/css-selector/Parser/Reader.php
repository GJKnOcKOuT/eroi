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

namespace Symfony\Component\CssSelector\Parser;

/**
 * CSS selector reader.
 *
 * This component is a port of the Python cssselect library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 *
 * @internal
 */
class Reader
{
    /**
     * @var string
     */
    private $source;

    /**
     * @var int
     */
    private $length;

    /**
     * @var int
     */
    private $position = 0;

    /**
     * @param string $source
     */
    public function __construct($source)
    {
        $this->source = $source;
        $this->length = strlen($source);
    }

    /**
     * @return bool
     */
    public function isEOF()
    {
        return $this->position >= $this->length;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return int
     */
    public function getRemainingLength()
    {
        return $this->length - $this->position;
    }

    /**
     * @param int $length
     * @param int $offset
     *
     * @return string
     */
    public function getSubstring($length, $offset = 0)
    {
        return substr($this->source, $this->position + $offset, $length);
    }

    /**
     * @param string $string
     *
     * @return int
     */
    public function getOffset($string)
    {
        $position = strpos($this->source, $string, $this->position);

        return false === $position ? false : $position - $this->position;
    }

    /**
     * @param string $pattern
     *
     * @return bool
     */
    public function findPattern($pattern)
    {
        $source = substr($this->source, $this->position);

        if (preg_match($pattern, $source, $matches)) {
            return $matches;
        }

        return false;
    }

    /**
     * @param int $length
     */
    public function moveForward($length)
    {
        $this->position += $length;
    }

    /**
     */
    public function moveToEnd()
    {
        $this->position = $this->length;
    }
}
