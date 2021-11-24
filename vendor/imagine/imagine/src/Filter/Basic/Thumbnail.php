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
use Imagine\Image\BoxInterface;
use Imagine\Image\ImageInterface;

/**
 * A thumbnail filter.
 */
class Thumbnail implements FilterInterface
{
    /**
     * @var \Imagine\Image\BoxInterface
     */
    private $size;

    /**
     * @var int|string
     */
    private $settings;

    /**
     * @var string
     */
    private $filter;

    /**
     * Constructs the Thumbnail filter.
     *
     * @param \Imagine\Image\BoxInterface $size
     * @param int|string $settings One or more of the ManipulatorInterface::THUMBNAIL_ flags (joined with |). It may be a string for backward compatibility with old constant values that were strings.
     * @param string $filter See ImageInterface::FILTER_... constants
     */
    public function __construct(BoxInterface $size, $settings = ImageInterface::THUMBNAIL_INSET, $filter = ImageInterface::FILTER_UNDEFINED)
    {
        $this->size = $size;
        $this->settings = $settings;
        $this->filter = $filter;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Imagine\Filter\FilterInterface::apply()
     */
    public function apply(ImageInterface $image)
    {
        return $image->thumbnail($this->size, $this->settings, $this->filter);
    }
}
