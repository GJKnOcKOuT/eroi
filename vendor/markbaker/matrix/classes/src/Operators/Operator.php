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


namespace Matrix\Operators;

use Matrix\Matrix;
use Matrix\Exception;

abstract class Operator
{
    /**
     * Stored internally as a 2-dimension array of values
     *
     * @property mixed[][] $matrix
     **/
    protected $matrix;

    /**
     * Number of rows in the matrix
     *
     * @property integer $rows
     **/
    protected $rows;

    /**
     * Number of columns in the matrix
     *
     * @property integer $columns
     **/
    protected $columns;

    /**
     * Create an new handler object for the operation
     *
     * @param Matrix $matrix The base Matrix object on which the operation will be performed
     */
    public function __construct(Matrix $matrix)
    {
        $this->rows = $matrix->rows;
        $this->columns = $matrix->columns;
        $this->matrix = $matrix->toArray();
    }

    /**
     * Compare the dimensions of the matrices being operated on to see if they are valid for addition/subtraction
     *
     * @param Matrix $matrix The second Matrix object on which the operation will be performed
     * @throws Exception
     */
    protected function validateMatchingDimensions(Matrix $matrix)
    {
        if (($this->rows != $matrix->rows) || ($this->columns != $matrix->columns)) {
            throw new Exception('Matrices have mismatched dimensions');
        }
    }

    /**
     * Compare the dimensions of the matrices being operated on to see if they are valid for multiplication/division
     *
     * @param Matrix $matrix The second Matrix object on which the operation will be performed
     * @throws Exception
     */
    protected function validateReflectingDimensions(Matrix $matrix)
    {
        if ($this->columns != $matrix->rows) {
            throw new Exception('Matrices have mismatched dimensions');
        }
    }

    /**
     * Return the result of the operation
     *
     * @return Matrix
     */
    public function result()
    {
        return new Matrix($this->matrix);
    }
}
