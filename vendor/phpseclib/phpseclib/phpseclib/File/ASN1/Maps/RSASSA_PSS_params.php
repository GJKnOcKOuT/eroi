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
 * RSASSA_PSS_params
 *
 * As defined in https://tools.ietf.org/html/rfc4055#section-3.1
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
 * RSASSA_PSS_params
 *
 * @package ASN1
 * @author  Jim Wigginton <terrafrost@php.net>
 * @access  public
 */
abstract class RSASSA_PSS_params
{
    const MAP = [
        'type'     => ASN1::TYPE_SEQUENCE,
        'children' => [
            'hashAlgorithm'    => [
                'constant' => 0,
                'optional' => true,
                'explicit' => true,
                //'default'  => 'sha1Identifier'
            ] + HashAlgorithm::MAP,
            'maskGenAlgorithm' => [
                'constant' => 1,
                'optional' => true,
                'explicit' => true,
                //'default'  => 'mgf1SHA1Identifier'
            ] + MaskGenAlgorithm::MAP,
            'saltLength'       => [
                'type'     => ASN1::TYPE_INTEGER,
                'constant' => 2,
                'optional' => true,
                'explicit' => true,
                'default'  => 20
            ],
            'trailerField'     => [
                'type'     => ASN1::TYPE_INTEGER,
                'constant' => 3,
                'optional' => true,
                'explicit' => true,
                'default'  => 1
            ]
        ]
    ];
}
