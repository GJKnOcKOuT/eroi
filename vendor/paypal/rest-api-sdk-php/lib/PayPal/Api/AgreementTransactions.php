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
 * Class AgreementTransactions
 *
 * A resource representing agreement_transactions that is returned during a transaction search.
 *
 * @package PayPal\Api
 *
 * @property \PayPal\Api\AgreementTransaction[] agreement_transaction_list
 */
class AgreementTransactions extends PayPalModel
{
    /**
     * Array of agreement_transaction object.
     *
     * @param \PayPal\Api\AgreementTransaction[] $agreement_transaction_list
     * 
     * @return $this
     */
    public function setAgreementTransactionList($agreement_transaction_list)
    {
        $this->agreement_transaction_list = $agreement_transaction_list;
        return $this;
    }

    /**
     * Array of agreement_transaction object.
     *
     * @return \PayPal\Api\AgreementTransaction[]
     */
    public function getAgreementTransactionList()
    {
        return $this->agreement_transaction_list;
    }

    /**
     * Append AgreementTransactionList to the list.
     *
     * @param \PayPal\Api\AgreementTransaction $agreementTransaction
     * @return $this
     */
    public function addAgreementTransactionList($agreementTransaction)
    {
        if (!$this->getAgreementTransactionList()) {
            return $this->setAgreementTransactionList(array($agreementTransaction));
        } else {
            return $this->setAgreementTransactionList(
                array_merge($this->getAgreementTransactionList(), array($agreementTransaction))
            );
        }
    }

    /**
     * Remove AgreementTransactionList from the list.
     *
     * @param \PayPal\Api\AgreementTransaction $agreementTransaction
     * @return $this
     */
    public function removeAgreementTransactionList($agreementTransaction)
    {
        return $this->setAgreementTransactionList(
            array_diff($this->getAgreementTransactionList(), array($agreementTransaction))
        );
    }

}
