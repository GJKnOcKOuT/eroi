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
 * Class InvoiceNumber
 *
 * The next invoice number
 *
 * @package PayPal\Api
 *
 * @property string number
 */
class InvoiceNumber extends PayPalModel
{
    /**
     * The next invoice number.
     *
     * @param string $number
     *
     * @return $this
     */
    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }

    /**
     * The next invoice number.
     *
     * @return string
     */
    public function getNumber() {
        return $this->number;
    }
}
