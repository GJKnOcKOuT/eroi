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
 * brainpoolP224r1
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

class brainpoolP224r1 extends Prime
{
    public function __construct()
    {
        $this->setModulo(new BigInteger('D7C134AA264366862A18302575D1D787B09F075797DA89F57EC8C0FF', 16));
        $this->setCoefficients(
            new BigInteger('68A5E62CA9CE6C1C299803A6C1530B514E182AD8B0042A59CAD29F43', 16),
            new BigInteger('2580F63CCFE44138870713B1A92369E33E2135D266DBB372386C400B', 16)
        );
        $this->setBasePoint(
            new BigInteger('0D9029AD2C7E5CF4340823B2A87DC68C9E4CE3174C1E6EFDEE12C07D', 16),
            new BigInteger('58AA56F772C0726F24C6B89E4ECDAC24354B9E99CAA3F6D3761402CD', 16)
        );
        $this->setOrder(new BigInteger('D7C134AA264366862A18302575D0FB98D116BC4B6DDEBCA3A5A7939F', 16));
    }
}