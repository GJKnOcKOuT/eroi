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
 * secp160r2
 *
 * PHP version 5 and 7
 *
 * @category  Crypt
 * @package   EC
 * @author    Jim Wigginton <terrafrost@php.net>
 * @copyright 2017 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      http://pear.php.net/package/Math_BigInteger
 */

namespace phpseclib3\Crypt\EC\Curves;

use phpseclib3\Crypt\EC\BaseCurves\Prime;
use phpseclib3\Math\BigInteger;

class secp160r2 extends Prime
{
    public function __construct()
    {
        // same as secp160k1
        $this->setModulo(new BigInteger('FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFEFFFFAC73', 16));
        $this->setCoefficients(
            new BigInteger('FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFEFFFFAC70', 16),
            new BigInteger('B4E134D3FB59EB8BAB57274904664D5AF50388BA', 16)
        );
        $this->setBasePoint(
            new BigInteger('52DCB034293A117E1F4FF11B30F7199D3144CE6D', 16),
            new BigInteger('FEAFFEF2E331F296E071FA0DF9982CFEA7D43F2E', 16)
        );
        $this->setOrder(new BigInteger('0100000000000000000000351EE786A818F3A1A16B', 16));
    }
}