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
use arter\amos\organizzazioni\models\Profilo;
use yii\db\ActiveQuery;

/**
 * @var yii\web\View $this
 * @var \arter\amos\projectmanagement\models\Projects $model
 */

$this->title = $model;
$this->params['breadcrumbs'][] = ['label' => \arter\amos\projectmanagement\Module::t('amosproject_management', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => strip_tags($model),
    'url' => ['update', 'id' => $model->id, '#' => 'tab-organizations']
];
$this->params['breadcrumbs'][] = \arter\amos\projectmanagement\Module::t('amosproject_management', 'Invite Organizations');

/** @var Profilo $organizationModelClass */
$organizationModelClass = \arter\amos\organizzazioni\Module::instance()->model('Profilo');

/** @var ActiveQuery $query */
$query = $organizationModelClass::find()->andFilterWhere([
    'not in',
    'id',
    $model->getProjectsJoinedOrganizationsMms()->select('organization_id')
])->orderBy('name');
$post = Yii::$app->request->post();
if (isset($post['genericSearch'])) {
    $query->andFilterWhere([
        'or',
        ['like', $organizationModelClass::tableName() . '.name', $post['genericSearch']],
        ['like', $organizationModelClass::tableName() . '.indirizzo', $post['genericSearch']],
        ['like', $organizationModelClass::tableName() . '.partita_iva', $post['genericSearch']],
        ['like', $organizationModelClass::tableName() . '.codice_fiscale', $post['genericSearch']],
    ]);
}

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
        'query' => $query
    ],
    'viewSearch' => (isset($viewM2MWidgetGenericSearch) ? $viewM2MWidgetGenericSearch : false),
    'targetUrlController' => 'projects',
    'moduleClassName' => \arter\amos\projectmanagement\Module::className(),
    'postName' => 'Project',
    'postKey' => 'Organization',
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
        'indirizzo',
    ],
]);
?>
