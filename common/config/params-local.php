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

return [
    'domain' => 'stage.demotestwip.it',
    'adminEmail' => 'help@emiliaromagnaopeninnovation.aster.it',
    'supportEmailTicket' => 'help@emiliaromagnaopeninnovation.aster.it',
    'supportEmail' => 'help@emiliaromagnaopeninnovation.aster.it Piattaforma Emilia-Romagna',
    'email-assistenza' => 'administrator@emiliaromagnaopeninnovation.aster.it Piattaforma Open Innovation Emilia-Romagna',
    'assistance' => [
        'enabled' => true, //Enable the assistance button
        'type' => 'url', //Assistance button mode: url or email
        'email' => 'eropeninnovation.help@gmail.com', //Assistance mail
        'url' => '/ticket/assistenza/cerca-faq' //Url to the assistance page
    ],
    'user.passwordResetTokenExpire' => 604800,
    'google_places_api_key' => 'AIzaSyCUhp-V1bi5cwt9SFN8MJtf6eWV4Z1ElDA',
    'google_recaptcha_site_key' => '6Lf2CVIUAAAAADkZSiQBVCpRBtZ5E-hpJEd17iFt',
    'logo-signature' => '/img/EROI_payoff.png',
    'logoMail' => '/img/EROI_acronimo.png',
    'logo' => '/img/EROI_acronimo.png',
    'favicon' => 'aster-favicon.ico',
    'platform' => [
        'frontendUrl' => '//aster-pre-prod.stage.demotestwip.it',
        'backendUrl' => '//aster-pre-prod.stage.demotestwip.it',
    ],
    'footerText' => TRUE,
    'versione' => '1.1.0', // Version
];
