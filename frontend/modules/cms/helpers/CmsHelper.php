<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

namespace app\modules\cms\helpers;

/**
 * Class CmsHelper
 * @package app\modules\cms\helpers
 */
class CmsHelper extends \yii\helpers\Html
{
    /**
     * @param string $fieldName
     * @param array $viewFields
     * @return bool
     */
    public static function in_arrayCmsViewField($fieldName, array $viewFields)
    {
        foreach ($viewFields as $field) {
            if ($field->name == $fieldName) {
                return true;
            }
        }
        return false;
    }
}
