<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles\views\partnership-profiles\fullsize
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use backend\modules\aster_partnership_profiles\models\UsersAnimationMm;
use backend\modules\aster_partnership_profiles\utility\PartnershipProfilesUtility;
use arter\amos\core\views\AmosGridView;
use arter\amos\partnershipprofiles\Module;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use arter\amos\core\forms\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\aster_partnership_profiles\models\search\UsersAnimationMmSearch $searchModel
 */

$classNameCheck = '';
$classNameCheck = $interested ? 'tag' : 'notag';


$finalQuery = (new \yii\db\Query)
                ->select('*')
                ->from(new \yii\db\Expression("(".$dataProvider->query->createCommand()->rawSql.") as finalquery"));

$dataProvider->query = $finalQuery;

$dataProvider->setSort([
    'attributes' => [
        'name',
        'number_msg',
        'solution_sent',
        'select_keyword',
        'created_at',
        'num_tag' => [
            'asc' => ['num_tag' => SORT_ASC, 'num_tag' => SORT_ASC],
            'desc' => ['num_tag' => SORT_DESC, 'num_tag' => SORT_DESC],
            'default' => SORT_ASC
        ]
    ]
]);

$actionColumn = '{chat}{delete}';

$deleteMsg = Module::t('partnershipprofiles', 'Sei sicuro di voler cancellare questo elemento?');

$js = <<<JS
    
    $('.delete-useranimation-btn').on('click', function(event) {
        event.preventDefault();
        var ok = confirm("$deleteMsg");
        if (ok) {
            window.location.href = $(this).attr('href');
        }
        return false;
    });
JS;
$this->registerJs($js, View::POS_READY);
?>
<div class="news-categorie-index">
<?php
echo AmosGridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
    //'filterModel' => $model,
    'columns' => [
        [
            'class' => 'arter\amos\core\views\grid\CheckboxColumn',
            'header' => '',
            'checkboxOptions' => function ($model, $key, $index, $column) use ($classNameCheck) {
                $checkboxOptions = [
                    'value' => $model['id'],
                    'class' => 'correlations-target-checkbox' . '-' . $classNameCheck,
                ];
                return $checkboxOptions;
            },
            'multiple' => true
        ],
        'User image' => [
            'headerOptions' => [
                'id' => Module::t('amospartnershipprofiles', 'User image'),
            ],
            'contentOptions' => [
                'headers' => Module::t('amospartnershipprofiles', 'User image'),
            ],
            'label' => Module::t('amospartnershipprofiles', 'User image'),
            'format' => 'raw',
            'value' => function ($model) {
                /** @var \arter\amos\core\user\User $model */
                /** @var \arter\amos\admin\models\UserProfile $userProfile */
		$model = UsersAnimationMm::findOne(['id' => $model['id']]);
                $userProfile = $model->user->userProfile;
                return empty($userProfile) ? '' : \arter\amos\admin\widgets\UserCardWidget::widget(['model' => $userProfile, 'containerAdditionalClass' => 'nom']);
            }
        ],
        'name' => [
            'attribute' => 'name',
            'label' => Module::t('amospartnershipprofiles', '#nomecognome'),
            'headerOptions' => [
                'id' => Module::t('amospartnershipprofiles', 'Name'),
            ],
            'contentOptions' => [
                'headers' => Module::t('amospartnershipprofiles', 'Name'),
            ],
            'value' => function ($model) {
		$model = UsersAnimationMm::findOne(['id' => $model['id']]);
                return $model->user->userProfile->nomeCognome;
            },
        ],
        [
            'value' => function ($model) {
                $createUrlParams = [
                    '/messages/' . $model['user_id'],
                ];
                //return $model->number_msg > 0 ? Html::a($model->number_msg, $createUrlParams, ['target' => '_blank']) : $model->number_msg;
                return $model['number_msg'] > 0 ? Html::a($model['number_msg'], $createUrlParams, ['target' => '_blank']) : $model['number_msg'];
            },
            'label' => Module::t('amospartnershipprofiles', 'Messages'),
            'format' => 'raw',
            'attribute' => 'number_msg',
        ],
        [
            'attribute' => 'solution_sent',
            'value' => function ($model, $key, $index, $column) {


                $solution = $model['solution_sent'];
                $field = ($solution) ?
                        Html::a('Si', '/partnershipprofiles/expressions-of-interest/view?id=' . $solution, ['target' => '_blank']) : 'No';
                return $field;
            },
            'label' => Module::t('amospartnershipprofiles', 'Solution sent?'),
            'format' => 'raw',
        ],
        'select_keyword' => [
            'attribute' => 'select_keyword',
            'label' => Module::t('amospartnershipprofiles', 'Keyword'),
        ],
        [
            'attribute' => 'num_tag',
            'label' => Module::t('amospartnershipprofiles', 'TAG Correspondence'),
            'value' => function ($model) {
                $list_pp_TagId = PartnershipProfilesUtility::getTagsPartnershipProfiles($model['partnership_profile_id']);
                return (($model['num_tag'] . '/' . (empty($list_pp_TagId) ? '' : count($list_pp_TagId) )));
            },
            'visible' => $interested,
        ],
        [
            'attribute' => 'created_at',
            'format' => 'datetime',
            'label' => Module::t('amospartnershipprofiles', 'created_at'),
        ],
//        [
//            'class' => \arter\amos\core\views\grid\ActionColumn::className()
//        ]
        [
            'class' => 'arter\amos\core\views\grid\ActionColumn',
            'deleteOptions' => [
                'class' => 'btn btn-danger-inverse delete-useranimation-btn',
                'url' => ['/partnershipprofiles/partnership-profiles/delete-user-animation'],
                'defaultUrlIdParam' => true,
            ],
            'template' => $actionColumn,
            'buttons' => [
                'chat' => function ($url, $model) {
                    \backend\modules\aster_partnership_profiles\widget\SendNotifyWidget::registerWidgetJavascript();
                    /** @var UsersAnimationMm $model */

                    $model = UsersAnimationMm::findOne(['id' => $model['id']]);
                    return \backend\modules\aster_partnership_profiles\widget\SendNotifyWidget::widget([
                                'model' => $model,
                                'autoRegisterJavascript' => false
                    ]);
                }
            ]
        ],
    ],
]);
?>
</div>


