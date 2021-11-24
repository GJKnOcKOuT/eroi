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
 * Function code for the complex division operation
 *
 * @copyright  Copyright (c) 2013-2018 Mark Baker (https://github.com/MarkBaker/PHPComplex)
 * @license    https://opensource.org/licenses/MIT    MIT
 */
namespace Complex;

/**
 * Divides two or more complex numbers
 *
 * @param     array of string|integer|float|Complex    $complexValues   The numbers to divide
 * @return    Complex
 */
function divideby(...$complexValues)
{
    if (count($complexValues) < 2) {
        throw new \Exception('This function requires at least 2 arguments');
    }

    $base = array_shift($complexValues);
    $result = clone Complex::validateComplexArgument($base);

    foreach ($complexValues as $complex) {
        $complex = Complex::validateComplexArgument($complex);

        if ($result->isComplex() && $complex->isComplex() &&
            $result->getSuffix() !== $complex->getSuffix()) {
            throw new Exception('Suffix Mismatch');
        }
        if ($complex->getReal() == 0.0 && $complex->getImaginary() == 0.0) {
            throw new \InvalidArgumentException('Division by zero');
        }

        $delta1 = ($result->getReal() * $complex->getReal()) +
            ($result->getImaginary() * $complex->getImaginary());
        $delta2 = ($result->getImaginary() * $complex->getReal()) -
            ($result->getReal() * $complex->getImaginary());
        $delta3 = ($complex->getReal() * $complex->getReal()) +
            ($complex->getImaginary() * $complex->getImaginary());

        $real = $delta1 / $delta3;
        $imaginary = $delta2 / $delta3;

        $result = new Complex(
            $real,
            $imaginary,
            ($imaginary == 0.0) ? null : max($result->getSuffix(), $complex->getSuffix())
        );
    }

    return $result;
}
