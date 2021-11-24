<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles\views\partnership-profiles
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

$this->title = Module::t('amospartnershipprofiles', 'Animazione sfide');
$this->params['breadcrumbs'][] = $this->title;

/** @var PartnershipProfilesController $appController */
$appController = Yii::$app->controller;
$ownInterestPartnershipProfileIds = $appController->getOwnInterestPartnershipProfiles(true);

?>
<div class="<?= Yii::$app->controller->id ?>-index">
    <?= $this->render('@vendor/arter/amos-partnership-profiles/src/views/partnership-profiles/_search', ['model' => $model]); ?>
    <!--    --><?php //$this->render('_order', ['model' => $model]); ?>
    <?= DataProviderView::widget([
        'dataProvider' => $dataProvider,
        'currentView' => $currentView,
        'gridView' => [
            'columns' => [
                'title',
                [
                    'attribute' => 'createdUserProfile',
                    'label' => Module::t('amospartnershipprofiles', 'Partnership profile creator')
                ],
                //'created_at:date',
                'partnership_profile_date:date',

                [
                'value' => function($model) {
                    return \Yii::$app->formatter->asDate($model->calculateExpiryDate());
                },
                'label' => Module::t('amospartnershipprofiles', 'Calculated Expiry Date')
                ],
                [
                    'value' => function($model){
                        $creatorProfile = \backend\modules\aster_admin\models\UserProfile::find()->andWhere(['user_id'=> $model->created_by])->one();
                        if($creatorProfile){
                            $facilitatore = $creatorProfile->facilitatore;
                            if($facilitatore){
                                return $facilitatore->nomeCognome;
                            }
                        }
                        return ' - ';
                    },
                    'label' => Module::t('partnershipprofiles', 'Nominativo del Mentor')
                ],
                [
                    'attribute' => 'partnershipProfileFacilitator.nomeCognome',
                    'label' => Module::t('partnershipprofiles', 'Nominativo dell\' Animatore')
                ],
                [
                    'class' => 'arter\amos\core\views\grid\ActionColumn',
                    'template' => '{view}{update}'
                ],

            ]
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
