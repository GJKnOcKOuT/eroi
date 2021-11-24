<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

namespace app\modules\uikit;


/**
 * Description of Uikit
 *
 * @author stefano.cavazzini
 */
class Uikit extends \trk\uikit\Uikit{
  
    public static function pickBool($array, $keys)
    {
        $retarray = array_intersect_key($array, array_flip((array) $keys));
        foreach($retarray as $key => $value)
        {
            if(empty($retarray[$key])){
                $retarray[$key] = "false";
            }
        }
        return $retarray;
    }
}
