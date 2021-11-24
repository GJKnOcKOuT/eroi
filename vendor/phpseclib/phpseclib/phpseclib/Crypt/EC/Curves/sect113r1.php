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
 * sect113r1
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

class sect113r1 extends Binary
{
    public function __construct()
    {
        $this->setModulo(113, 9, 0);
        $this->setCoefficients(
            '003088250CA6E7C7FE649CE85820F7',
            '00E8BEE4D3E2260744188BE0E9C723'
        );
        $this->setBasePoint(
            '009D73616F35F4AB1407D73562C10F',
            '00A52830277958EE84D1315ED31886'
        );
        $this->setOrder(new BigInteger('0100000000000000D9CCEC8A39E56F', 16));
    }
}