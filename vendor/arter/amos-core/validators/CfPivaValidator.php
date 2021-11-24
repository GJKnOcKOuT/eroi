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
 * @package    arter\amos\core\validators
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\validators;

use yii\validators\Validator;
use arter\amos\core\validators\CFValidator;
use arter\amos\core\validators\PIVAValidator;

/**
 * Description of CfPivaValidator
 *
 * @author Cesare
 */
class CfPivaValidator extends Validator
{
    
    /**
     * 
     * @param \backend\components\ActiveRecord $model
     * @param string $attribute
     * @return type
     */
    function validateAttribute($model, $attribute)
    {
        $error = true;

        if(is_numeric ($model->$attribute)){
            // check Partita IVA
            $PIVA = new PIVAValidator();
            $error = $PIVA->validateAttribute($model, $attribute);
        }else{
            // check Codice Fiscale
            $CF = new CFValidator();
            $error = $CF->validateAttribute($model, $attribute);
        }
        
        if($error === false) {
            return;
        }else{
            $model->clearErrors($attribute);
        }
    }

    /**
     * @param \yii\base\Model $model
     * @param string $attribute
     * @param \yii\web\View $view
     * @return string
     * Validator CF/PIVA client side
     */
    public function clientValidateAttribute($model, $attribute, $view)
    {
        //load the js code for P.Iva validation
        $PIVA = new PIVAValidator();
        $validatePivaJs = $PIVA->clientValidateAttribute($model, $attribute, $view);

        //load the js code for CF validation
        $CF = new CFValidator();
        $validateCfJs = $CF->clientValidateAttribute($model, $attribute, $view);

        return <<<JS
            function isNumeric(n) {
                return !isNaN(parseFloat(n)) && isFinite(n);
            }
            
            //if is numeric use the js code for validate P.IVA, otherwise use tje js for the CF
            if( isNumeric(value) ){
                $validatePivaJs;
            }else{
                $validateCfJs;
                
            }
JS;
    }


}
