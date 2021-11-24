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
    'email-assistenza' => 'administrator@emiliaromagnaopeninnovation.aster.it Piattaforma Open Innovation Emilia-Romagna',
    'icon-framework' => 'am',
    'googleMapsLibraries'=> null,
    'googleMapsLanguage' =>'en',
    
    // Enable Amos Exclusive features
    'template-amos' => FALSE,
    
    // Enable template slideshow
    'slideshow' => TRUE,
    'slideshow-label' => 'Mostra introduzione', // TODO translate and amos-XXX::[t()|tHtml()] ?

    // Enable Localization menu
    'languageSelector' => TRUE,
    'allLanguages' => ['Italiano' => 'it-IT'],

    //enable btn dashboard to frontend
    'toFrontendLink' => false,
    
    //diable wizard in create content models (News, Documents, Discussions)
    'noWizardNewLayout' => true,

    // TextEditor widget to enable mentions
    'textEditor' => [
        "mentions" => [
            'enable' => true,
        ]
    ]
];
