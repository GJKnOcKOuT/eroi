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

/* @var $panel yii\debug\panels\LogPanel */

use yii\helpers\Html;
use yii\grid\GridView;

echo Html::tag('h1', $panel->name);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'id'           => 'log-panel-detailed-grid',
    'options'      => ['class' => 'detail-grid-view table-responsive'],
    'columns'      => [
        'type',
        [
            'header' => Yii::t('audit', 'Data'),
            'value' => function ($data) {
                return \yii\helpers\VarDumper::dumpAsString($data['data']);
            }
        ]
    ]
]);
