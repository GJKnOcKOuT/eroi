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

/* @var $panel MailPanel */
/* @var $searchModel AuditMailSearch */
/* @var $dataProvider ArrayDataProvider */

use arter\amos\audit\models\AuditMailSearch;
use arter\amos\audit\panels\MailPanel;

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

echo Html::tag('h1', $panel->name);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'class'    => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons'  => [
                'view' => function ($url, $model) {
                    return Html::a(
                        Html::tag('span', '', ['class' => 'glyphicon glyphicon-eye-open']), ['mail/view', 'id' => $model->id]
                    );
                }
            ],
            'options'  => [
                'width' => '30px',
            ],
        ],
        [
            'attribute' => 'id',
            'options' => [
                'width' => '80px',
            ],
        ],
        [
            'attribute' => 'successful',
            'options' => [
                'width' => '80px',
            ],
        ],
        'to',
        'from',
        'reply',
        'cc',
        'bcc',
        'subject',
    ],
]);
