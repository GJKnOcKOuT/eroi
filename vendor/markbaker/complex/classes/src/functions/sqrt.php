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
 * Function code for the complex sqrt() function
 *
 * @copyright  Copyright (c) 2013-2018 Mark Baker (https://github.com/MarkBaker/PHPComplex)
 * @license    https://opensource.org/licenses/MIT    MIT
 */
namespace Complex;

/**
 * Returns the square root of a complex number.
 *
 * @param     Complex|mixed    $complex    Complex number or a numeric value.
 * @return    Complex          The Square root of the complex argument.
 * @throws    Exception        If argument isn't a valid real or complex number.
 */
function sqrt($complex)
{
    $complex = Complex::validateComplexArgument($complex);

    $theta = theta($complex);
    $delta1 = \cos($theta / 2);
    $delta2 = \sin($theta / 2);
    $rho = \sqrt(rho($complex));

    return new Complex($delta1 * $rho, $delta2 * $rho, $complex->getSuffix());
}
