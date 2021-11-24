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


/**
 *
 * Class for the creating "special" Matrices
 *
 * @copyright  Copyright (c) 2018 Mark Baker (https://github.com/MarkBaker/PHPMatrix)
 * @license    https://opensource.org/licenses/MIT    MIT
 */

namespace Matrix;

/**
 * Matrix Builder class.
 *
 * @package Matrix
 */
class Builder
{
    /**
     * Create a new matrix of specified dimensions, and filled with a specified value
     * If the column argument isn't provided, then a square matrix will be created
     *
     * @param mixed $value
     * @param int $rows
     * @param int|null $columns
     * @return Matrix
     * @throws Exception
     */
    public static function createFilledMatrix($value, $rows, $columns = null)
    {
        if ($columns === null) {
            $columns = $rows;
        }

        $rows = Matrix::validateRow($rows);
        $columns = Matrix::validateColumn($columns);

        return new Matrix(
            array_fill(
                0,
                $rows,
                array_fill(
                    0,
                    $columns,
                    $value
                )
            )
        );
    }

    /**
     * Create a new identity matrix of specified dimensions
     * This will always be a square matrix, with the number of rows and columns matching the provided dimension
     *
     * @param int $dimensions
     * @return Matrix
     * @throws Exception
     */
    public static function createIdentityMatrix($dimensions)
    {
        $grid = static::createFilledMatrix(null, $dimensions)->toArray();

        for ($x = 0; $x < $dimensions; ++$x) {
            $grid[$x][$x] = 1;
        }

        return new Matrix($grid);
    }
}
