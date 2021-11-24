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
 * ASN1 Signature Handler
 *
 * PHP version 5
 *
 * Handles signatures in the format described in
 * https://tools.ietf.org/html/rfc3279#section-2.2.3
 *
 * @category  Crypt
 * @package   Common
 * @author    Jim Wigginton <terrafrost@php.net>
 * @copyright 2016 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      http://phpseclib.sourceforge.net
 */

namespace phpseclib3\Crypt\EC\Formats\Signature;

use phpseclib3\Math\BigInteger;
use phpseclib3\File\ASN1 as Encoder;
use phpseclib3\File\ASN1\Maps\EcdsaSigValue;

/**
 * ASN1 Signature Handler
 *
 * @package Common
 * @author  Jim Wigginton <terrafrost@php.net>
 * @access  public
 */
abstract class ASN1
{
    /**
     * Loads a signature
     *
     * @access public
     * @param string $sig
     * @return array
     */
    public static function load($sig)
    {
        if (!is_string($sig)) {
            return false;
        }

        $decoded = Encoder::decodeBER($sig);
        if (empty($decoded)) {
            return false;
        }
        $components = Encoder::asn1map($decoded[0], EcdsaSigValue::MAP);

        return $components;
    }

    /**
     * Returns a signature in the appropriate format
     *
     * @access public
     * @param \phpseclib3\Math\BigInteger $r
     * @param \phpseclib3\Math\BigInteger $s
     * @return string
     */
    public static function save(BigInteger $r, BigInteger $s)
    {
        return Encoder::encodeDER(compact('r', 's'), EcdsaSigValue::MAP);
    }
}
