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
 * ECParameters
 *
 * From: https://tools.ietf.org/html/rfc5915
 *
 * PHP version 5
 *
 * @category  File
 * @package   ASN1
 * @author    Jim Wigginton <terrafrost@php.net>
 * @copyright 2016 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      http://phpseclib.sourceforge.net
 */

namespace phpseclib3\File\ASN1\Maps;

use phpseclib3\File\ASN1;

/**
 * ECParameters
 *
 *  ECParameters ::= CHOICE {
 *    namedCurve         OBJECT IDENTIFIER
 *    -- implicitCurve   NULL
 *    -- specifiedCurve  SpecifiedECDomain
 *  }
 *    -- implicitCurve and specifiedCurve MUST NOT be used in PKIX.
 *    -- Details for SpecifiedECDomain can be found in [X9.62].
 *    -- Any future additions to this CHOICE should be coordinated
 *    -- with ANSI X9.
 *
 * @package ASN1
 * @author  Jim Wigginton <terrafrost@php.net>
 * @access  public
 */
abstract class ECParameters
{
    const MAP = [
        'type'     => ASN1::TYPE_CHOICE,
        'children' => [
            'namedCurve' => ['type' => ASN1::TYPE_OBJECT_IDENTIFIER],
            'implicitCurve' => ['type' => ASN1::TYPE_NULL],
            'specifiedCurve' => SpecifiedECDomain::MAP
        ]
    ];
}
