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

namespace Imagine\Filter\Basic;

use Imagine\Filter\FilterInterface;
use Imagine\Image\ImageInterface;
use Imagine\Image\Palette\Color\ColorInterface;

/**
 * A rotate filter.
 */
class Rotate implements FilterInterface
{
    /**
     * @var int
     */
    private $angle;

    /**
     * @var \Imagine\Image\Palette\Color\ColorInterface
     */
    private $background;

    /**
     * Constructs Rotate filter with given angle and background color.
     *
     * @param int $angle
     * @param \Imagine\Image\Palette\Color\ColorInterface $background
     */
    public function __construct($angle, ColorInterface $background = null)
    {
        $this->angle = $angle;
        $this->background = $background;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Imagine\Filter\FilterInterface::apply()
     */
    public function apply(ImageInterface $image)
    {
        return $image->rotate($this->angle, $this->background);
    }
}
