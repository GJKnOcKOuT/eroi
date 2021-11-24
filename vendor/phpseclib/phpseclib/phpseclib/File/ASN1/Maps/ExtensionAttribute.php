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
 * ExtensionAttribute
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
 * ExtensionAttribute
 *
 * @package ASN1
 * @author  Jim Wigginton <terrafrost@php.net>
 * @access  public
 */
abstract class ExtensionAttribute
{
    const MAP = [
        'type'     => ASN1::TYPE_SEQUENCE,
        'children' => [
             'extension-attribute-type'  => [
                                                'type' => ASN1::TYPE_PRINTABLE_STRING,
                                                'constant' => 0,
                                                'optional' => true,
                                                'implicit' => true
                                            ],
             'extension-attribute-value' => [
                                                'type' => ASN1::TYPE_ANY,
                                                'constant' => 1,
                                                'optional' => true,
                                                'explicit' => true
                                            ]
        ]
    ];
}
