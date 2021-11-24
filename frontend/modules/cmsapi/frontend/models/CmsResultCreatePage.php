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


class CmsResultCreatePage extends CmsObject
{
    public $nav_id;
    public $nav_id_tks_page;
    public $nav_id_wating_page;
    public $nav_id_already_present_page;
    public $preview_url;

}