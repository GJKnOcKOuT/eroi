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
 * Class Patch
 *
 * A JSON patch object that you can use to apply partial updates to resources.
 *
 * @package PayPal\Api
 *
 * @property string op
 * @property string path
 * @property mixed value
 * @property string from
 */
class Patch extends PayPalModel
{
    /**
     * The operation to perform.
     * Valid Values: ["add", "remove", "replace", "move", "copy", "test"]
     *
     * @param string $op
     * 
     * @return $this
     */
    public function setOp($op)
    {
        $this->op = $op;
        return $this;
    }

    /**
     * The operation to perform.
     *
     * @return string
     */
    public function getOp()
    {
        return $this->op;
    }

    /**
     * A JSON pointer that references a location in the target document where the operation is performed. A `string` value.
     *
     * @param string $path
     * 
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * A JSON pointer that references a location in the target document where the operation is performed. A `string` value.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * New value to apply based on the operation.
     *
     * @param mixed $value
     * 
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * New value to apply based on the operation.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * A string containing a JSON Pointer value that references the location in the target document to move the value from.
     *
     * @param string $from
     * 
     * @return $this
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * A string containing a JSON Pointer value that references the location in the target document to move the value from.
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

}
