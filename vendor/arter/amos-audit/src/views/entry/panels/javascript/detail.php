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

/* @var $panel LogPanel */
/* @var $searchModel AuditJavascriptSearch */
/* @var $dataProvider ArrayDataProvider */

use arter\amos\audit\models\AuditJavascriptSearch;

use yii\data\ArrayDataProvider;
use yii\debug\panels\LogPanel;
use yii\grid\GridView;
use yii\helpers\Html;

echo Html::tag('h1', $panel->name);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'id'           => 'log-panel-detailed-grid',
    'options'      => ['class' => 'detail-grid-view table-responsive'],
    'filterModel'  => $searchModel,
    'columns'      => [
        [
            'attribute' => 'id',
            'options'   => [
                'width' => '80px',
            ],
        ],
        [
            'filter' => $searchModel->typeFilter(),
            'attribute' => 'type',
            'options'   => [
                'width' => '80px',
            ],
        ],
        'message',
        [
            'filter' => $searchModel->originFilter(),
            'attribute' => 'origin'
        ],
        [
            'header' => Yii::t('audit', 'Data'),
            'value' => function ($data) {
                $out = '<a class="data-toggle glyphicon glyphicon-plus" href="javascript:void(0);"></a>';
                $out .= '<pre style="display:none;">';
                $out .= \yii\helpers\VarDumper::dumpAsString($data['data']);
                $out .= '</pre>';
                return $out;
            },
            'format' => 'raw',
        ],
    ],
]);

$js = <<<JS
\$('.data-toggle').click(function(){
    if ($(this).hasClass("glyphicon-plus"))
        $(this).removeClass("glyphicon-plus").addClass("glyphicon-minus").next("pre").show();
    else
        $(this).removeClass("glyphicon-minus").addClass("glyphicon-plus").next("pre").hide();
});
JS;
$this->registerJs($js);
