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
 * Function code for the complex theta() function
 *
 * @copyright  Copyright (c) 2013-2018 Mark Baker (https://github.com/MarkBaker/PHPComplex)
 * @license    https://opensource.org/licenses/MIT    MIT
 */
namespace Complex;

/**
 * Returns the theta of a complex number.
 *   This is the angle in radians from the real axis to the representation of the number in polar coordinates.
 *
 * @param     Complex|mixed    $complex    Complex number or a numeric value.
 * @return    float            The theta value of the complex argument.
 * @throws    Exception        If argument isn't a valid real or complex number.
 */
function theta($complex)
{
    $complex = Complex::validateComplexArgument($complex);

    if ($complex->getReal() == 0.0) {
        if ($complex->isReal()) {
            return 0.0;
        } elseif ($complex->getImaginary() < 0.0) {
            return M_PI / -2;
        }
        return M_PI / 2;
    } elseif ($complex->getReal() > 0.0) {
        return \atan($complex->getImaginary() / $complex->getReal());
    } elseif ($complex->getImaginary() < 0.0) {
        return -(M_PI - \atan(\abs($complex->getImaginary()) / \abs($complex->getReal())));
    }

    return M_PI - \atan($complex->getImaginary() / \abs($complex->getReal()));
}
