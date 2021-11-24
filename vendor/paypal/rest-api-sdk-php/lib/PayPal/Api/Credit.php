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
 * Class Credit
 *
 * A resource representing a credit instrument.
 *
 * @package PayPal\Api
 *
 * @property string id
 * @property string type
 */
class Credit extends PayPalModel
{
    /**
     * Unique identifier of credit resource.
     *
     * @param string $id
     * 
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Unique identifier of credit resource.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * specifies type of credit
     * Valid Values: ["BILL_ME_LATER", "PAYPAL_EXTRAS_MASTERCARD", "EBAY_MASTERCARD", "PAYPAL_SMART_CONNECT"]
     *
     * @param string $type
     * 
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * specifies type of credit
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

}
