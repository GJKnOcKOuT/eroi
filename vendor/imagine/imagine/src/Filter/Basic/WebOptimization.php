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
use Imagine\Image\Palette\RGB;

/**
 * A filter to render web-optimized images.
 */
class WebOptimization implements FilterInterface
{
    /**
     * @var \Imagine\Image\Palette\RGB
     */
    private $palette;

    /**
     * @var string|callable|null
     */
    private $path;

    /**
     * @var array
     */
    private $options;

    /**
     * @param string|callable|null $path
     * @param array $options
     */
    public function __construct($path = null, array $options = array())
    {
        $this->path = $path;
        $this->options = array_replace(array(
            'resolution-units' => ImageInterface::RESOLUTION_PIXELSPERINCH,
            'resolution-y' => 72,
            'resolution-x' => 72,
        ), $options);
        $this->palette = new RGB();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Imagine\Filter\FilterInterface::apply()
     */
    public function apply(ImageInterface $image)
    {
        $image
            ->usePalette($this->palette)
            ->strip();

        if (is_callable($this->path)) {
            $path = call_user_func($this->path, $image);
        } elseif (null !== $this->path) {
            $path = $this->path;
        } else {
            return $image;
        }

        return $image->save($path, $this->options);
    }
}
