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
use arter\amos\core\helpers\Html;
use arter\amos\organizzazioni\models\ProfiloSedi;
use arter\amos\organizzazioni\Module;
use arter\amos\organizzazioni\widgets\JoinProfiloSediWidget;
use yii\db\ActiveQuery;

/**
 * @var yii\web\View $this
 * @var \arter\amos\organizzazioni\models\ProfiloSedi $model
 */

$this->title = Module::t('amosorganizzazioni', '#add_headquarter');
$this->params['breadcrumbs'][] = $this->title;

$userId = Yii::$app->request->get("id");

/** @var ProfiloSedi $headquarter */
$headquarter = Module::instance()->createModel('ProfiloSedi');
/** @var ActiveQuery $query */
$query = $headquarter->getAssociateHeadquarterQuery($userId);

$post = Yii::$app->request->post();
$modelProfiloSedi = Module::instance()->createModel('ProfiloSedi');
if (isset($post['genericSearch'])) {
    /** @var ProfiloSedi $modelProfiloSedi */
    $query->andFilterWhere(['like', $modelProfiloSedi::tableName() . '.name', $post['genericSearch']]);
}

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
        'class' => Module::instance()->createModel('ProfiloSedi')->className(),
        'query' => $query,
    ],
    'targetFooterButtons' => Html::a(Module::t('amosorganizzazioni', '#close'), Yii::$app->urlManager->createUrl([
        '/organizzazioni/profilo-sedi/annulla-m2m',
        'id' => $userId
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
        'profilo_sedi_type_id' => [
            'attribute' => 'profilo_sedi_type_id',
            'value' => 'profiloSediType.name'
        ],
        'name',
        [
            'attribute' => 'addressField',
            'format' => 'raw',
            'label' => $modelProfiloSedi->getAttributeLabel('addressField')
        ],
        [
            'label' => $modelProfiloSedi->getAttributeLabel('profilo'),
            'value' => 'profilo.name'
        ],
        [
            'class' => 'arter\amos\core\views\grid\ActionColumn',
            'template' => '{info}{view}{joinOrganization}',
            'buttons' => [
                'joinOrganization' => function ($url, $model) {
                    $btn = JoinProfiloSediWidget::widget(['model' => $model, 'isGridView' => true]);
                    return $btn;
                }
            ]
        ]
    ]
]);
?>
