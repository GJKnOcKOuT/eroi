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
 * @package    arter\amos\discussioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\utilities\ViewUtility;
use arter\amos\discussioni\AmosDiscussioni;
use kartik\datecontrol\DateControl;
use kartik\detail\DetailView;

/**
 * @var yii\web\View $this
 * @var arter\amos\discussioni\models\DiscussioniRisposte $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => AmosDiscussioni::t('amosdiscussioni', 'Discussioni Rispostes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discussioni-risposte-view">
<?= DetailView::widget([
    'model' => $model,
    'condensed' => false,
    'hover' => true,
    'mode' => Yii::$app->request->get('edit') == 't' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
    'panel' => [
        'heading' => $this->title,
        'type' => DetailView::TYPE_INFO,
    ],
    'attributes' => [
        'id',
        'testo:ntext',
        'discussioni_topic_id',
        [
            'attribute' => 'created_at',
            'format' => ['datetime', ViewUtility::formatDateTime()],
            'type' => DetailView::INPUT_WIDGET,
            'widgetOptions' => [
                'class' => DateControl::className(),
                'type' => DateControl::FORMAT_DATETIME
            ]
        ],
        [
            'attribute' => 'updated_at',
            'format' => ['datetime', ViewUtility::formatDateTimeTime()],
            'type' => DetailView::INPUT_WIDGET,
            'widgetOptions' => [
                'class' => DateControl::className(),
                'type' => DateControl::FORMAT_DATETIME
            ]
        ],
        [
            'attribute' => 'deleted_at',
            'format' => ['datetime', ViewUtility::formatDateTime()],
            'type' => DetailView::INPUT_WIDGET,
            'widgetOptions' => [
                'class' => DateControl::className(),
                'type' => DateControl::FORMAT_DATETIME
            ]
        ],
        'created_by',
        'updated_by',
        'deleted_by',
        'version',
    ],
    'deleteOptions' => [
        'url' => ['delete', 'id' => $model->id],
        'data' => [
            'confirm' => AmosDiscussioni::t('amosdiscussioni', 'Sei sicuro di voler cancellare questo elemento?'),
            'method' => 'post',
        ],
    ],
    'enableEditMode' => true,
]) ?>
</div>
