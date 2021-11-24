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

use arter\amos\core\forms\editors\m2mWidget\M2MWidget;

/**
 * @var yii\web\View $this
 * @var \arter\amos\projectmanagement\models\Projects $model
 */

$activity = $model->projectsActivities;

$this->title = $model;
$this->params['breadcrumbs'][] = [
    'label' => \arter\amos\projectmanagement\Module::t('amosproject_management', 'Projects'),
    'url' => ['/project_management']
];
$this->params['breadcrumbs'][] = ['label' => strip_tags($activity->projects)];
$this->params['breadcrumbs'][] = [
    'label' => \arter\amos\projectmanagement\Module::t('amosproject_management', 'Project Activities'),
    'url' => ['/project_management/projects-activities/by-project', 'pid' => $activity->projects->id]
];
$this->params['breadcrumbs'][] = [
    'label' => strip_tags($model),
    'url' => ['update', 'id' => $model->id, '#' => 'tab-organizations']
];
$this->params['breadcrumbs'][] = \arter\amos\projectmanagement\Module::t('amosproject_management', 'Invite Organizations');

$organizationModelClass = \arter\amos\organizzazioni\Module::instance()->model('Profilo');

?>
<?= M2MWidget::widget([
    'model' => $model,
    'modelId' => $model->id,
    'modelData' => $model->getJoinedOrganizations(),
    'modelDataArrFromTo' => [
        'from' => 'id',
        'to' => 'id'
    ],
    'modelTargetSearch' => [
        'class' => $organizationModelClass::className(),
        'query' => $model->projectsActivities->projects->getParticipantsOrganizations()
            ->andFilterWhere([
                'not in',
                'id',
                $model->getProjectsTasksJoinedOrganizationsMms()->select('organization_id')
            ]),//$query,
    ],

    'targetUrlController' => 'projects-tasks',
    'moduleClassName' => \arter\amos\projectmanagement\Module::className(),
    'postName' => 'Project Task',
    'postKey' => 'projects-tasks',
    'targetColumnsToView' => [
        'name' => [
            'attribute' => 'name',
            'label' => \arter\amos\projectmanagement\Module::t('amosproject_management', 'Name'),
            'headerOptions' => [
                'id' => \arter\amos\projectmanagement\Module::t('amosproject_management', 'Name'),
            ],
            'contentOptions' => [
                'headers' => \arter\amos\projectmanagement\Module::t('amosproject_management', 'Name'),
            ]
        ],
        'addressField:raw',
//        'numero_civico',
//        'cap'
    ],
]);
?>
