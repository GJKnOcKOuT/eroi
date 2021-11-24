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


namespace PayPal\Api;

/**
 * Class ExtendedBankAccount
 *
 * A resource representing a bank account that can be used to fund a payment including support for SEPA.
 *
 * @package PayPal\Api
 *
 */
class ExtendedBankAccount extends BankAccount
{
    /**
     * Identifier of the direct debit mandate to validate. Currently supported only for EU bank accounts(SEPA).
     * @deprecated Not publicly available
     * @param string $mandate_reference_number
     * 
     * @return $this
     */
    public function setMandateReferenceNumber($mandate_reference_number)
    {
        $this->mandate_reference_number = $mandate_reference_number;
        return $this;
    }

    /**
     * Identifier of the direct debit mandate to validate. Currently supported only for EU bank accounts(SEPA).
     * @deprecated Not publicly available
     * @return string
     */
    public function getMandateReferenceNumber()
    {
        return $this->mandate_reference_number;
    }

}
