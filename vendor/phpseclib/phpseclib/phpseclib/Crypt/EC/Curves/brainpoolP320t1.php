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
 * brainpoolP320t1
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

class brainpoolP320t1 extends Prime
{
    public function __construct()
    {
        $this->setModulo(new BigInteger('D35E472036BC4FB7E13C785ED201E065F98FCFA6F6F40DEF4F9' .
                                        '2B9EC7893EC28FCD412B1F1B32E27', 16));
        $this->setCoefficients(
            new BigInteger('D35E472036BC4FB7E13C785ED201E065F98FCFA6F6F40DEF4F92B9EC7893EC28' .
                           'FCD412B1F1B32E24', 16), // eg. -3
            new BigInteger('A7F561E038EB1ED560B3D147DB782013064C19F27ED27C6780AAF77FB8A547CE' .
                           'B5B4FEF422340353', 16)
        );
        $this->setBasePoint(
            new BigInteger('925BE9FB01AFC6FB4D3E7D4990010F813408AB106C4F09CB7EE07868CC136FFF' .
                           '3357F624A21BED52', 16),
            new BigInteger('63BA3A7A27483EBF6671DBEF7ABB30EBEE084E58A0B077AD42A5A0989D1EE71B' .
                           '1B9BC0455FB0D2C3', 16)
        );
        $this->setOrder(new BigInteger('D35E472036BC4FB7E13C785ED201E065F98FCFA5B68F12A32D4' .
                                       '82EC7EE8658E98691555B44C59311', 16));
    }
}