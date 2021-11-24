<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_organizzazioni\views\profilo
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\views\DataProviderView;
use arter\amos\organizzazioni\Module;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\organizzazioni\models\search\ProfiloSearch $model
 */

$this->title = Module::t('amosorganizzazioni', 'Organizzazioni');
$this->params['breadcrumbs'][] = $this->title;

/** @var \arter\amos\organizzazioni\models\Profilo $profiloModel */
$profiloModel = Module::instance()->createModel('Profilo');

?>

<div class="are-profilo-index">
    <?= $this->render('_search', ['model' => $model]); ?>
    <?= DataProviderView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $model,
        'currentView' => $currentView,
        'gridView' => [
            'columns' => [
                'name',
                [
                    'label' => $profiloModel->getAttributeLabel('tipologia_di_organizzazione'),
                    'attribute' => 'tipologiaDiOrganizzazione.name'
                ],
                'addressField:raw',
                'operativeHeadquarter.email',
                [
                    'class' => 'arter\amos\core\views\grid\ActionColumn',
                ]
            ]
        ]
    ]); ?>
</div>
