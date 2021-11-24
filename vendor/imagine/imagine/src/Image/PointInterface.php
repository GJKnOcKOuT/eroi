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

namespace Imagine\Image;

/**
 * The point interface.
 */
interface PointInterface
{
    /**
     * Gets points x coordinate.
     *
     * @return int
     */
    public function getX();

    /**
     * Gets points y coordinate.
     *
     * @return int
     */
    public function getY();

    /**
     * Checks if current coordinate is inside a given box.
     *
     * @param \Imagine\Image\BoxInterface $box
     *
     * @return bool
     */
    public function in(BoxInterface $box);

    /**
     * Returns another point, moved by a given amount from current coordinates.
     *
     * @param int $amount
     *
     * @return \Imagine\Image\PointInterface
     */
    public function move($amount);

    /**
     * Gets a string representation for the current point.
     *
     * @return string
     */
    public function __toString();
}
