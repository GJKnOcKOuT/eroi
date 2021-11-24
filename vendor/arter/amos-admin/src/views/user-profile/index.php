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
 * @package    arter\amos\admin\views\user-profile
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\base\ConfigurationManager;
use arter\amos\admin\widgets\UserCardWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\views\DataProviderView;

/**
 * @var yii\web\View $this
 * @var \arter\amos\admin\models\UserProfile $model
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var string $currentView
 * @var string $fromAction
 */

$fromAction = (isset($fromAction) ? $fromAction : 'index');

/** @var \arter\amos\admin\controllers\UserProfileController $appController */
$appController = Yii::$app->controller;
$adminModule = AmosAdmin::instance();
?>
<div class="user-profile-index">
    <?= $this->render(
        '_search',
        [
            'model' => $model,
            'originAction' => $appController->action->id
        ]);
    ?>
    <?= $this->render('_order', ['model' => $model]); ?>

    <?php
    $columns = [];
    $columns['userProfileImage'] = [
        'label' => $model->getAttributeLabel('userProfileImage'),
        'format' => 'raw',
        'value' => function ($model) {
            /** @var \arter\amos\admin\models\UserProfile $model */

            return UserCardWidget::widget(['model' => $model, 'avatarDimension' => 'table_small']);
        }
    ];
    $columns[] = 'nome';
    $columns[] = 'cognome';

    switch ($fromAction) {
        case 'inactive-users':
            $columns['user.email'] = [
                'attribute' => 'user.email',
                'label' => AmosAdmin::t('amosadmin', 'Email')
            ];

            if ($adminModule->confManager->isVisibleBox('box_prevalent_partnership', ConfigurationManager::VIEW_TYPE_FORM) &&
                $adminModule->confManager->isVisibleField('prevalent_partnership_id', ConfigurationManager::VIEW_TYPE_FORM)) {
                $columns['prevalentPartnership.name'] = [
                    'attribute' => 'prevalentPartnership.name',
                    'label' => $model->getAttributeLabel('prevalentPartnership')
                ];
            }

            $columns[] = [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    /** @var \arter\amos\admin\models\UserProfile $model */
                    return Yii::$app->formatter->asDatetime($model->updated_at);
                }
            ];
            break;
        default:
            if ($adminModule->confManager->isVisibleBox('box_prevalent_partnership', ConfigurationManager::VIEW_TYPE_FORM) &&
                $adminModule->confManager->isVisibleField('prevalent_partnership_id', ConfigurationManager::VIEW_TYPE_FORM)) {
                $columns['prevalentPartnership.name'] = [
                    'attribute' => 'prevalentPartnership.name',
                    'label' => $model->getAttributeLabel('prevalentPartnership')
                ];
            }

            if ($adminModule->confManager->isVisibleBox('box_facilitatori', ConfigurationManager::VIEW_TYPE_FORM)) {
                $columns['facilitatore.nomeCognome'] = [
                    'attribute' => 'facilitatore.nomeCognome',
                    'label' => $model->getAttributeLabel('facilitatore')
                ];
            }
            if ($adminModule->confManager->isVisibleBox('box_facilitatori', ConfigurationManager::VIEW_TYPE_FORM)) {
                $columns['facilitatore.nomeCognome'] = [
                    'attribute' => 'facilitatore.nomeCognome',
                    'label' => $model->getAttributeLabel('facilitatore')
                ];
            }
            if (!$adminModule->bypassWorkflow) {
                $columns[] = [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        /** @var \arter\amos\admin\models\UserProfile $model */
                        return $model->hasWorkflowStatus() ? AmosAdmin::t('amosadmin', $model->getWorkflowStatus()->getLabel()) : '-';
                    }
                ];
            }
            break;
    }

    $columns[] = [
        'class' => 'arter\amos\core\views\grid\ActionColumn',
        'template' => '{view} {update} {registra}',
        'buttons' => [
            'registra' => function ($url, $model) {
                /** @var \arter\amos\admin\models\UserProfile $model */
                $utente = Yii::$app->getUser();
                if ($utente->can('REGISTRAZIONE_ACCESSI')) {
                    return Html::a(AmosIcons::show(
                            'timer',
                            ['class' => 'btn btn-tool-secondary bk-btnPagine'])
                        . '<span class="sr-only">'
                        . AmosAdmin::t('amosadmin', 'Registra l\'accesso al servizio di facilitazione')
                        . '</span>', Yii::$app->urlManager->createUrl([
                        '/puntopei/pei-accessi-servizi-facilitazione/create',
                        'user_profile_id' => $model->id
                    ]),
                        [
                            'title' => AmosAdmin::t('amosadmin', 'Registra l\'accesso al servizio di facilitazione')
                        ]);
                } else {
                    return '';
                }
            }
        ]
    ];

    $dataProviderViewWidgetConf = [
        'dataProvider' => $dataProvider,
        //'filterModel' => $model,
        'currentView' => $currentView,
        'iconView' => [
            'itemView' => '_icon'
        ],
        'gridView' => [
            'columns' => $columns
        ],
        'listView' => [
            'itemView' => '_item'
        ],
        /* 'mapView' => [
            'itemView' => '_map',
            'markerConfig' => [
                'lat' => 'domicilio_lat',
                'lng' => 'domicilio_lon',
                'icon' => 'iconaMarker'
            ],
        ]*/
    ];

    // View export button only if the logged user have the ADMIN role.
    if (Yii::$app->user->can('ADMIN') || Yii::$app->user->can('AMMINISTRATORE_UTENTI')) {
        $dataProviderViewWidgetConf['exportConfig'] = [
            'exportEnabled' => true,
            'exportColumns' => $appController->getExportColumns($model)
        ];
    }
    ?>

    <?= DataProviderView::widget($dataProviderViewWidgetConf); ?>
</div>
