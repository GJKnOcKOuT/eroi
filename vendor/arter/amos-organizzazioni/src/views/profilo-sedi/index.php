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
 * @package    arter\amos\organizzazioni\views\profilo-sedi
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\views\DataProviderView;
use arter\amos\organizzazioni\Module;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\organizzazioni\models\search\ProfiloSediSearch $model
 */

$this->title = Module::t('amosorganizzazioni', 'Profilo Sedi');
$this->params['breadcrumbs'][] = $this->title;

/** @var \arter\amos\organizzazioni\models\ProfiloSedi $profiloSediModel */
$profiloSediModel = Module::instance()->createModel('ProfiloSedi');

?>
<div class="profilo-sedi-index">
    <?= $this->render('_search', ['model' => $model]); ?>
    <?= DataProviderView::widget([
        'dataProvider' => $dataProvider,
        'currentView' => $currentView,
        'gridView' => [
            'columns' => $profiloSediModel->getGridViewColumns()
        ],
    ]); ?>
</div>
