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


use yii\base\Exception;
use yii\base\BaseObject;

class ClassUtility extends BaseObject
{

    /**
     * @param $classname
     * @return bool
     */
    public static function classExist($classname){
        $boolean = false;
        try {
            $boolean = class_exists($classname);
        }catch(Exception $ex){

        }
        return $boolean;
    }
    
    /**
     * 
     * @param type $obj
     * @param type $name
     * @param type $checkVars
     * @return type
     */
    public static function objectHasProperty($obj, $name, $checkVars = true)
    {
        $ret = false;
        
        if(is_object($obj))
        {
            $ret = $obj->hasProperty($name, $checkVars);
        }
        return $ret;
    }
    
    public static function getClassBasename($obj)
    {
        $class = is_object($obj) ? $obj->className() : $obj;
        return basename(str_replace('\\', '/', $class));
    }
}