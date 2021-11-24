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
 * Class PaymentSummary
 *
 * Payment/Refund break up
 *
 * @package PayPal\Api
 *
 * @property \PayPal\Api\Currency paypal
 * @property \PayPal\Api\Currency other
 */
class PaymentSummary extends PayPalModel
{
    /**
     * Total Amount paid/refunded via PayPal.
     *
     * @param \PayPal\Api\Currency $paypal
     * 
     * @return $this
     */
    public function setPaypal($paypal)
    {
        $this->paypal = $paypal;
        return $this;
    }

    /**
     * Total Amount paid/refunded via PayPal.
     *
     * @return \PayPal\Api\Currency
     */
    public function getPaypal()
    {
        return $this->paypal;
    }

    /**
     * Total Amount paid/refunded via other sources.
     *
     * @param \PayPal\Api\Currency $other
     * 
     * @return $this
     */
    public function setOther($other)
    {
        $this->other = $other;
        return $this;
    }

    /**
     * Total Amount paid/refunded via other sources.
     *
     * @return \PayPal\Api\Currency
     */
    public function getOther()
    {
        return $this->other;
    }

}
