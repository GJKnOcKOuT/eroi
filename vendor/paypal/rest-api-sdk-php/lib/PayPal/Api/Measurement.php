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
 * Class Measurement
 *
 * Measurement to represent item dimensions like length, width, height and weight etc.
 *
 * @package PayPal\Api
 *
 * @property string value
 * @property string unit
 */
class Measurement extends PayPalModel
{
    /**
     * Value this measurement represents.
     *
     * @param string $value
     * 
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Value this measurement represents.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Unit in which the value is represented.
     *
     * @param string $unit
     * 
     * @return $this
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * Unit in which the value is represented.
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

}
