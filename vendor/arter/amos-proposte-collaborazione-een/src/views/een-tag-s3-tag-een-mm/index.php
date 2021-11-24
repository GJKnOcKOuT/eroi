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
 * @package    @backend/modules/aster_een/views
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\views\DataProviderView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\een\models\search\EenTagS3TagEenMmSearch $model
 */

$this->title = Yii::t('amoscore', 'Gestione tabella di conversione TAG EEN in TAG S3 RER');
$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['/modules']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="een-tag-s3-tag-een-mm-index">
    <?= $this->render('_search', ['model' => $model, 'originAction' => Yii::$app->controller->action->id]); ?>

    <?= DataProviderView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $model,
        'currentView' => $currentView,
        'gridView' => [
            'columns' => [
                'eenTagEen.id_een' => [
                    'attribute' => 'eenTagEen.id_een',
                    'format' => 'html',
                    'label' => 'ID TAG EEN',
                    'value' => function ($model) {
                        return $model->eenTagEen->id_een;
                    }
                ],
                'eenTagEen' => [
                    'attribute' => 'eenTagEen',
                    'format' => 'html',
                    'label' => 'TAG EEN',
                    'value' => function ($model) {
                        return $model->eenTagEen->name;
                    }
                ],
                'tag' => [
                    'attribute' => 'tag',
                    'format' => 'html',
                    'label' => 'TAG S3',
                    'value' => function ($model) {
                        return $model->tagS3->nome;
                    }
                ],
                'description',
                [
                    'class' => 'arter\amos\core\views\grid\ActionColumn',
                ],
            ],
        ],
    ]); ?>

</div>
