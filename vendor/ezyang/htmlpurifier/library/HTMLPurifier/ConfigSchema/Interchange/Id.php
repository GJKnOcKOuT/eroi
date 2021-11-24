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


/**
 * Represents a directive ID in the interchange format.
 */
class HTMLPurifier_ConfigSchema_Interchange_Id
{

    /**
     * @type string
     */
    public $key;

    /**
     * @param string $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     * @warning This is NOT magic, to ensure that people don't abuse SPL and
     *          cause problems for PHP 5.0 support.
     */
    public function toString()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getRootNamespace()
    {
        return substr($this->key, 0, strpos($this->key, "."));
    }

    /**
     * @return string
     */
    public function getDirective()
    {
        return substr($this->key, strpos($this->key, ".") + 1);
    }

    /**
     * @param string $id
     * @return HTMLPurifier_ConfigSchema_Interchange_Id
     */
    public static function make($id)
    {
        return new HTMLPurifier_ConfigSchema_Interchange_Id($id);
    }
}

// vim: et sw=4 sts=4
