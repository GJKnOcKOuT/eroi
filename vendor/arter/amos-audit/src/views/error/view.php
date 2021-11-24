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


/** @var yii\web\View $this */
/** @var arter\amos\audit\models\AuditError $model */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\DetailView;

$this->title = Yii::t('audit', 'Error #{id}', ['id' => $model->id]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('audit', 'Audit'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('audit', 'Errors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = '#' . $model->id;

echo Html::tag('h1', $this->title);

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        [
            'attribute' => 'entry_id',
            'value' => $model->entry_id ? Html::a($model->entry_id, ['entry/view', 'id' => $model->entry_id]) : '',
            'format' => 'raw',
        ],
        'message',
        'code',
        'file',
        'line',
        'created',
    ],
]);

echo Html::tag('h2', Yii::t('audit', 'Stack Trace'));

echo GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $model->trace,
    ]),
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'file',
        'line',
        [
            'header' => Yii::t('audit', 'Called'),
            'value' => function ($data) {
                return
                    isset($data['type']) ?
                        (( isset($data['class']) ? $data['class'] : '[unknown]') . $data['type'] . $data['function']) :
                        $data['function'];
            }
        ],
        [
            'header' => Yii::t('audit', 'Args'),
            'value' => function ($data) {
                $out = '<a class="args-toggle glyphicon glyphicon-plus" href="javascript:void(0);"></a>';
                $out .= '<pre style="display:none;">';
                $out .= VarDumper::dumpAsString($data['args']);
                $out .= '</pre>';
                return $out;
            },
            'format' => 'raw',
        ],
    ],
]);

$js = <<<JS
\$('.args-toggle').click(function(){
    if ($(this).hasClass("glyphicon-plus"))
        $(this).removeClass("glyphicon-plus").addClass("glyphicon-minus").next("pre").show();
    else
        $(this).removeClass("glyphicon-minus").addClass("glyphicon-plus").next("pre").hide();
});
JS;
$this->registerJs($js);

