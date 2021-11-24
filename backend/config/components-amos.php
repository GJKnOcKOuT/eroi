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
    'view' => [
        'class' => 'arter\amos\core\components\AmosView',
        'theme' => [
            'pathMap' => [
                '@vendor/arter/amos-layout/src/views/layouts/parts/' => '@app/views/layouts/parts/',
                '@vendor/lajax/yii2-translate-manager/views/language/' => '@vendor/arter/amos-translation/src/views/translatemanager/',
                '@vendor/arter/amos-admin/src/views/first-access-wizard' => '@app/modules/aster_admin/views/first-access-wizard',
                '@app/modules/aster_admin/views/first-access-wizard' => '@vendor/arter/amos-admin/src/views/first-access-wizard',
                '@vendor/arter/amos-admin/src/views/user-profile' => '@app/modules/aster_admin/views/user-profile',
                '@app/modules/aster_admin/views/user-profile' => '@vendor/arter/amos-admin/src/views/user-profile',
                '@vendor/arter/amos-admin/src/views/security' => '@app/modules/aster_admin/views/security',
                '@app/modules/aster_admin/views/security' => '@vendor/arter/amos-admin/src/views/security',
                '@vendor/arter/amos-cwh/src/widgets/views' => '@app/modules/aster_cwh/widgets/views',
                '@app/modules/aster_cwh/widgets/views' => '@vendor/arter/amos-cwh/src/widgets/views',
                '@vendor/arter/amos-partnership-profiles/src/views' => '@app/modules/aster_partnership_profiles/views',
                '@app/modules/aster_partnership_profiles/views' => '@vendor/arter/amos-partnership-profiles/src/views',
                '@vendor/arter/amos-organizzazioni/src/views/profilo' => '@app/modules/aster_organizzazioni/views/profilo',
                '@app/modules/aster_organizzazioni/views/profilo' => '@vendor/arter/amos-organizzazioni/src/views/profilo',
                '@vendor/arter/amos-organizzazioni/src/views/profilo-sedi' => '@app/modules/aster_organizzazioni/views/profilo-sedi',
                '@app/modules/aster_organizzazioni/views/profilo-sedi' => '@vendor/arter/amos-organizzazioni/src/views/profilo-sedi',
                '@vendor/arter/amos-cwh/src/views/pubblicazione' => '@app/modules/aster_cwh/views/pubblicazione',
                '@app/modules/aster_cwh/views/pubblicazione' => '@vendor/arter/amos-cwh/src/views/pubblicazione',
                '@vendor/arter/amos-news/src/widgets/graphics/views/fullsize' => '@app/modules/aster_news/widgets/graphics/views',
                '@app/modules/aster_news/widgets/graphics/views' => '@vendor/arter/amos-news/src/widgets/graphics/views/fullsize',
                '@vendor/arter/amos-tag/src/widgets/views' => '@app/modules/aster_tag/widgets/views',
                '@app/modules/aster_tag/widgets/views' => '@vendor/arter/amos-tag/src/widgets/views',
                '@vendor/arter/amos-community/src/views/community' => '@backend/modules/aster_community/views/community',
                '@backend/modules/aster_community/views/community' => '@vendor/arter/amos-community/src/views/community',
                '@vendor/arter/amos-invitations/src/views/invitation' => '@backend/modules/aster_invitations/views',
                '@backend/modules/aster_invitations/views' => '@vendor/arter/amos-invitations/src/views/invitation',
                '@vendor/arter/amos-notify/src/views/email' => '@backend/modules/aster_notify/views/email',
                '@backend/modules/aster_notify/views/email' => '@vendor/arter/amos-notify/src/views/email',
                '@vendor/arter/amos-my-activities/src/views/my-activities' => '@backend/modules/aster_my_activities/views/my-activities',
                '@backend/modules/aster_my_activities/views/my-activities' => '@vendor/arter/amos-my-activities/src/views/my-activities',
                '@vendor/arter/amos-my-activities/src/widgets/views/fullsize' => '@app/modules/aster_my_activities/widgets/views/fullsize',
                '@app/modules/aster_my_activities/widgets/views/fullsize' => '@vendor/arter/amos-my-activities/src/widgets/views/fullsize',
                '@vendor/arter/amos-core/src/forms' => '@backend/modules/aster_core/forms',
                '@backend/modules/aster_core/forms' => '@vendor/arter/amos-core/src/forms',
                '@vendor/arter/amos-sondaggi/src/views/sondaggi' => '@backend/modules/aster_sondaggi/views/sondaggi',
                '@backend/modules/aster_sondaggi/views/sondaggi' => '@vendor/arter/amos-sondaggi/src/views/sondaggi',
                '@vendor/arter/amos-layout/src/views/layouts/fullsize/parts' => '@backend/modules/aster_layout/views/layouts/fullsize/parts',
                '@backend/modules/aster_layout/views/layouts/fullsize/parts' => '@vendor/arter/amos-layout/src/views/layouts/fullsize/parts',
                '@vendor/arter/amos-layout/src/views/layouts/parts' => '@backend/modules/aster_layout/views/layouts/parts'
            ],
        ],
    ],
    'wizflowManagerNewProject' => [
        'class' => 'arter\amos\wizflow\WizflowManager',
        'workflowName' => 'NewProjectWizardWorkflow',
        'workflowSourceName' => 'workflowSource',
        'skeyName' => '_new_project'
    ],
];
