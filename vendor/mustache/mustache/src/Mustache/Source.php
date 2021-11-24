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
 * This file is part of Mustache.php.
 *
 * (c) 2010-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Mustache template Source interface.
 */
interface Mustache_Source
{
    /**
     * Get the Source key (used to generate the compiled class name).
     *
     * This must return a distinct key for each template source. For example, an
     * MD5 hash of the template contents would probably do the trick. The
     * ProductionFilesystemLoader uses mtime and file path. If your production
     * source directory is under version control, you could use the current Git
     * rev and the file path...
     *
     * @throws RuntimeException when a source file cannot be read
     *
     * @return string
     */
    public function getKey();

    /**
     * Get the template Source.
     *
     * @throws RuntimeException when a source file cannot be read
     *
     * @return string
     */
    public function getSource();
}
