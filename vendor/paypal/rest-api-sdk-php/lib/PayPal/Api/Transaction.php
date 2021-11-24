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
 * Class Transaction
 *
 * A transaction defines the contract of a payment - what is the payment for and who is fulfilling it.
 *
 * @package PayPal\Api
 *
 */
class Transaction extends TransactionBase
{
    /**
     * Additional transactions for complex payment scenarios.
     *
     *
     * @param self $transactions
     *
     * @return $this
     */
    public function setTransactions($transactions)
    {
        $this->transactions = $transactions;
        return $this;
    }

    /**
     * Additional transactions for complex payment scenarios.
     *
     * @return self[]
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * Identifier to the purchase unit corresponding to this sale transaction
     *
     * @param string $purchase_unit_reference_id
     * @deprecated Use #setReferenceId instead
     * @return $this
     */
    public function setPurchaseUnitReferenceId($purchase_unit_reference_id)
    {
        $this->purchase_unit_reference_id = $purchase_unit_reference_id;
        return $this;
    }

    /**
     * Identifier to the purchase unit corresponding to this sale transaction
     *
     * @deprecated Use #getReferenceId instead
     * @return string
     */
    public function getPurchaseUnitReferenceId()
    {
        return $this->purchase_unit_reference_id;
    }

}
