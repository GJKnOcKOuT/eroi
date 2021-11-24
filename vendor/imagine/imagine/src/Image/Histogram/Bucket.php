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
 * This file is part of the Imagine package.
 *
 * (c) Bulat Shakirzyanov <mallluhuct@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Imagine\Image\Histogram;

/**
 * Bucket histogram.
 */
final class Bucket implements \Countable
{
    /**
     * @var \Imagine\Image\Histogram\Range
     */
    private $range;

    /**
     * @var int
     */
    private $count;

    /**
     * @param \Imagine\Image\Histogram\Range $range
     * @param int $count
     */
    public function __construct(Range $range, $count = 0)
    {
        $this->range = $range;
        $this->count = $count;
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function add($value)
    {
        if ($this->range->contains($value)) {
            $this->count++;
        }

        return $this;
    }

    /**
     * @return int the number of elements in the bucket
     */
    public function count()
    {
        return $this->count;
    }
}
