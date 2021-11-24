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
 * @package    arter\amos\core\forms\views\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/** @var \arter\amos\core\forms\PublishedContentsWidget $widget */

use arter\amos\core\icons\AmosIcons;
use arter\amos\core\views\AmosGridView;
use arter\amos\core\forms\AccordionWidget;

?>

<?= AccordionWidget::widget([
    'items' => [
        [
            'header' => $widget->modelIcon . $widget->modelLabel . ' <span class="bold">(' . $widget->data->totalCount . ')</span>',
            'content' => AmosGridView::widget([
                'dataProvider' =>  $widget->data,
                'summary' => '',
                'emptyText' => Yii::t('amoscore','Nessun elemento di questa categoria pubblicato dalla community'),
                'columns' => $widget->gridViewColumns
            ]),
        ]
    ],
    'headerOptions' => ['tag' => 'h2'],
    'clientOptions' => [
        'collapsible' => true,
        'active' => 'false',
        'icons' => [
            'header' => 'ui-icon-amos am am-plus-square',
            'activeHeader' => 'ui-icon-amos am am-minus-square',
        ],
    ],
    'options' => [
        'class' => ''
    ]
]); ?>
