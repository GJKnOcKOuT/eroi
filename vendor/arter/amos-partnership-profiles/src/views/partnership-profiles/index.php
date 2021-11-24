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
 * @package    arter\amos\partnershipprofiles\views\partnership-profiles
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\views\DataProviderView;
use arter\amos\partnershipprofiles\controllers\PartnershipProfilesController;
use arter\amos\partnershipprofiles\Module;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\partnershipprofiles\models\search\PartnershipProfilesSearch $model
 * @var string $currentView
 */

$this->title = Module::t('amospartnershipprofiles', 'Partnership Profiles');
$this->params['breadcrumbs'][] = $this->title;

/** @var PartnershipProfilesController $appController */
$appController = Yii::$app->controller;
$ownInterestPartnershipProfileIds = $appController->getOwnInterestPartnershipProfiles(true);

?>
<div class="<?= Yii::$app->controller->id ?>-index">
    <?= $this->render('_search', ['model' => $model]); ?>
    <?= $this->render('_order', ['model' => $model]); ?>
    <?= DataProviderView::widget([
        'dataProvider' => $dataProvider,
        'currentView' => $currentView,
        'gridView' => [
            'columns' => $model->getGridViewColumns()
        ],
        'listView' => [
            'itemView' => '_item',
            'viewParams' => [
                'ownInterestPartnershipProfileIds' => $ownInterestPartnershipProfileIds
            ],
            'showItemToolbar' => false,
        ]
    ]); ?>
</div>
