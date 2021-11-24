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

use arter\amos\core\views\AmosGridView;
use arter\amos\cwh\AmosCwh;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\cwh\models\search\CwhNodiSearch $searchModel
 */

$this->title = AmosCwh::t('amoscwh', 'Cwh Nodis');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cwh-nodi-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php  echo         \arter\amos\core\helpers\Html::a(AmosCwh::t('amoscwh', 'Nuovo {modelClass}', [
    'modelClass' => 'Cwh Nodi',
])        , ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin();
    echo AmosGridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cwh_config_id',
            'record_id',
            'classname',

            [
                'class' => 'arter\amos\core\views\grid\ActionColumn',
            ],
        ],
    ]);
    Pjax::end(); ?>

</div>
