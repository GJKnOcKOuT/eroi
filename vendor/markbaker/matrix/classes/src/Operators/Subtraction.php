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

class Subtraction extends Operator
{
    /**
     * Execute the subtraction
     *
     * @param mixed $value The matrix or numeric value to subtract from the current base value
     * @throws Exception If the provided argument is not appropriate for the operation
     * @return $this The operation object, allowing multiple subtractions to be chained
     **/
    public function execute($value)
    {
        if (is_array($value)) {
            $value = new Matrix($value);
        }

        if (is_object($value) && ($value instanceof Matrix)) {
            return $this->subtractMatrix($value);
        } elseif (is_numeric($value)) {
            return $this->subtractScalar($value);
        }

        throw new Exception('Invalid argument for subtraction');
    }

    /**
     * Execute the subtraction for a scalar
     *
     * @param mixed $value The numeric value to subtracted from the current base value
     * @return $this The operation object, allowing multiple additions to be chained
     **/
    protected function subtractScalar($value)
    {
        for ($row = 0; $row < $this->rows; ++$row) {
            for ($column = 0; $column < $this->columns; ++$column) {
                $this->matrix[$row][$column] -= $value;
            }
        }

        return $this;
    }

    /**
     * Execute the subtraction for a matrix
     *
     * @param Matrix $value The numeric value to subtract from the current base value
     * @return $this The operation object, allowing multiple subtractions to be chained
     * @throws Exception If the provided argument is not appropriate for the operation
     **/
    protected function subtractMatrix(Matrix $value)
    {
        $this->validateMatchingDimensions($value);

        for ($row = 0; $row < $this->rows; ++$row) {
            for ($column = 0; $column < $this->columns; ++$column) {
                $this->matrix[$row][$column] -= $value->getValue($row + 1, $column + 1);
            }
        }

        return $this;
    }
}
