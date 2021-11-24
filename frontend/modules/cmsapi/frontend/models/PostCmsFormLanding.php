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

class PostCmsFormLanding extends CmsObject
{
    public $social_reg;
    public $facebook_reg;
    public $twitter_reg;
    public $linkedin_reg;
    public $goolge_reg;
    public $spid_cns_reg;
    public $user_name_reg;
    public $ask_sex;
    public $ask_age;
    public $ask_county;
    public $ask_city;
    public $ask_telefon;
    public $ask_fiscal_code;
    public $ask_company;
    public $ask_tags;

    public $tks_you_page_message;
    public $waiting_page_message;
    public $already_present_page_message;
    public $confirm_mail_subject;
    public $confirm_mail_text;
    public $waiting_mail_subject;
    public $waiting_mail_text;
    public $community_id;
    public $seats_available;
    public $send_mail;
    public $register_on_platform;

    public $nav_id_tks_page;
    public $nav_id_wating_page;
    public $nav_id_already_present_page;

}