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
 * Function code for the complex argument() function
 *
 * @copyright  Copyright (c) 2013-2018 Mark Baker (https://github.com/MarkBaker/PHPComplex)
 * @license    https://opensource.org/licenses/MIT    MIT
 */
namespace Complex;

/**
 * Returns the argument of a complex number.
 * Also known as the theta of the complex number, i.e. the angle in radians
 *   from the real axis to the representation of the number in polar coordinates.
 *
 * This function is a synonym for theta()
 *
 * @param     Complex|mixed    $complex    Complex number or a numeric value.
 * @return    float            The argument (or theta) value of the complex argument.
 * @throws    Exception        If argument isn't a valid real or complex number.
 *
 * @see    theta
 */
function argument($complex)
{
    return theta($complex);
}
