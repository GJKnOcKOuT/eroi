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


namespace PayPal\Validation;

/**
 * Class ArgumentValidator
 *
 * @package PayPal\Validation
 */
class ArgumentValidator
{

    /**
     * Helper method for validating an argument that will be used by this API in any requests.
     *
     * @param $argument     mixed The object to be validated
     * @param $argumentName string|null The name of the argument.
     *                      This will be placed in the exception message for easy reference
     * @return bool
     */
    public static function validate($argument, $argumentName = null)
    {
        if ($argument === null) {
            // Error if Object Null
            throw new \InvalidArgumentException("$argumentName cannot be null");
        } elseif (gettype($argument) == 'string' && trim($argument) == '') {
            // Error if String Empty
            throw new \InvalidArgumentException("$argumentName string cannot be empty");
        }
        return true;
    }
}
