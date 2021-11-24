<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

namespace app\modules\cmsapi\frontend\models;

use amos\cmsbridge\utility\CmsObject;

class PostCmsEventLocation extends CmsObject
{
    public $location_name;
    public $location_description;
    public $location_address;
    public $place_response;
    public $place_type;
    public $country;
    public $region;
    public $province;
    public $postal_code;
    public $city;
    public $address;
    public $street_number;
    public $latitude;
    public $longitude;

}