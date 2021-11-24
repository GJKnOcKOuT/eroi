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


/**@var $this \yii\web\View */

/**@var $content string */

use arter\amos\utility\assets\SiPackagesAsset;
use arter\amos\utility\Module;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

$this->title = Module::t('amosutility', 'Packages');
$this->params['breadcrumbs'][] = $this->title;

$lockArray = json_decode($composerLock, true);

$script = <<<JS
    var chart = d3.chart.dependencyWheel().width(1000);
    var composerlock = $composerLock;
    var composerjson = $composerJson;

    var data = buildMatrixFromComposerJsonAndLock(composerjson, composerlock);
    d3.select('#chart_placeholder')
        .datum(data)
        .call(chart);
JS;

SiPackagesAsset::register($this);
$this->registerJs($script, $this::POS_READY);

?>
<div class="container">
    <h1>Platform Packages Info</h1>

    <p class="lead">
        This is a system report with the current packages in use and all dependencies
    </p>

    <p class="lead">
        Check also <a href="/utility/packages/requirements">System Requirements</a>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => new ArrayDataProvider([
            'allModels' => $lockArray['packages'],
            'sort' => [
                'attributes' => ['name', 'version', 'description'],
            ],
            'pagination' => [
                'pageSize' => 1000,
            ],
        ]),
        'layout' => '{items}',
        'columns' => [
            [
                'label' => 'Name',
                'value' => 'name',
                'format' => 'raw'
            ],
            [
                'label' => 'Version',
                'value' => 'version',
                'format' => 'raw'
            ],
            [
                'label' => 'Description',
                'value' => 'description',
                'format' => 'raw'
            ],
        ]
    ]);
    ?>

    <h2>Graph</h2>
    <div id="chart_placeholder"></div>
</div>
