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


include_once dirname(__FILE__).'/Complex.php';

class complexAssert
{
    private $_errorMessage    = '';

    public function assertComplexEquals($expected, $actual, $delta = 0)
    {
        if ($expected{0} === '#') {
            //    Expecting an error, so we do a straight string comparison
            if ($expected === $actual) {
                return true;
            }
            $this->_errorMessage = 'Expected Error: ' . $actual . ' !== ' . $expected;
            return false;
        }

        $expectedComplex = new Complex($expected);
        $actualComplex = new Complex($actual);

        if (!is_numeric($actualComplex->getReal()) || !is_numeric($expectedComplex->getReal())) {
            if ($actualComplex->getReal() !== $expectedComplex->getReal()) {
                $this->_errorMessage = 'Mismatched String: ' . $actualComplex->getReal() . ' !== ' . $expectedComplex->getReal();
                return false;
            }
            return true;
        }

        if ($actualComplex->getReal() < ($expectedComplex->getReal() - $delta) ||
            $actualComplex->getReal() > ($expectedComplex->getReal() + $delta)) {
            $this->_errorMessage = 'Mismatched Real part: ' . $actualComplex->getReal() . ' != ' . $expectedComplex->getReal();
            return false;
        }

        if ($actualComplex->getImaginary() < ($expectedComplex->getImaginary() - $delta) ||
            $actualComplex->getImaginary() > ($expectedComplex->getImaginary() + $delta)) {
            $this->_errorMessage = 'Mismatched Imaginary part: ' . $actualComplex->getImaginary() . ' != ' . $expectedComplex->getImaginary();
            return false;
        }

        if ($actualComplex->getSuffix() !== $actualComplex->getSuffix()) {
            $this->_errorMessage = 'Mismatched Suffix: ' . $actualComplex->getSuffix() . ' != ' . $expectedComplex->getSuffix();
            return false;
        }

        return true;
    }

    public function getErrorMessage()
    {
        return $this->_errorMessage;
    }
}
