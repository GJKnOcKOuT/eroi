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
 * @package    arter\amos\myactivities\views\my-activities
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\views\DataProviderView;
use arter\amos\myactivities\AmosMyActivities;
use arter\amos\myactivities\assets\ModuleMyActivitiesAsset;

ModuleMyActivitiesAsset::register($this);

/**
 * @var yii\web\View $this
 * @var yii\web\View $currentView
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var \arter\amos\myactivities\models\search\MyActivitiesModelSearch $model
 * @var array $parametro
 */

$this->title = "";
$this->params['breadcrumbs'][] = ['label' => AmosMyActivities::t('amosmyactivities', 'My activities'), 'url' => ['/my-activities']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="my-activities-index">
    <?= $this->render('_search', ['modelSearch' => $model]); ?>
    <?= $this->render('_order', ['modelSort' => $model]); ?>
    <?= DataProviderView::widget([
        'dataProvider' => $dataProvider,
        'currentView' => $currentView,
        'listView' => [
            'itemView' => '_switch_item',
        ],
    ]); ?>
</div>
