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


/*
 * This file is part of SwiftMailer.
 * (c) 2018 Christian Schmidt
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * AddressEncoderException when the specified email address is in a format that
 * cannot be encoded by a given address encoder.
 *
 * @author Christian Schmidt
 */
class Swift_AddressEncoderException extends Swift_RfcComplianceException
{
    protected $address;

    public function __construct(string $message, string $address)
    {
        parent::__construct($message);

        $this->address = $address;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
}
