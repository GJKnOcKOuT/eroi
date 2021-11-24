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
 * GeneralName
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
 * GeneralName
 *
 * @package ASN1
 * @author  Jim Wigginton <terrafrost@php.net>
 * @access  public
 */
abstract class GeneralName
{
    const MAP = [
        'type'     => ASN1::TYPE_CHOICE,
        'children' => [
            'otherName'                 => [
                                             'constant' => 0,
                                             'optional' => true,
                                             'implicit' => true
                                           ] + AnotherName::MAP,
            'rfc822Name'                => [
                                             'type' => ASN1::TYPE_IA5_STRING,
                                             'constant' => 1,
                                             'optional' => true,
                                             'implicit' => true
                                           ],
            'dNSName'                   => [
                                             'type' => ASN1::TYPE_IA5_STRING,
                                             'constant' => 2,
                                             'optional' => true,
                                             'implicit' => true
                                           ],
            'x400Address'               => [
                                             'constant' => 3,
                                             'optional' => true,
                                             'implicit' => true
                                           ] + ORAddress::MAP,
            'directoryName'             => [
                                             'constant' => 4,
                                             'optional' => true,
                                             'explicit' => true
                                           ] + Name::MAP,
            'ediPartyName'              => [
                                             'constant' => 5,
                                             'optional' => true,
                                             'implicit' => true
                                           ] + EDIPartyName::MAP,
            'uniformResourceIdentifier' => [
                                             'type' => ASN1::TYPE_IA5_STRING,
                                             'constant' => 6,
                                             'optional' => true,
                                             'implicit' => true
                                           ],
            'iPAddress'                 => [
                                             'type' => ASN1::TYPE_OCTET_STRING,
                                             'constant' => 7,
                                             'optional' => true,
                                             'implicit' => true
                                           ],
            'registeredID'              => [
                                             'type' => ASN1::TYPE_OBJECT_IDENTIFIER,
                                             'constant' => 8,
                                             'optional' => true,
                                             'implicit' => true
                                           ]
        ]
    ];
}
