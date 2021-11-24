<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\basic\template
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\module\BaseAmosModule;

$googleMapsApiKey = 'AIzaSyCUhp-V1bi5cwt9SFN8MJtf6eWV4Z1ElDA';

$params = [
    'google-maps' => [
        'key' => $googleMapsApiKey
    ],
    'googleMapsApiKey' => $googleMapsApiKey,
    'googleMapsLanguage' => 'it',
    //'favicon' =>'favicon.ico',
    'searchNavbar' => true,
    'privacyLink' => [
        'label' => BaseAmosModule::t('amosapp', 'Privacy e Cookie Policy'),
        'url' => '/site/privacy',
        'linkOptions' => ['title' => BaseAmosModule::t('amosapp', 'Privacy e Cookie Policy')]
    ],
    'dashboardEngine' => 'rows',
    
    // PR-886 Voce Faq nella navbar-header 
    'enableTickectNavbarHeader' => true,
    

    // visibility section before form my profile
    'disableBulletCounters' => true,
    'enableMyActivitiesBulletCounters' => true,

];

return $params;
