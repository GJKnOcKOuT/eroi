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
 * sect233r1
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

class sect233r1 extends Binary
{
    public function __construct()
    {
        $this->setModulo(233, 74, 0);
        $this->setCoefficients(
            '000000000000000000000000000000000000000000000000000000000001',
            '0066647EDE6C332C7F8C0923BB58213B333B20E9CE4281FE115F7D8F90AD'
        );
        $this->setBasePoint(
            '00FAC9DFCBAC8313BB2139F1BB755FEF65BC391F8B36F8F8EB7371FD558B',
            '01006A08A41903350678E58528BEBF8A0BEFF867A7CA36716F7E01F81052'
        );
        $this->setOrder(new BigInteger('01000000000000000000000000000013E974E72F8A6922031D2603CFE0D7', 16));
    }
}
