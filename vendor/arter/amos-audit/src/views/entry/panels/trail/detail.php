<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/* @var $panel yii\debug\panels\LogPanel */
/* @var $searchModel yii\debug\models\search\Log */
/* @var $dataProvider yii\data\ArrayDataProvider */

use arter\amos\audit\Audit;
use arter\amos\audit\models\AuditTrailSearch;

use yii\helpers\Html;
use yii\grid\GridView;

echo Html::tag('h1', $panel->name);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'id'           => 'log-panel-detailed-grid',
    'options'      => ['class' => 'detail-grid-view table-responsive'],
    'filterModel'  => $searchModel,
    'columns'      => [
        [
            'class'    => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons'  => [
                'view' => function ($url, $model) {
                    return Html::a(
                        Html::tag('span', '', ['class' => 'glyphicon glyphicon-eye-open']), ['trail/view', 'id' => $model->id]
                    );
                }
            ],
            'options'  => [
                'width' => '30px',
            ],
        ],
        [
            'attribute' => 'id',
            'options'   => [
                'width' => '80px',
            ],
        ],
        [
            'attribute' => 'user_id',
            'label'     => Yii::t('audit', 'User ID'),
            'class'     => 'yii\grid\DataColumn',
            'value'     => function ($data) {
                return Audit::getInstance()->getUserIdentifier($data->user_id);
            },
            'options'   => [
                'width' => '150px',
            ],
            'format' => 'raw',
        ],
        [
            'attribute' => 'action',
            'filter'    => AuditTrailSearch::actionFilter(),
            'options'   => [
                'width' => '150px',
            ],
        ],
        [
            'attribute' => 'model',
            'options'   => [
                'width' => '150px',
            ],
        ],
        [
            'attribute' => 'model_id',
            'options'   => [
                'width' => '80px',
            ],
        ],
        [
            'attribute' => 'field',
            'options'   => [
                'width' => '100px',
            ],
        ],
        [
            'label'  => Yii::t('audit', 'Diff'),
            'value'  => function ($data) {
                return $data->getDiffHtml();
            },
            'format' => 'raw',
        ],
    ],
]);
