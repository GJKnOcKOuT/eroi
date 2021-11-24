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
 * Class AgreementStateDescriptor
 *
 * Description of the current state of the agreement.
 *
 * @package PayPal\Api
 *
 * @property string note
 * @property \PayPal\Api\Currency amount
 */
class AgreementStateDescriptor extends PayPalModel
{
    /**
     * Reason for changing the state of the agreement.
     *
     * @param string $note
     * 
     * @return $this
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * Reason for changing the state of the agreement.
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * The amount and currency of the agreement.
     *
     * @param \PayPal\Api\Currency $amount
     * 
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * The amount and currency of the agreement.
     *
     * @return \PayPal\Api\Currency
     */
    public function getAmount()
    {
        return $this->amount;
    }

}
