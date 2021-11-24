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
 * Class Billing
 *
 * Billing instrument used to charge the payer.
 *
 * @package PayPal\Api
 *
 * @deprecated Used internally only.
 *
 * @property string billing_agreement_id
 */
class Billing extends PayPalModel
{
    /**
     * Identifier of the instrument in PayPal Wallet
     *
     * @param string $billing_agreement_id
     * 
     * @return $this
     */
    public function setBillingAgreementId($billing_agreement_id)
    {
        $this->billing_agreement_id = $billing_agreement_id;
        return $this;
    }

    /**
     * Identifier of the instrument in PayPal Wallet
     *
     * @return string
     */
    public function getBillingAgreementId()
    {
        return $this->billing_agreement_id;
    }

}
