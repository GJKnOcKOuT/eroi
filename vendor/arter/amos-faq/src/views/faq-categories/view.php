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
 * @package    arter\amos\faq
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\faq\AmosFaq;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var arter\amos\faq\models\FaqCategories $model
 */

$this->title = $model->titolo;
$this->params['breadcrumbs'][] = ['label' => AmosFaq::t('amosfaq', 'Faq'), 'url' => ['/src/src']];
$this->params['breadcrumbs'][] = ['label' => AmosFaq::t('amosfaq', 'Categorie'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-categories-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'titolo',
            'descrizione:ntext',
            /*           [
                           'attribute'=>'created_at',
                           'format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A'],
                           'type'=>DetailView::INPUT_WIDGET,
                           'widgetOptions'=> [
                               'class'=>DateControl::classname(),
                               'type'=>DateControl::FORMAT_DATETIME
                           ]
                       ],
                       [
                           'attribute'=>'updated_at',
                           'format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A'],
                           'type'=>DetailView::INPUT_WIDGET,
                           'widgetOptions'=> [
                               'class'=>DateControl::classname(),
                               'type'=>DateControl::FORMAT_DATETIME
                           ]
                       ],
                       [
                           'attribute'=>'deleted_at',
                           'format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A'],
                           'type'=>DetailView::INPUT_WIDGET,
                           'widgetOptions'=> [
                               'class'=>DateControl::classname(),
                               'type'=>DateControl::FORMAT_DATETIME
                           ]
                       ],
                       'created_by',
                       'updated_by',
                       'deleted_by',
                       'version',*/
        ],
    ]) ?>

</div>
