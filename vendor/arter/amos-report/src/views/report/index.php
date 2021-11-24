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
 * @package    arter-report
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\views\DataProviderView;
use arter\amos\report\AmosReport;
use yii\widgets\Pjax;
use arter\amos\core\helpers\Html;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\report\models\search\ReportSearch $searchModel
 * @var \arter\amos\dashboard\models\AmosUserDashboards $currentDashboard
 *
 */

?>
<div class="report-index">
    <?php
    echo $this->render('_search', ['model' => $model]);
    echo $this->render('_order', ['model' => $model]);
    ?>
<?php
Pjax::begin();
echo DataProviderView::widget([
    'dataProvider' => $dataProvider,
    'currentView' => $currentView,
    'gridView' => [
        //'filterModel' => $model,
        'columns' => [
            'content' => [
                'value' => function($model) {
                    return StringHelper::truncateWords($model->content,20,'...');
                }
            ],
            'created_by' => [
                'attribute' => 'createdUserProfile',
                'label' => AmosReport::t('amosreport', 'Pubblicato Da')
            ],
            'created_at' => [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return (is_null($model->created_at)) ? 'Subito' : Yii::$app->formatter->asDate($model->data_pubblicazione);
                }
            ],
            'status' => [
                'attribute' => 'status',
            ],
            [
                'class' => 'arter\amos\core\views\grid\ActionColumn',
            ]
        ]
    ]
]);
Pjax::end();
?>

</div>