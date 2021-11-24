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
 * Function code for the complex atanh() function
 *
 * @copyright  Copyright (c) 2013-2018 Mark Baker (https://github.com/MarkBaker/PHPComplex)
 * @license    https://opensource.org/licenses/MIT    MIT
 */
namespace Complex;

/**
 * Returns the inverse hyperbolic tangent of a complex number.
 *
 * @param     Complex|mixed    $complex    Complex number or a numeric value.
 * @return    Complex          The inverse hyperbolic tangent of the complex argument.
 * @throws    Exception        If argument isn't a valid real or complex number.
 */
function atanh($complex)
{
    $complex = Complex::validateComplexArgument($complex);

    if ($complex->isReal()) {
        $real = $complex->getReal();
        if ($real >= -1.0 && $real <= 1.0) {
            return new Complex(\atanh($real));
        } else {
            return new Complex(\atanh(1 / $real), (($real < 0.0) ? M_PI_2 : -1 * M_PI_2));
        }
    }

    $iComplex = clone $complex;
    $iComplex = $iComplex->invertImaginary()
        ->reverse();
    return atan($iComplex)
        ->invertReal()
        ->reverse();
}
