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
 * TBSCertList
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
 * TBSCertList
 *
 * @package ASN1
 * @author  Jim Wigginton <terrafrost@php.net>
 * @access  public
 */
abstract class TBSCertList
{
    const MAP = [
        'type'     => ASN1::TYPE_SEQUENCE,
        'children' => [
            'version'             => [
                                         'type'    => ASN1::TYPE_INTEGER,
                                         'mapping' => ['v1', 'v2', 'v3'],
                                         'optional' => true,
                                         'default'  => 'v2'
                                     ],
            'signature'           => AlgorithmIdentifier::MAP,
            'issuer'              => Name::MAP,
            'thisUpdate'          => Time::MAP,
            'nextUpdate'          => [
                                         'optional' => true
                                     ] + Time::MAP,
            'revokedCertificates' => [
                                         'type'     => ASN1::TYPE_SEQUENCE,
                                         'optional' => true,
                                         'min'      => 0,
                                         'max'      => -1,
                                         'children' => RevokedCertificate::MAP
                                     ],
            'crlExtensions'       => [
                                         'constant' => 0,
                                         'optional' => true,
                                         'explicit' => true
                                     ] + Extensions::MAP
        ]
    ];
}
