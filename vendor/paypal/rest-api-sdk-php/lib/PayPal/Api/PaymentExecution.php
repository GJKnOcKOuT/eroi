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

use PayPal\Common\PayPalModel;

/**
 * Class PaymentExecution
 *
 * Let's you execute a PayPal Account based Payment resource with the payer_id obtained from web approval url.
 *
 * @package PayPal\Api
 *
 * @property string payer_id
 * @property \PayPal\Api\Transaction[] transactions
 */
class PaymentExecution extends PayPalModel
{
    /**
     * The ID of the Payer, passed in the `return_url` by PayPal.
     *
     * @param string $payer_id
     * 
     * @return $this
     */
    public function setPayerId($payer_id)
    {
        $this->payer_id = $payer_id;
        return $this;
    }

    /**
     * The ID of the Payer, passed in the `return_url` by PayPal.
     *
     * @return string
     */
    public function getPayerId()
    {
        return $this->payer_id;
    }

    /**
     * Carrier account id for a carrier billing payment. For a carrier billing payment, payer_id is not applicable.
     * @deprecated Not publicly available
     * @param string $carrier_account_id
     * 
     * @return $this
     */
    public function setCarrierAccountId($carrier_account_id)
    {
        $this->carrier_account_id = $carrier_account_id;
        return $this;
    }

    /**
     * Carrier account id for a carrier billing payment. For a carrier billing payment, payer_id is not applicable.
     * @deprecated Not publicly available
     * @return string
     */
    public function getCarrierAccountId()
    {
        return $this->carrier_account_id;
    }

    /**
     * Transactional details including the amount and item details.
     *
     * @param \PayPal\Api\Transaction[] $transactions
     * 
     * @return $this
     */
    public function setTransactions($transactions)
    {
        $this->transactions = $transactions;
        return $this;
    }

    /**
     * Transactional details including the amount and item details.
     *
     * @return \PayPal\Api\Transaction[]
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * Append Transactions to the list.
     *
     * @param \PayPal\Api\Transaction $transaction
     * @return $this
     */
    public function addTransaction($transaction)
    {
        if (!$this->getTransactions()) {
            return $this->setTransactions(array($transaction));
        } else {
            return $this->setTransactions(
                array_merge($this->getTransactions(), array($transaction))
            );
        }
    }

    /**
     * Remove Transactions from the list.
     *
     * @param \PayPal\Api\Transaction $transaction
     * @return $this
     */
    public function removeTransaction($transaction)
    {
        return $this->setTransactions(
            array_diff($this->getTransactions(), array($transaction))
        );
    }

}
