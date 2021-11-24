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
 * SCSSPHP
 *
 * @copyright 2015-2018 Leaf Corcoran
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 * @link http://leafo.github.io/scssphp
 */

namespace Leafo\ScssPhp\Base;

/**
 * Range
 *
 * @author Anthon Pang <anthon.pang@gmail.com>
 */
class Range
{
    public $first;
    public $last;

    /**
     * Initialize range
     *
     * @param integer|float $first
     * @param integer|float $last
     */
    public function __construct($first, $last)
    {
        $this->first = $first;
        $this->last = $last;
    }

    /**
     * Test for inclusion in range
     *
     * @param integer|float $value
     *
     * @return boolean
     */
    public function includes($value)
    {
        return $value >= $this->first && $value <= $this->last;
    }
}
