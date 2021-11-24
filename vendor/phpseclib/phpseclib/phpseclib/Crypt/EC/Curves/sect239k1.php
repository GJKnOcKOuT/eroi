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
 * sect239k1
 *
 * PHP version 5 and 7
 *
 * @category  Crypt
 * @package   EC
 * @author    Jim Wiggint  on <terrafrost@php.net>
 * @copyright 2017 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      http://pear.php.net/package/Math_BigInteger
 */

namespace phpseclib3\Crypt\EC\Curves;

use phpseclib3\Crypt\EC\BaseCurves\Binary;
use phpseclib3\Math\BigInteger;

class sect239k1 extends Binary
{
    public function __construct()
    {
        $this->setModulo(239, 158, 0);
        $this->setCoefficients(
            '000000000000000000000000000000000000000000000000000000000000',
            '000000000000000000000000000000000000000000000000000000000001'
        );
        $this->setBasePoint(
            '29A0B6A887A983E9730988A68727A8B2D126C44CC2CC7B2A6555193035DC',
            '76310804F12E549BDB011C103089E73510ACB275FC312A5DC6B76553F0CA'
        );
        $this->setOrder(new BigInteger('2000000000000000000000000000005A79FEC67CB6E91F1C1DA800E478A5', 16));
    }
}
