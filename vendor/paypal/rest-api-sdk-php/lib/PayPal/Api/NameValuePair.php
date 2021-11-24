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
 * Class NameValuePair
 *
 * Used to define a type for name-value pairs.  The use of name value pairs in an API should be limited and approved by architecture.
 *
 * @package PayPal\Api
 *
 * @property string name
 * @property string value
 */
class NameValuePair extends PayPalModel
{
    /**
     * Key for the name value pair.  The value name types should be correlated 
     *
     * @param string $name
     * 
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Key for the name value pair.  The value name types should be correlated 
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Value for the name value pair.
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
     * Value for the name value pair.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

}
