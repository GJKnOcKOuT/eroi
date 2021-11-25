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


use arter\amos\core\views\DataProviderView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\best\practice\models\search\BestPracticeSearch $model
 */

$actionColumn = '{view}{update}{delete}';
$gridViewColumns = $model->getGridViewColumns();

?>
<div class="best-practice-index">
    <?= $this->render('_search', ['model' => $model]); ?>
    <?= $this->render('_order', ['model' => $model]); ?>
    <?php echo DataProviderView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $model,
        'currentView' => $currentView,

        'gridView' => [
            'columns' => \yii\helpers\ArrayHelper::merge($gridViewColumns, [
                [
                    'class' => 'arter\amos\core\views\grid\ActionColumn',
                    'template' => $actionColumn
                ]
            ]),
            'enableExport' => false//true
        ],

        'listView' => [
            'itemView' => '_item',
        ],

    ]); ?>
</div>
