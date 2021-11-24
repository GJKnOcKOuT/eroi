<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    common\config
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
$modules['admin'] = [
    'class' => 'arter\amos\admin\AmosAdmin',
    'controllerMap' => [
        'first-access-wizard' => [
            'class' => '\backend\modules\aster_admin\controllers\FirstAccessWizardController',
        ],
        'user-profile' => [
            'class' => '\backend\modules\aster_admin\controllers\UserProfileController',
        ],
    ],
    'modelMap' => [
        'UserProfile' => 'backend\modules\aster_admin\models\UserProfile',
    ],
    'enableRegister' => true,
    'organizationModuleName' => 'organizzazioni',
    'htmlMailContent' => '@backend/mail/user/credenziali-html',
    'showFacilitatorForModuleSelect' => true,
    'bypassConfirmForFacilitator' => true,
    'fieldsConfigurations' => [
        'boxes' => [
            'box_account_data' => ['form' => true, 'view' => true],
            'box_dati_accesso' => ['form' => true, 'view' => true],
            'box_dati_contatto' => ['form' => true, 'view' => true],
            'box_dati_fiscali_amministrativi' => ['form' => false, 'view' => false],
//          'box_dati_nascita' => ['form' => true, 'view' => true],
            'box_email_frequency' => ['form' => true, 'view' => true],
            'box_facilitatori' => ['form' => true, 'view' => true],
            'box_foto' => ['form' => true, 'view' => true],
            'box_informazioni_base' => ['form' => true, 'view' => true],
            'box_presentazione_personale' => ['form' => true, 'view' => true],
            'box_prevalent_partnership' => ['form' => false, 'view' => false],
            'box_privacy' => ['form' => true, 'view' => true],
            'box_questio' => ['form' => false, 'view' => false],
            'box_role_and_area' => ['form' => true, 'view' => true],
            'box_social_account' => ['form' => true, 'view' => true],
        ],
        'fields' => [
            'attivo' => ['form' => true, 'view' => true, 'referToBox' => 'box_account_data'],
            'codice_fiscale' => ['form' => false, 'view' => false, 'referToBox' => 'box_dati_fiscali_amministrativi'],
            'cognome' => ['form' => true, 'view' => true, 'referToBox' => 'box_informazioni_base'],
            'default_facilitatore' => ['form' => true, 'view' => true],
            'email' => ['form' => true, 'view' => false, 'referToBox' => 'box_dati_contatto'],
            'email_pec' => ['form' => false, 'view' => false, 'referToBox' => 'box_dati_contatto'],
            'facebook' => ['form' => true, 'view' => true, 'referToBox' => 'box_social_account'],
            'facilitatore_id' => ['form' => true, 'view' => true, 'referToBox' => 'box_facilitatori'],
            'googleplus' => ['form' => true, 'view' => true, 'referToBox' => 'box_social_account'],
            'linkedin' => ['form' => true, 'view' => true, 'referToBox' => 'box_social_account'],
            'nascita_comuni_id' => ['form' => false, 'view' => false, 'referToBox' => 'box_dati_nascita'],
            'nascita_data' => ['form' => true, 'view' => true, 'referToBox' => 'box_informazioni_base'],
            'nascita_nazioni_id' => ['form' => false, 'view' => false, 'referToBox' => 'box_dati_nascita'],
            'nascita_province_id' => ['form' => false, 'view' => false, 'referToBox' => 'box_dati_nascita'],
            'nome' => ['form' => true, 'view' => true, 'referToBox' => 'box_informazioni_base'],
            'note' => ['form' => true, 'view' => false, 'referToBox' => 'box_informazioni_base'],
            'presentazione_breve' => ['form' => true, 'view' => true, 'referToBox' => 'box_informazioni_base'],
            'presentazione_personale' => ['form' => true, 'view' => true, 'referToBox' => 'box_presentazione_personale'],
            'prevalent_partnership_id' => ['form' => false, 'view' => false, 'referToBox' => 'box_prevalent_partnership'],
            'privacy' => ['form' => true, 'view' => true, 'referToBox' => 'box_privacy'],
            'sesso' => ['form' => false, 'view' => false, 'referToBox' => 'box_informazioni_base'],
            'telefono' => ['form' => true, 'view' => true, 'referToBox' => 'box_dati_contatto'],
            'twitter' => ['form' => true, 'view' => true, 'referToBox' => 'box_social_account'],
            'ultimo_accesso' => ['form' => true, 'view' => true, 'referToBox' => 'box_account_data'],
            'ultimo_logout' => ['form' => true, 'view' => true, 'referToBox' => 'box_account_data'],
            'username' => ['form' => true, 'view' => false, 'referToBox' => 'box_dati_accesso'], /*
              'user_profile_age_group_id' => ['form' => true, 'view' => true, 'referToBox' => 'box_informazioni_base'], */
            'user_profile_area_id' => ['form' => false, 'view' => false, 'referToBox' => 'box_role_and_area'],
            'userProfileImage' => ['form' => true, 'view' => true, 'referToBox' => 'box_foto'],
            'user_profile_role_id' => ['form' => true, 'view' => true, 'referToBox' => 'box_role_and_area'],
            'user_profile_role_other' => ['form' => true, 'view' => false, 'referToBox' => 'box_role_and_area'],
        ]
    ],
    'actionBlacklistManageInvite' => [
        'facilitator-users',
    ],
];

$modules['attachments'] = [
    'class' => 'arter\amos\attachments\FileModule',
    'webDir' => 'files',
    'tempPath' => '@common/uploads/temp',
    'storePath' => '@common/uploads/store',
    'cache_age' => '2592000',
];

$modules['bestpractice'] = [
    'class' => 'arter\amos\best\practice\Module'
];

$modules['community'] = [
    'class' => 'arter\amos\community\AmosCommunity',
    'enableConfigureCommunityDashboard' => true,
    'hideContentsModels' => [
        'backend\modules\aster_partnership_profiles\models\PartnershipProfiles',
        'arter\amos\showcaseprojects\models\ShowcaseProject',
        'arter\amos\een\models\EenPartnershipProposal',
        'arter\amos\events\models\Event',
        'arter\amos\best\practice\models\BestPractice',
    ],
    'defaultListViews' => ['grid', 'icon'],
    'forceDefaultViewType' => true
];

$modules['cwh'] = [
    'class' => 'arter\amos\cwh\AmosCwh',
    'regolaPubblicazioneFilter' => true,
    'cached' => false
];

$modules['documenti'] = [
    'class' => 'arter\amos\documenti\AmosDocumenti',
];

$modules['een'] = [
    'class' => 'arter\amos\een\AmosEen',
    'wsdl' => 'http://een.ec.europa.eu/tools/services/podv6/QueryService.svc?wsdl',
    'findAllAccessPoint' => 'GetProfilesSOAP',
    'mailToSendInterest' => 'simpler2@finlombarda.it',
    'findAllAccessPointRequest' => [
        'Username' => 'IT00938',
        'Password' => '4a3cba9e9c608e867f99b2a8d37e0307',
    ],
    'tagsEenEnabled' => ['tecnologies'],
    'root_id' => 1,
    'enableConversionTag' => true,
    'book_ids' => ['tecnologies' => 1],
    'enableCreateEen' => false,
];

$modules['email'] = [
    'class' => 'arter\amos\emailmanager\AmosEmail',
    'templatePath' => '@common/mail/emails',
];

$modules['events'] = [
    'class' => 'arter\amos\events\AmosEvents',
];

$modules['invitations'] = [
    //'class' => 'arter\amos\invitations\Module',
    //chiamata al nuovo modulo aster_invitations che estende il modulo di default
    //'class' => 'backend\modules\asterinvitations\Module',
    'class' => 'backend\modules\aster_invitations\Module',
    'subjectCategory' => 'asterplatform',
];

$modules['notify'] = [
    'class' => 'arter\amos\notificationmanager\AmosNotify',
    'confirmEmailNotification' => false,
    'enableLegacyNotify' => true,
    'batchFromDate' => '2021-05-10 15:00',
    'orderEmailSummary' => [
        'arter\amos\events\models\Event',
        'arter\amos\news\models\News',
        'arter\amos\partnershipprofiles\models',
        'arter\amos\sondaggi\models\Sondaggi',
        'arter\amos\best\practice\models\BestPractice',
        'arter\amos\partnershipprofiles\models\PartnershipProfiles',
        'backend\modules\aster_partnership_profiles\models\PartnershipProfiles',
        'arter\amos\een\models\EenPartnershipProposal',
    ],
    'mailThemeColor' => [
        'bgPrimary' => '#c30830',
        'bgPrimaryDark' => '#C3083B',
        'textPrimary' => '#FFFFFF',
        'textPrimaryDark' => '#FFFFFF',
    ],

];

$modules['organizzazioni'] = [
    'class' => 'arter\amos\organizzazioni\Module',
    'modelMap' => [
        'ProfiloSedi' => 'backend\modules\aster_organizzazioni\models\ProfiloSedi',
    ],
    'enableProfiloEntiType' => false,
    'enableRappresentanteLegaleText' => true,
    'enableCodeIstatRequired' => false,
    'forceSameSede' => true,
    'db_fields_translation' => [
        [
            'namespace' => 'arter\amos\organizzazioni\models\ProfiloEntiType',
            'attributes' => ['name'],
            'category' => 'amosorganizzazioni',
        ],
        [
            'namespace' => 'arter\amos\organizzazioni\models\ProfiloTypesPmi',
            'attributes' => ['name'],
            'category' => 'amosorganizzazioni',
        ],
    ]
];

$modules['partnershipprofiles'] = [
    'class' => 'backend\modules\aster_partnership_profiles\Module',
    'viewPath' => '@vendor/arter/amos-partnership-profiles/src/views',
    'communityOfReferenceRequired' => false,
    'disablePartProfLongStringFieldsLimits' => true,
    'hideAdminsInPartProfFacilitatorSelection' => true,
    'fieldsConfigurations' => [
        'required' => [
            'title',
            'short_description',
            'extended_description',
            'partnership_profile_date',
            'expected_contribution',
            'expiration_in_months',
            'attrPartnershipProfilesTypesMm'
        ],
        'tabs' => [
            'tab-more-information' => true,
            'tab-attachments' => true
        ],
        'fields' => [
            //tab general
            'title' => true,
            'short_description' => true,
            'extended_description' => true,
            'advantages_innovative_aspects' => false,
            'expected_contribution' => true,
            'partnership_profile_date' => true,
            'expiration_in_months' => true,
            'attrPartnershipProfilesTypesMm' => true,
            'other_prospect_desired_collab' => true,
            'contact_person' => true,
            // tab other information
            'english_title' => true,
            'english_short_description' => true,
            'english_extended_description' => true,
            'attrPartnershipProfilesCountriesMm' => true,
            'willingness_foreign_partners' => true,
            'work_language_id' => true,
            'other_work_language' => true,
            'development_stage_id' => true,
            'other_development_stage' => true,
            'intellectual_property_id' => true,
            'other_intellectual_property' => true
        ],
    ],
    'controllerMap' => [
        'partnership-profiles' => 'backend\modules\aster_partnership_profiles\controllers\PartnershipProfilesController'
    ],
    'modelMap' => [
        'PartnershipProfiles' => 'backend\modules\aster_partnership_profiles\models\PartnershipProfiles',
        'PartnershipProfilesSearch' => 'backend\modules\aster_partnership_profiles\models\search\PartnershipProfilesSearch',
    ],
];

$modules['socialauth'] = [
    'class' => 'arter\amos\socialauth\Module',
    'enableLogin' => true,
    'enableLink' => true,
    'enableRegister' => true,
    'providers' => [
        "Facebook" => [
            "enabled" => true,
            "keys" => [
                "id" => "456123779123019",
                "secret" => "9377fa48686a08961a9b8e27c3ec05fb"
            ],
            "scope" => "email"
        ],
        "Twitter" => [
            "enabled" => true,
            "keys" => [
                "key" => "o2h9rB2erUwQTm0hJ2nsjg7c2",
                "secret" => "unJBHlIb4iqocCtMdMJSyLRhNZZMJA2PWrpWexsLacWn6I5ooV"
            ],
            "scope" => 'email',
            "includeEmail" => true
        ],
        "LinkedIn" => [
            "enabled" => true,
            "keys" => [
                'id' => '77ma67yoxht1r4',
                'secret' => 'XCTFuyc6VrVUPCqH'
            ],
            "state" => md5(time()),
            "scope" => "r_liteprofile r_emailaddress w_member_social"
        ]
    ]
];

$modules['tag'] = [
    'class' => 'arter\amos\tag\AmosTag',
];

$modules['translation'] = [
    'class' => 'arter\amos\translation\AmosTranslation',
    'queryCache' => 'translateCache',
    'cached' => true,
    'translationBootstrap' => [
        'configuration' => [
            'translationLabels' => [
                'classBehavior' => \lajax\translatemanager\behaviors\TranslateBehavior::className(),
                'models' => [
                    [
                        'namespace' => 'cornernote\workflow\manager\models\Status',
                        //'connection' => 'db', //if not set it use 'db'
                        //'classBehavior' => NULL,//if not set it use default classBehavior 'lajax\translatemanager\behaviors\TranslateBehavior'
                        'attributes' => ['label'],
                    ],
                ],
            ],
            'translationContents' => [
                'classBehavior' => \arter\amos\translation\behaviors\TranslateableBehavior::className(),
                'models' => [
                    ['namespace' => 'arter\amos\tag\models\Tag',
                        //'connection' => 'db', //if not set it use 'db'
                        //'classBehavior' => NULL,//if not set it use default classBehavior 'arter\amos\translation\behaviors\TranslateableBehavior'
                        'enableWorkflow' => FALSE, //if not set it use default configuration of the plugin
                        'attributes' => ['nome', 'descrizione'],
                        'plugin' => 'tag'
                    ],
                    ['namespace' => 'arter\amos\news\models\NewsCategorie',
                        //'connection' => 'db', //if not set it use 'db'
                        //'classBehavior' => NULL,//if not set it use default classBehavior 'arter\amos\translation\behaviors\TranslateableBehavior'
                        'enableWorkflow' => FALSE, //if not set it use default configuration of the plugin
                        'attributes' => ['titolo', 'sottotitolo'],
                        'plugin' => 'news'
                    ],
                    ['namespace' => 'arter\amos\documenti\models\DocumentiCategorie',
                        //'connection' => 'db', //if not set it use 'db'
                        //'classBehavior' => NULL,//if not set it use default classBehavior 'arter\amos\translation\behaviors\TranslateableBehavior'
                        'enableWorkflow' => FALSE, //if not set it use default configuration of the plugin
                        'attributes' => ['titolo', 'descrizione'],
                        'plugin' => 'documenti'
                    ],
                    ['namespace' => 'arter\amos\faq\models\Faq',
                        //'connection' => 'db', //if not set it use 'db'
                        //'classBehavior' => NULL,//if not set it use default classBehavior 'arter\amos\translation\behaviors\TranslateableBehavior'
                        'enableWorkflow' => FALSE, //if not set it use default configuration of the plugin
                        'attributes' => ['domanda', 'risposta'],
                        'plugin' => 'faq'
                    ],
                    ['namespace' => 'arter\amos\slideshow\models\Slideshow',
                        //'connection' => 'db', //if not set it use 'db'
                        //'classBehavior' => NULL,//if not set it use default classBehavior 'arter\amos\translation\behaviors\TranslateableBehavior'
                        'enableWorkflow' => FALSE, //if not set it use default configuration of the plugin
                        'attributes' => ['name', 'label', 'description'],
                        'plugin' => 'slideshow'
                    ],
                    ['namespace' => 'arter\amos\slideshow\models\SlideshowPage',
                        //'connection' => 'db', //if not set it use 'db'
                        //'classBehavior' => NULL,//if not set it use default classBehavior 'arter\amos\translation\behaviors\TranslateableBehavior'
                        'enableWorkflow' => FALSE, //if not set it use default configuration of the plugin
                        'attributes' => ['name', 'pageContent'],
                        'plugin' => 'slideshow'
                    ],
                    ['namespace' => 'arter\amos\partnershipprofiles\models\PartnershipProfilesType',
                        //'connection' => 'db', //if not set it use 'db'
                        //'classBehavior' => NULL,//if not set it use default classBehavior 'arter\amos\translation\behaviors\TranslateableBehavior'
                        'enableWorkflow' => FALSE, //if not set it use default configuration of the plugin
                        'attributes' => ['name'],
                        'plugin' => 'partnershipprofiles'
                    ],
                ],
            ],
        ],
    ],
    'module_translation_labels' => 'translatemanager',
    'module_translation_labels_options' => ['roles' => ['ADMIN', 'CONTENT_TRANSLATOR']], //all the options of the translatemanager
    'components' => [
        'translatemanager' => [
            'class' => 'lajax\translatemanager\Component'
        ],
    ],
    'defaultLanguage' => 'it-IT',
    'defaultUserLanguage' => 'it-IT',
    'pathsForceTranslation' => ['*'],
];

$modules['videoconference'] = [
    'class' => 'arter\amos\videoconference\AmosVideoconference',
    'rbacEnabled' => false
];

return $modules;
