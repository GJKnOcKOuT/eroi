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

namespace Symfony\Component\Process\Pipes;

/**
 * PipesInterface manages descriptors and pipes for the use of proc_open.
 *
 * @author Romain Neutron <imprec@gmail.com>
 *
 * @internal
 */
interface PipesInterface
{
    const CHUNK_SIZE = 16384;

    /**
     * Returns an array of descriptors for the use of proc_open.
     *
     * @return array
     */
    public function getDescriptors();

    /**
     * Returns an array of filenames indexed by their related stream in case these pipes use temporary files.
     *
     * @return string[]
     */
    public function getFiles();

    /**
     * Reads data in file handles and pipes.
     *
     * @param bool $blocking Whether to use blocking calls or not
     * @param bool $close    Whether to close pipes if they've reached EOF
     *
     * @return string[] An array of read data indexed by their fd
     */
    public function readAndWrite($blocking, $close = false);

    /**
     * Returns if the current state has open file handles or pipes.
     *
     * @return bool
     */
    public function areOpen();

    /**
     * Returns if pipes are able to read output.
     *
     * @return bool
     */
    public function haveReadSupport();

    /**
     * Closes file handles and pipes.
     */
    public function close();
}
