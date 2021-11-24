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
 * Function code for the complex pow() function
 *
 * @copyright  Copyright (c) 2013-2018 Mark Baker (https://github.com/MarkBaker/PHPComplex)
 * @license    https://opensource.org/licenses/MIT    MIT
 */
namespace Complex;

/**
 * Returns a complex number raised to a power.
 *
 * @param     Complex|mixed    $complex    Complex number or a numeric value.
 * @param     float|integer    $power      The power to raise this value to
 * @return    Complex          The complex argument raised to the real power.
 * @throws    Exception        If the power argument isn't a valid real
 */
function pow($complex, $power)
{
    $complex = Complex::validateComplexArgument($complex);

    if (!is_numeric($power)) {
        throw new Exception('Power argument must be a real number');
    }

    if ($complex->getImaginary() == 0.0 && $complex->getReal() >= 0.0) {
        return new Complex(\pow($complex->getReal(), $power));
    }

    $rValue = \sqrt(($complex->getReal() * $complex->getReal()) + ($complex->getImaginary() * $complex->getImaginary()));
    $rPower = \pow($rValue, $power);
    $theta = $complex->argument() * $power;
    if ($theta == 0) {
        return new Complex(1);
    }

    return new Complex($rPower * \cos($theta), $rPower * \sin($theta), $complex->getSuffix());
}
