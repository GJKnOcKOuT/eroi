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
 * Class CustomAmount
 *
 * The custom amount applied on an invoice. If you include a label, the amount cannot be empty.
 *
 * @package PayPal\Api
 *
 * @property string label
 * @property \PayPal\Api\Currency amount
 */
class CustomAmount extends PayPalModel
{
    /**
     * The custom amount label. Maximum length is 25 characters.
     *
     * @param string $label
     * 
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * The custom amount label. Maximum length is 25 characters.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * The custom amount value. Valid range is from -999999.99 to 999999.99.
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
     * The custom amount value. Valid range is from -999999.99 to 999999.99.
     *
     * @return \PayPal\Api\Currency
     */
    public function getAmount()
    {
        return $this->amount;
    }

}
