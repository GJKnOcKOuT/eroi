<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\core\utilities
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\utilities;

use arter\amos\core\exceptions\AmosException;
use arter\amos\core\module\BaseAmosModule;

/**
 * Class ArrayUtility
 * @package arter\amos\core\utilities
 */
class ArrayUtility
{
    /**
     * This method translate the array values.
     * @param array $arrayValues
     * @param string $category
     * @param \arter\amos\core\module\BaseAmosModule $moduleClass
     * @return array
     */
    public static function translateArrayValues($arrayValues, $category = '', $moduleClass = null)
    {
        $translatedArrayValues = [];
        if (!$category) {
            $category = 'amoscore';
        }
        if (is_null($moduleClass)) {
            $moduleClass = BaseAmosModule::className();
        }
        foreach ($arrayValues as $index => $value) {
            $translatedArrayValues[$index] = $moduleClass::t($category, $value);
        }
        return $translatedArrayValues;
    }

    /**
     * This method checks if the param is an array and all array values are strings.
     * @param array $arrayToCheck
     * @return bool
     * @throws AmosException
     */
    public static function isStringArray($arrayToCheck)
    {
        if (!is_array($arrayToCheck)) {
            throw new AmosException(BaseAmosModule::t('amoscore', '#ArrayUtility_isStringArray_array_to_check_not_array'));
        }
        foreach ($arrayToCheck as $item) {
            if (!is_string($item)) {
                return false;
            }
        }
        return true;
    }
}
