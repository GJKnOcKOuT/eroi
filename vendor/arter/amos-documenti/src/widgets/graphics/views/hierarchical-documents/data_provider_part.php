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
 * @package    arter\amos\documenti\widgets\graphics\views\hierarchical-documents
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\views\DataProviderView;

/**
 * @var yii\web\View $this
 * @var arter\amos\documenti\widgets\graphics\WidgetGraphicsHierarchicalDocuments $widget
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var string $currentView
 */

?>

<?= DataProviderView::widget([
    'dataProvider' => $dataProvider,
    'currentView' => $currentView,
    'gridView' => [
        'columns' => $widget->getGridViewColumns()
    ],
    'iconView' => [
        'itemView' => '_icon',
        'itemOptions' => [
            'class' => 'col-xs-12 col-sm-4 col-md-2',
            'aria-selected' => 'false',
            'role' => 'option'
        ]
    ]
]); ?>
