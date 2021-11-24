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
 * @var arter\amos\een\models\search\EenTagEenSearch $model
 */
$this->title                   = Yii::t('amoscore', 'Tutti i tag EEN');
//$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['/een']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['help'] = 'info';

?>
<div class="een-tag-een-index">
    <?= $this->render('_search', ['model' => $model, 'originAction' => Yii::$app->controller->action->id]); ?>

    <?=
    DataProviderView::widget([
        'dataProvider' => $dataProvider,
        'currentView' => $currentView,
        'gridView' => [
            'rowOptions' => function($model) {
                if (empty($model->eenTagS3TagEenMm)) {
                    return ['class' => 'danger'];
                }
            },
            'columns' => [
                'id_een',
//                'name',
                'description',
                [
                    'class' => 'arter\amos\core\views\grid\ActionColumn',
                    'template' => '{associa}',
                    'buttons' => [
                        'associa' => function($url, $model) {
                            if (empty($model->eenTagS3TagEenMm)) {
                                return Html::a(\arter\amos\core\icons\AmosIcons::show('plus'),
                                        ['/een/een-tag-s3-tag-een-mm/create', 'tagEen' => $model->id, 'url' => '/een/een-tag-een/index'],
                                        [
                                        'class' => ['btn btn-tools-secondary'],
                                        'title' => \arter\amos\een\AmosEen::t('amoseen', 'Aggiungi conversione')
                                ]);
                            }else{
                                return Html::a(\arter\amos\core\icons\AmosIcons::show('edit'),
                                    ['/een/een-tag-s3-tag-een-mm/update','id' => $model->eenTagS3TagEenMm->id ,'url' => '/een/een-tag-een/index'],
                                    [
                                        'class' => ['btn btn-tools-secondary'],
                                        'title' => \arter\amos\een\AmosEen::t('amoseen', 'Modifica')
                                    ]);
                            }
                        },

                        
                    ]
                ],
            ],
        ],
    ]);
    ?>

</div>
