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
 * Function code for the complex tanh() function
 *
 * @copyright  Copyright (c) 2013-2018 Mark Baker (https://github.com/MarkBaker/PHPComplex)
 * @license    https://opensource.org/licenses/MIT    MIT
 */
namespace Complex;

/**
 * Returns the hyperbolic tangent of a complex number.
 *
 * @param     Complex|mixed    $complex    Complex number or a numeric value.
 * @return    Complex          The hyperbolic tangent of the complex argument.
 * @throws    Exception        If argument isn't a valid real or complex number.
 * @throws    \InvalidArgumentException    If function would result in a division by zero
 */
function tanh($complex)
{
    $complex = Complex::validateComplexArgument($complex);
    $real = $complex->getReal();
    $imaginary = $complex->getImaginary();
    $divisor = \cos($imaginary) * \cos($imaginary) + \sinh($real) * \sinh($real);
    if ($divisor == 0.0) {
        throw new \InvalidArgumentException('Division by zero');
    }

    return new Complex(
        \sinh($real) * \cosh($real) / $divisor,
        0.5 * \sin(2 * $imaginary) / $divisor,
        $complex->getSuffix()
    );
}
