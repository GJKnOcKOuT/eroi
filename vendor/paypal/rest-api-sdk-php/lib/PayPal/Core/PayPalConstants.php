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


namespace PayPal\Core;

/**
 * Class PayPalConstants
 * Placeholder for Paypal Constants
 *
 * @package PayPal\Core
 */
class PayPalConstants
{

    const SDK_NAME = 'PayPal-PHP-SDK';
    const SDK_VERSION = '1.14.0';

    /**
     * Approval URL for Payment
     */
    const APPROVAL_URL = 'approval_url';

    const REST_SANDBOX_ENDPOINT = "https://api.sandbox.paypal.com/";
    const OPENID_REDIRECT_SANDBOX_URL = "https://www.sandbox.paypal.com";

    const REST_LIVE_ENDPOINT = "https://api.paypal.com/";
    const OPENID_REDIRECT_LIVE_URL = "https://www.paypal.com";
}
