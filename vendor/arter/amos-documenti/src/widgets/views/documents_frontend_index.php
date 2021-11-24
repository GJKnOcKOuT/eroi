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


use arter\amos\core\helpers\Html;
use arter\amos\documenti\AmosDocumenti;


?>
<?php
/** @var $model \arter\amos\documenti\models\Documenti
 *  @var $widget \arter\amos\documenti\widgets\DocumentsFrontendWidget
 */
?>
<?php
$showPageSummary = $widget->showPageSummary;
echo \arter\amos\core\views\AmosGridView::widget([
    'dataProvider' => $dataProvider,
    'showPageSummary' => $showPageSummary,
    'columns' => [
        [
            'label' => '',
            'value' => function($model) use ($view_item){
                return $this->render($view_item, ['model' => $model]);
            },
            'format' => 'raw',
        ]
    ]
])
?>
