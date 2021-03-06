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
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Imagine\File;

/**
 * Interface for classes that can load local or remote files.
 */
interface LoaderInterface
{
    /**
     * Is this a local file.
     *
     * @return bool
     */
    public function isLocalFile();

    /**
     * Get the path of the file (local or remote).
     *
     * @return string
     */
    public function getPath();

    /**
     * Is the binary content already loaded?
     *
     * @return bool
     */
    public function hasReadData();

    /**
     * Get the file binary contents.
     *
     * @return string
     */
    public function getData();

    /**
     * The string representation of this object must be the file path (local or remote).
     *
     * @return string
     */
    public function __toString();
}
