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
 * @package    @vendor/arter/amos-attachments/src/views
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\views\DataProviderView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\attachments\models\search\AttachGallerySearch $model
 */

$this->title = \arter\amos\attachments\FileModule::t('amosattachments', 'Gallery');
$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['/attachments']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attach-gallery-index">
    <?= $this->render('_search', ['model' => $model, 'originAction' => Yii::$app->controller->action->id]); ?>

    <?= DataProviderView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $model,
        'currentView' => $currentView,
        'gridView' => [
            'columns' => [
                'slug',
                'name',
                'description:striptags',
                [
                    'class' => 'arter\amos\core\views\grid\ActionColumn',
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                            'delete' => function($url, $model){
                                if($model->slug == 'general'){
                                    return '';
                                }
                                return Html::a(\arter\amos\core\icons\AmosIcons::show('delete'), $url, [
                                    'class' => 'btn btn-danger-inverse',
                                    'data-confirm' => \arter\amos\attachments\FileModule::t('amosatachments','Sei sicuro di eliminare la galleria e tutte le immagini al suo interno?')]);
                            }
                    ]
                ],
            ],
        ],
    ]); ?>

</div>
