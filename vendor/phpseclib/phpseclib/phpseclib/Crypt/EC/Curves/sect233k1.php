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
 * sect233k1
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

use phpseclib3\Crypt\EC\BaseCurves\Binary;
use phpseclib3\Math\BigInteger;

class sect233k1 extends Binary
{
    public function __construct()
    {
        $this->setModulo(233, 74, 0);
        $this->setCoefficients(
            '000000000000000000000000000000000000000000000000000000000000',
            '000000000000000000000000000000000000000000000000000000000001'
        );
        $this->setBasePoint(
            '017232BA853A7E731AF129F22FF4149563A419C26BF50A4C9D6EEFAD6126',
            '01DB537DECE819B7F70F555A67C427A8CD9BF18AEB9B56E0C11056FAE6A3'
        );
        $this->setOrder(new BigInteger('8000000000000000000000000000069D5BB915BCD46EFB1AD5F173ABDF', 16));
    }
}
