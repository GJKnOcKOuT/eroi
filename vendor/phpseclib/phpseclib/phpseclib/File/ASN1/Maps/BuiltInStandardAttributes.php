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
 * BuiltInStandardAttributes
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
 * BuiltInStandardAttributes
 *
 * @package ASN1
 * @author  Jim Wigginton <terrafrost@php.net>
 * @access  public
 */
abstract class BuiltInStandardAttributes
{
    const MAP = [
        'type'     => ASN1::TYPE_SEQUENCE,
        'children' => [
            'country-name'               => ['optional' => true] + CountryName::MAP,
            'administration-domain-name' => ['optional' => true] + AdministrationDomainName::MAP,
            'network-address'            => [
                                             'constant' => 0,
                                             'optional' => true,
                                             'implicit' => true
                                           ] + NetworkAddress::MAP,
            'terminal-identifier'        => [
                                             'constant' => 1,
                                             'optional' => true,
                                             'implicit' => true
                                           ] + TerminalIdentifier::MAP,
            'private-domain-name'        => [
                                             'constant' => 2,
                                             'optional' => true,
                                             'explicit' => true
                                           ] + PrivateDomainName::MAP,
            'organization-name'          => [
                                             'constant' => 3,
                                             'optional' => true,
                                             'implicit' => true
                                           ] + OrganizationName::MAP,
            'numeric-user-identifier'    => [
                                             'constant' => 4,
                                             'optional' => true,
                                             'implicit' => true
                                           ] + NumericUserIdentifier::MAP,
            'personal-name'              => [
                                             'constant' => 5,
                                             'optional' => true,
                                             'implicit' => true
                                           ] + PersonalName::MAP,
            'organizational-unit-names'  => [
                                             'constant' => 6,
                                             'optional' => true,
                                             'implicit' => true
                                           ] + OrganizationalUnitNames::MAP
        ]
    ];
}
