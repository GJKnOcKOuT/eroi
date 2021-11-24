<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\organizzazioni\views\profilo
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserProfile;
use arter\amos\core\forms\editors\m2mWidget\M2MWidget;
use arter\amos\core\helpers\Html;
use arter\amos\organizzazioni\controllers\ProfiloController;
use arter\amos\organizzazioni\models\Profilo;
use arter\amos\organizzazioni\Module;
use arter\amos\organizzazioni\widgets\JoinProfiloWidget;
use arter\amos\organizzazioni\widgets\ProfiloCardWidget;

/**
 * @var yii\web\View $this
 * @var \arter\amos\organizzazioni\models\Profilo $model
 */

$this->title = Module::t('amosorganizzazioni', '#add_organization');
$this->params['breadcrumbs'][] = $this->title;

/** @var AmosAdmin $adminModule */
$adminModule = AmosAdmin::instance();

/** @var Module $organizzazioniModule */
$organizzazioniModule = Module::instance();

/** @var ProfiloController $appController */
$appController = Yii::$app->controller;

$userProfileId = Yii::$app->request->get("id");

/** @var UserProfile $userProfileModel */
$userProfileModel = $adminModule->createModel('UserProfile');
$userProfile = $userProfileModel::findOne(['id' => $userProfileId]);
$userId = $userProfile->user_id;

$query = $appController->getAssociateOrganizationM2mQuery($userId);

/** @var Profilo $modelProfilo */
$modelProfilo = $organizzazioniModule->createModel('Profilo');

?>
<?= M2MWidget::widget([
    'model' => $model,
    'modelId' => $model->id,
    'modelData' => $query,
    'modelDataArrFromTo' => [
        'from' => 'id',
        'to' => 'id'
    ],
    'modelTargetSearch' => [
        'class' => $modelProfilo->className(),
        'query' => $query,
    ],
    'targetFooterButtons' => Html::a(Module::t('amosorganizzazioni', '#close'), Yii::$app->urlManager->createUrl([
        '/organizzazioni/profilo/annulla-m2m',
        'id' => $userProfileId
    ]), ['class' => 'btn btn-secondary', 'AmosOrganizzazioni' => Module::t('amosorganizzazioni', '#close')]),
    'renderTargetCheckbox' => false,
    'viewSearch' => (isset($viewM2MWidgetGenericSearch) ? $viewM2MWidgetGenericSearch : false),
//    'relationAttributesArray' => ['status', 'role'],
    'targetUrlController' => 'profilo',
    'targetActionColumnsTemplate' => '{joinOrganization}',
    'moduleClassName' => Module::className(),
    'postName' => 'Organization',
    'postKey' => 'organization',
    'targetColumnsToView' => [
        'logo' => [
            'headerOptions' => [
                'id' => Module::t('amosorganizzazioni', '#logo'),
            ],
            'contentOptions' => [
                'headers' => Module::t('amosorganizzazioni', '#logo'),
            ],
            'label' => Module::t('amosorganizzazioni', '#logo'),
            'format' => 'raw',
            'value' => function ($model) {
                /** @var Profilo $model */
                return ProfiloCardWidget::widget(['model' => $model]);
            }
        ],
        'name',
        'created_by' => [
            'attribute' => 'created_by',
            'format' => 'html',
            'value' => function ($model) {
                /** @var Profilo $model */
                $name = '-';
                if (!is_null($model->createdUserProfile)) {
                    return $model->createdUserProfile->getNomeCognome();
                }
                return $name;
            }
        ],
        [
            'class' => 'arter\amos\core\views\grid\ActionColumn',
            'template' => '{info}{view}{joinOrganization}',
            'buttons' => [
                'joinOrganization' => function ($url, $model) use ($userId) {
                    /** @var Profilo $model */
                    $btn = JoinProfiloWidget::widget(['model' => $model, 'userId' => $userId, 'isGridView' => true]);
                    return $btn;
                }
            ]
        ]
    ]
]);
?>
