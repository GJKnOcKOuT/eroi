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
$modules = [
    'amministra-utenti' => [
        'class' => 'arter\amos\admin\RoleManager',
        'layout' => "@vendor/arter/amos-core/views/layouts/admin",
        //'left-menu', // it can be '@path/to/your/layout'.
        'controllerMap' => [
            'assignment' => [
                'class' => 'mdm\admin\controllers\AssignmentController',
                'userClassName' => 'common\models\User',
                'idField' => 'id'
            ],
        ],
        'menus' => [
            'assignment' => [
                'label' => 'Gestisci Assegnazioni' // TODO translate
            ],
        ]
    ],
    'chat' => [
        'class' => 'arter\amos\chat\AmosChat',
        'emailMessageContentAllowedTag' => 'iframe[src|width|height|class|frameborder],p,div,a[href|target],br,img[width|height|alt|src]',
    ],
    'comments' => [
        'class' => 'arter\amos\comments\AmosComments',
        'layoutInverted' => true,
        'enableMailsNotification' => true,
        'enableNotifyCommentForDiscussions' => false,
        'modelsEnabled' => [
            'arter\amos\discussioni\models\DiscussioniTopic',
            'arter\amos\documenti\models\Documenti',
            'arter\amos\news\models\News',
            'arter\amos\ticket\models\Ticket', //line to add
        ],
    ],
    'comuni' => [
        'class' => 'arter\amos\comuni\AmosComuni',
    ],
    'dashboard' => [
        'class' => 'arter\amos\dashboard\AmosDashboard',
        'useWidgetGraphicDashboardVisible' => true
    ],
    'discussioni' => [
        'class' => 'arter\amos\discussioni\AmosDiscussioni',
        'notifyOnlyContributors' => true,
        'disableComments' => true,
    ],
    /* 'documenti' => [
      'class' => 'arter\amos\documenti\AmosDocumenti',
      ], */
    /* 'faq' => [
      'class' => 'arter\amos\faq\AmosFaq',
      ], */
    'favorites' => [
        'class' => 'arter\amos\favorites\AmosFavorites',
        'modelsEnabled' => [
            'arter\amos\news\models\News',
            'arter\amos\documenti\models\Documenti',
            'arter\amos\discussioni\models\DiscussioniTopic',
        ]
    ],
    'layout' => [
        'class' => 'arter\amos\layout\Module'
    ],
    'myactivities' => [
        'class' => 'arter\amos\myactivities\AmosMyActivities',
    ],
    'news' => [
        'class' => 'arter\amos\news\AmosNews',
        'filterCategoriesByRole' => false,
        'newsRequiredFields' => ['news_categorie_id', 'titolo', 'status', 'descrizione_breve'],
        'params' => [//only for Open2
            'site_featured_enabled' => false,
            'site_publish_enabled' => false,
        ],
        //'defaultCategory' => 1
        'numberListTag' => 5,
    ],
    'privileges' => [
        'class' => 'arter\amos\privileges\AmosPrivileges',
        'blackListModules' => ['proposte_collaborazione', 'proposte_collaborazione_een'],
    ],
//    'report' => [
//        'class' => 'arter\amos\report\AmosReport',
//        'modelsEnabled' => [
//            'arter\amos\best\practice\models\SuperCraft',
//        ]
//    ],
    'search' => [
        'class' => 'arter\amos\search\AmosSearch',
        'modulesToSearch' => [
            'admin' => 'arter\amos\admin\models\search\UserProfileSearch',
            'bestpractice' => 'arter\amos\best\practice\models\search\BestPracticeSearch',
            'discussioni' => 'arter\amos\discussioni\models\search\DiscussioniTopicSearch',
            'documenti' => 'arter\amos\documenti\models\search\DocumentiSearch',
            'partnershipprofiles' => 'arter\amos\partnershipprofiles\models\search\PartnershipProfilesSearch',
            'organizzazioni' => 'arter\amos\organizzazioni\models\search\ProfiloSearch',
            'community' => 'arter\amos\community\models\search\CommunitySearch',
            'een' => 'arter\amos\een\models\search\EenPartnershipProposalSearch',
            'news' => 'arter\amos\news\models\search\NewsSearch',
        ]
    ],
    'slideshow' => [
        'class' => 'arter\amos\slideshow\AmosSlideshow',
    ],
    'sondaggi' => [
        'class' => 'arter\amos\sondaggi\AmosSondaggi',
    ],
    'tickets' => [
        'class' => 'backend\modules\tickets\Module'
    ],
    'upload' => [
        'class' => 'arter\amos\upload\AmosUpload',
    ],
    'utility' => [
        'class' => 'arter\amos\utility\Module'
    ],
    'workflow' => [
        'class' => 'arter\amos\workflow\AmosWorkflow',
    ],
    'ticket' => [
        'class' => 'arter\amos\ticket\AmosTicket',
        'disableCategory' => false,
        'disableInfoFields' => true,
        'disableTicketOrganization' => true,
    ],
    'supercraft' => [
        //'class' => 'arter\amos\ticket\AmosTicket',
        'disableCategory' => false,
        'disableInfoFields' => true,
        'disableTicketOrganization' => true,
    ],
//    'mobilebridge' => [ 'class' => 'arter\amos\mobile\bridge\Module' ],
];

return $modules;
