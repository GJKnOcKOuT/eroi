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

use app\modules\cmsapi\frontend\utility\CmsObject;

class PostCmsEventData extends CmsObject
{
    public $event_id;
    public $opening_date;
    public $event_date;
    public $title;
    public $presentation;
    public $description;
    public $program;
    public $url_image;
    public $location;

    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->location = new PostCmsEventLocation();
    }
}