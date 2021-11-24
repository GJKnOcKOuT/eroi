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
use arter\amos\core\icons\AmosIcons;

use yii\helpers\Html;
use yii\grid\ActionColumn;
    
$this->title = 'Import list';
$this->params['breadcrumbs'][] = $this->title;

echo AmosGridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'name_file',
        [
            'attribute' => 'successfull',
            'format' => 'boolean'
        ],
        [
            'attribute' => 'created_at',
            'format' => 'datetime'
        ],
        [
            'class' => ActionColumn::className(),
            'template' => '{download}',
            'buttons' => [
                'download' => function($url, $model){
                    return Html::a(
                        AmosIcons::show('download'),
                        ['/import/default/generate-excel', 'id' => $model->id], 
                        ['class' => 'btn btn-tools-secondary']
                    );
                }
            ]
        ]
    ]
]);
