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
use PayPal\Validation\UrlValidator;

/**
 * Class RedirectUrls
 *
 * Set of redirect URLs you provide only for PayPal-based payments.
 *
 * @package PayPal\Api
 *
 * @property string return_url
 * @property string cancel_url
 */
class RedirectUrls extends PayPalModel
{
    /**
     * Url where the payer would be redirected to after approving the payment. **Required for PayPal account payments.**
     *
     * @param string $return_url
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setReturnUrl($return_url)
    {
        UrlValidator::validate($return_url, "ReturnUrl");
        $this->return_url = $return_url;
        return $this;
    }

    /**
     * Url where the payer would be redirected to after approving the payment. **Required for PayPal account payments.**
     *
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->return_url;
    }

    /**
     * Url where the payer would be redirected to after canceling the payment. **Required for PayPal account payments.**
     *
     * @param string $cancel_url
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setCancelUrl($cancel_url)
    {
        UrlValidator::validate($cancel_url, "CancelUrl");
        $this->cancel_url = $cancel_url;
        return $this;
    }

    /**
     * Url where the payer would be redirected to after canceling the payment. **Required for PayPal account payments.**
     *
     * @return string
     */
    public function getCancelUrl()
    {
        return $this->cancel_url;
    }

}
