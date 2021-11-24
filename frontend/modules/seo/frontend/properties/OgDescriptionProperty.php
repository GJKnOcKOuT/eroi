<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\seo\frontend\properties;

use luya\admin\base\Property;

/**
 * Description of MetaTitleProperty
 *
 * @author matteo
 */
class OgDescriptionProperty extends Property {
    public function varName()
    {
        return 'ogDescription';
    }    
    
    public function label()
    {
        return \Yii::t('seo','page_property_og_description_label');
    }
    
    public function type()
    {
        return self::TYPE_TEXT;
    }
}
