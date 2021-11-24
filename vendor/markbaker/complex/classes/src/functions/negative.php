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
 * Function code for the complex negative() function
 *
 * @copyright  Copyright (c) 2013-2018 Mark Baker (https://github.com/MarkBaker/PHPComplex)
 * @license    https://opensource.org/licenses/MIT    MIT
 */
namespace Complex;

/**
 * Returns the negative of a complex number.
 *
 * @param     Complex|mixed    $complex    Complex number or a numeric value.
 * @return    float            The negative value of the complex argument.
 * @throws    Exception        If argument isn't a valid real or complex number.
 *
 * @see    rho
 *
 */
function negative($complex)
{
    $complex = Complex::validateComplexArgument($complex);

    return new Complex(
        -1 * $complex->getReal(),
        -1 * $complex->getImaginary(),
        $complex->getSuffix()
    );
}
