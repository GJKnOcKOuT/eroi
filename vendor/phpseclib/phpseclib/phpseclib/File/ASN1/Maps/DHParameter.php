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
 * DHParameter
 *
 * From: https://www.teletrust.de/fileadmin/files/oid/oid_pkcs-3v1-4.pdf#page=6
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
 * DHParameter
 *
 * @package ASN1
 * @author  Jim Wigginton <terrafrost@php.net>
 * @access  public
 */
abstract class DHParameter
{
    const MAP = [
        'type' => ASN1::TYPE_SEQUENCE,
        'children' => [
            'prime' => ['type' => ASN1::TYPE_INTEGER],
            'base' =>  ['type' => ASN1::TYPE_INTEGER],
            'privateValueLength' => [
                'type' => ASN1::TYPE_INTEGER,
                'optional' => true
            ]
        ]
    ];
}
