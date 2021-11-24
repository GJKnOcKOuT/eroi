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
 * sect131r2
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

class sect131r2 extends Binary
{
    public function __construct()
    {
        $this->setModulo(131, 8, 3, 2, 0);
        $this->setCoefficients(
            '03E5A88919D7CAFCBF415F07C2176573B2',
            '04B8266A46C55657AC734CE38F018F2192'
        );
        $this->setBasePoint(
            '0356DCD8F2F95031AD652D23951BB366A8',
            '0648F06D867940A5366D9E265DE9EB240F'
        );
        $this->setOrder(new BigInteger('0400000000000000016954A233049BA98F', 16));
    }
}