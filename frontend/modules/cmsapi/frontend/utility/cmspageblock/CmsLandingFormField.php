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

namespace app\modules\cmsapi\frontend\utility\cmspageblock;

use app\modules\cmsapi\frontend\utility\CmsObject;

/**
 * Description of CmsLandigFormField
 *
 * @author stefano
 */
class CmsLandingFormField extends CmsObject
{
    public $type;
    public $label;
    public $required;
    public $field;
    public $subvalue = [];

}