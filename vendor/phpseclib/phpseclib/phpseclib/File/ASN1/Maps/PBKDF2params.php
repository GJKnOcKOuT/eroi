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
 * PBKDF2params
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
 * PBKDF2params
 *
 * from https://tools.ietf.org/html/rfc2898#appendix-A.3
 *
 * @package ASN1
 * @author  Jim Wigginton <terrafrost@php.net>
 * @access  public
 */
abstract class PBKDF2params
{
    const MAP = [
        'type'     => ASN1::TYPE_SEQUENCE,
        'children' => [
            // technically, this is a CHOICE in RFC2898 but the other "choice" is, currently, more of a placeholder
            // in the RFC
            'salt'=> ['type' => ASN1::TYPE_OCTET_STRING],
            'iterationCount'=> ['type' => ASN1::TYPE_INTEGER],
            'keyLength' => [
                'type'     => ASN1::TYPE_INTEGER,
                'optional' => true
            ],
            'prf' => AlgorithmIdentifier::MAP + ['optional' => true]
        ]
    ];
}
