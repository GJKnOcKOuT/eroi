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
 * This file is part of sebastian/diff.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhpCsFixer\Diff\v2_0\Output;

abstract class AbstractChunkOutputBuilder implements DiffOutputBuilderInterface
{
    /**
     * Takes input of the diff array and returns the common parts.
     * Iterates through diff line by line.
     *
     * @param array $diff
     * @param int   $lineThreshold
     *
     * @return array
     */
    protected function getCommonChunks(array $diff, $lineThreshold = 5)
    {
        $diffSize     = \count($diff);
        $capturing    = false;
        $chunkStart   = 0;
        $chunkSize    = 0;
        $commonChunks = [];

        for ($i = 0; $i < $diffSize; ++$i) {
            if ($diff[$i][1] === 0 /* OLD */) {
                if ($capturing === false) {
                    $capturing  = true;
                    $chunkStart = $i;
                    $chunkSize  = 0;
                } else {
                    ++$chunkSize;
                }
            } elseif ($capturing !== false) {
                if ($chunkSize >= $lineThreshold) {
                    $commonChunks[$chunkStart] = $chunkStart + $chunkSize;
                }

                $capturing = false;
            }
        }

        if ($capturing !== false && $chunkSize >= $lineThreshold) {
            $commonChunks[$chunkStart] = $chunkStart + $chunkSize;
        }

        return $commonChunks;
    }
}
