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
 * Class BankAccountsList
 *
 * A list of Bank Account Resources
 *
 * @package PayPal\Api
 *
 * @property \PayPal\Api\BankAccount[] bank_accounts
 * @property int count
 * @property string next_id
 */
class BankAccountsList extends PayPalModel
{
    /**
     * A list of bank account resources
     *
     * @param \PayPal\Api\BankAccount[] $bank_accounts
     * 
     * @return $this
     */
    public function setBankAccounts($bank_accounts)
    {
        $this->{"bank-accounts"} = $bank_accounts;
        return $this;
    }

    /**
     * A list of bank account resources
     *
     * @return \PayPal\Api\BankAccount[]
     */
    public function getBankAccounts()
    {
        return $this->{"bank-accounts"};
    }

    /**
     * Append BankAccounts to the list.
     *
     * @param \PayPal\Api\BankAccount $bankAccount
     * @return $this
     */
    public function addBankAccount($bankAccount)
    {
        if (!$this->getBankAccounts()) {
            return $this->setBankAccounts(array($bankAccount));
        } else {
            return $this->setBankAccounts(
                array_merge($this->getBankAccounts(), array($bankAccount))
            );
        }
    }

    /**
     * Remove BankAccounts from the list.
     *
     * @param \PayPal\Api\BankAccount $bankAccount
     * @return $this
     */
    public function removeBankAccount($bankAccount)
    {
        return $this->setBankAccounts(
            array_diff($this->getBankAccounts(), array($bankAccount))
        );
    }

    /**
     * Number of items returned in each range of results. Note that the last results range could have fewer items than the requested number of items.
     *
     * @param int $count
     * 
     * @return $this
     */
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    /**
     * Number of items returned in each range of results. Note that the last results range could have fewer items than the requested number of items.
     *
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Identifier of the next element to get the next range of results.
     *
     * @param string $next_id
     * 
     * @return $this
     */
    public function setNextId($next_id)
    {
        $this->next_id = $next_id;
        return $this;
    }

    /**
     * Identifier of the next element to get the next range of results.
     *
     * @return string
     */
    public function getNextId()
    {
        return $this->next_id;
    }

}
