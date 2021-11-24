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

$common = require(__DIR__ . '/../../common/config/main.php');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$modules = array_merge(
    $common['modules'],
    require(__DIR__ . '/modules-others.php'),
    require(__DIR__ . '/modules-amos.php')
);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// TODO verificare che non ci siano index che non caricano bootstrap, in caso non ce ne siano, questa va eliminata
$bootstrap = array_merge(
    $common['bootstrap'],
    require(__DIR__ . '/bootstrap.php')
);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$components = array_merge(
    $common['components'],
    require(__DIR__ . '/components-others.php'),
    require(__DIR__ . '/components-amos.php')
);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$params = array_merge(
    $common['params'],
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($modules['chat'])) {
    $bootstrap[] = 'chat';
}
if ($params['template-amos'] === true) {
    $bootstrap[] = 'backend\bootstrap\AssignRolesAdmin';
}

if (isset($modules['tag'])) {

    if (isset($modules['bestpractice'])) {
        $modules['tag']['modelsEnabled'][] = 'arter\amos\best\practice\models\BestPractice';
    }
    if (isset($modules['community'])) {
        $modules['tag']['modelsEnabled'][] = 'arter\amos\community\models\Community';
    }
    if (isset($modules['discussioni'])) {
        $modules['tag']['modelsEnabled'][] = 'arter\amos\discussioni\models\DiscussioniTopic';
    }
    if (isset($modules['documenti'])) {
        $modules['tag']['modelsEnabled'][] = 'arter\amos\documenti\models\Documenti';
    }
    if (isset($modules['events'])) {
        $modules['tag']['modelsEnabled'][] = 'arter\amos\events\models\Event';
    }
    if (isset($modules['news'])) {
        $modules['tag']['modelsEnabled'][] = 'arter\amos\news\models\News';
    }
    if (isset($modules['partnershipprofiles'])) {
        $modules['tag']['modelsEnabled'][] = 'backend\modules\aster_partnership_profiles\models\PartnershipProfiles';
        $modules['tag']['modelsEnabled'][] = 'arter\amos\partnershipprofiles\models\ExpressionsOfInterest';
    }
    if (isset($modules['een'])) {
        $modules['tag']['modelsEnabled'][] = 'arter\amos\een\models\EenPartnershipProposal';
    }
    if (isset($modules['organizzazioni'])) {
        $modules['tag']['modelsEnabled'][] = 'arter\amos\organizzazioni\models\Profilo';
    }
    if (isset($modules['sondaggi'])) {
        $modules['tag']['modelsEnabled'][] = 'arter\amos\sondaggi\models\Sondaggi';
    }
}

if (isset($modules['report'])) {

    if (isset($modules['discussioni'])) {
        $modules['tag']['modelsEnabled'][] = 'arter\amos\discussioni\models\DiscussioniTopic';
    }
    if (isset($modules['documenti'])) {
        $modules['tag']['modelsEnabled'][] = 'arter\amos\documenti\models\Documenti';
    }
    if (isset($modules['events'])) {
        $modules['tag']['modelsEnabled'][] = 'arter\amos\events\models\Event';
    }
    if (isset($modules['news'])) {
        $modules['tag']['modelsEnabled'][] = 'arter\amos\news\models\News';
    }
    if (isset($modules['partnershipprofiles'])) {
        $modules['report']['modelsEnabled'][] = 'backend\modules\aster_partnership_profiles\models\PartnershipProfiles';
    }
}

if (isset($modules['comments'])) {

    if (isset($modules['discussioni'])) {
        $modules['comments']['modelsEnabled'][] = 'arter\amos\discussioni\models\DiscussioniTopic';
    }
    if (isset($modules['documenti'])) {
        $modules['comments']['modelsEnabled'][] = 'arter\amos\documenti\models\Documenti';
    }
    if (isset($modules['events'])) {
        $modules['comments']['modelsEnabled'][] = 'arter\amos\events\models\Event';
    }
    if (isset($modules['news'])) {
        $modules['comments']['modelsEnabled'][] = 'arter\amos\news\models\News';
    }
}

if (isset($modules['favorites'])) {

    if (isset($modules['discussioni'])) {
        $modules['favorites']['modelsEnabled'][] = 'arter\amos\discussioni\models\DiscussioniTopic';
    }
    if (isset($modules['documenti'])) {
        $modules['favorites']['modelsEnabled'][] = 'arter\amos\documenti\models\Documenti';
    }
    if (isset($modules['news'])) {
        $modules['favorites']['modelsEnabled'][] = 'arter\amos\news\models\News';
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
return [
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            '*',
            '/build/'
        ],
    ],
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => '/admin/security/login',
    'homeUrl' => '/dashboard',
    'id' => 'app-backend',
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    'bootstrap' => $bootstrap,
    'components' => $components,
    'modules' => $modules,
    'params' => $params,
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
];
