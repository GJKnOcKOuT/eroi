<?php
/**
 * @User GJKnOcKOuT
 * @Project basic
 * @Date 11/01/2022
 */

namespace backend\modules\supercraft\models;

use yii\base\Model;
use yii\grid\GridView;

/**
 * @Class dashboard
 * @Package app\models
 * @Author Aldini Alessandro <alessandro.aldini@outlook.it>
 */
class dashboard extends Model
{
    public function grid($dataProvider, $searchModel)
    {
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id_processo_aziendale',
                //'id_processo_innovativo',
                'nome',
                'id_azienda',
                'data_inizio',
                //'data_fine',
                'descrizione:ntext',
                //'copertina',
                //'id_fase_attuale',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    }

}
