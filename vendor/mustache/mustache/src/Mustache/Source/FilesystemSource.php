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
 * Mustache template Filesystem Source.
 *
 * This template Source uses stat() to generate the Source key, so that using
 * pre-compiled templates doesn't require hitting the disk to read the source.
 * It is more suitable for production use, and is used by default in the
 * ProductionFilesystemLoader.
 */
class Mustache_Source_FilesystemSource implements Mustache_Source
{
    private $fileName;
    private $statProps;
    private $stat;

    /**
     * Filesystem Source constructor.
     *
     * @param string $fileName
     * @param array  $statProps
     */
    public function __construct($fileName, array $statProps)
    {
        $this->fileName = $fileName;
        $this->statProps = $statProps;
    }

    /**
     * Get the Source key (used to generate the compiled class name).
     *
     * @throws RuntimeException when a source file cannot be read
     *
     * @return string
     */
    public function getKey()
    {
        $chunks = array(
            'fileName' => $this->fileName,
        );

        if (!empty($this->statProps)) {
            if (!isset($this->stat)) {
                $this->stat = @stat($this->fileName);
            }

            if ($this->stat === false) {
                throw new RuntimeException(sprintf('Failed to read source file "%s".', $this->fileName));
            }

            foreach ($this->statProps as $prop) {
                $chunks[$prop] = $this->stat[$prop];
            }
        }

        return json_encode($chunks);
    }

    /**
     * Get the template Source.
     *
     * @return string
     */
    public function getSource()
    {
        return file_get_contents($this->fileName);
    }
}
