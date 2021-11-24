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


use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model array */

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'headers',
        'from',
        'to',
        'charset',
        [
            'attribute' => 'time',
            'format' => 'datetime',
        ],
        'subject',
        [
            'attribute' => 'body',
            'label' => 'Text body',
        ],
        [
            'attribute' => 'isSuccessful',
            'label' => 'Successfully sent',
            'value' => $model['isSuccessful'] ? 'Yes' : 'No'
        ],
        'reply',
        'bcc',
        'cc',
        [
            'attribute' => 'file',
            'format' => 'html',
            'value' => Html::a('Download eml', ['download-mail', 'file' => $model['file']]),
        ],
    ],
]);
