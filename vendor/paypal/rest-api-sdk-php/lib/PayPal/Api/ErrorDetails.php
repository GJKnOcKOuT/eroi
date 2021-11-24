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
 * Class ErrorDetails
 *
 * Details about a specific error.
 *
 * @package PayPal\Api
 *
 * @property string field
 * @property string issue
 */
class ErrorDetails extends PayPalModel
{
    /**
     * Name of the field that caused the error.
     *
     * @param string $field
     * 
     * @return $this
     */
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }

    /**
     * Name of the field that caused the error.
     *
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Reason for the error.
     *
     * @param string $issue
     * 
     * @return $this
     */
    public function setIssue($issue)
    {
        $this->issue = $issue;
        return $this;
    }

    /**
     * Reason for the error.
     *
     * @return string
     */
    public function getIssue()
    {
        return $this->issue;
    }

    /**
     * Reference ID of the purchase_unit associated with this error
     * @deprecated Not publicly available
     * @param string $purchase_unit_reference_id
     * 
     * @return $this
     */
    public function setPurchaseUnitReferenceId($purchase_unit_reference_id)
    {
        $this->purchase_unit_reference_id = $purchase_unit_reference_id;
        return $this;
    }

    /**
     * Reference ID of the purchase_unit associated with this error
     * @deprecated Not publicly available
     * @return string
     */
    public function getPurchaseUnitReferenceId()
    {
        return $this->purchase_unit_reference_id;
    }

    /**
     * PayPal internal error code.
     * @deprecated Not publicly available
     * @param string $code
     * 
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * PayPal internal error code.
     * @deprecated Not publicly available
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

}
