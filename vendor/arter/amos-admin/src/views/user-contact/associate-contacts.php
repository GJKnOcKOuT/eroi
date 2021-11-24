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
 * @package    arter\amos\admin\views\user-contact
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserProfile;
use arter\amos\core\forms\editors\m2mWidget\M2MWidget;
use arter\amos\core\helpers\Html;

/**
 * @var \arter\amos\admin\models\UserProfile $model
 */

$this->title = AmosAdmin::t('amosadmin', 'Add contacts');
$this->params['breadcrumbs'][] = AmosAdmin::t('amosadmin', 'Add contacts');

$userProfileId = Yii::$app->request->get("id");
$model = UserProfile::findOne($userProfileId);

/**
 * @var \yii\db\ActiveQuery $query UserProfiles to invite or with pending invitation
 */
$query = $model->getUserNetworkAssociationQuery();

$query->orderBy([
        'user_profile.cognome' => SORT_ASC,
        'user_profile.nome' => SORT_ASC,
    ]);

$post = Yii::$app->request->post();
if (isset($post['genericSearch'])) {
    $searchName = $post['genericSearch'];
    $query->andFilterWhere(['or',
        ['like', 'user_profile.nome',$searchName],
        ['like', 'user_profile.cognome', $searchName],
        ['like', "CONCAT( user_profile.nome , ' ', user_profile.cognome )", $searchName],
        ['like', "CONCAT( user_profile.cognome , ' ', user_profile.nome )", $searchName]
    ]);
}

?>
<?= M2MWidget::widget([
    'model' => $model,
    'modelId' => $model->id,
    'modelData' => $query,
    'modelDataArrFromTo' => [
        'from' => 'id',
        'to' => 'id'
    ],
    'modelTargetSearch' => [
        'class' => AmosAdmin::instance()->createModel('UserProfile')->className(),
        'query' => $query,
    ],
    'targetFooterButtons' => Html::a(AmosAdmin::t('amosadmin', 'Close'), Yii::$app->urlManager->createUrl([
        '/admin/user-contact/annulla-m2m',
        'id' => $userProfileId
    ]), ['class' => 'btn btn-secondary', 'AmosAdmin' => Yii::t('amosadmin', 'Close')]),
    'renderTargetCheckbox' => false,
    'viewSearch' => (isset($viewM2MWidgetGenericSearch) ? $viewM2MWidgetGenericSearch : false),
    'targetUrlController' => 'user-contact',
    'targetActionColumnsTemplate' => '{googleContact}{connect}',
    'moduleClassName' => \arter\amos\admin\AmosAdmin::className(),
    'postName' => 'UserContact',
    'postKey' => 'user-contact',
    'targetColumnsToView' => [
        'photo' => [
            'headerOptions' => [
                'id' => AmosAdmin::t('amosadmin', 'Photo'),
            ],
            'contentOptions' => [
                'headers' => AmosAdmin::t('amosadmin', 'Photo'),
            ],
            'label' => AmosAdmin::t('amosadmin', 'Photo'),
            'format' => 'raw',
            'value' => function ($model) {
                /** @var UserProfile $model */
                return \arter\amos\admin\widgets\UserCardWidget::widget(['model' => $model, 'onlyAvatar'=> true]);
            }
        ],
        'name' => [
            'attribute' => 'surnameName',
            'headerOptions' => [
                'id' => AmosAdmin::t('amosadmin', 'Name'),
            ],
            'contentOptions' => [
                'headers' => AmosAdmin::t('amosadmin', 'Name'),
            ],
            'label' => AmosAdmin::t('amosadmin', 'Name'),
            'value' => function($model){
                /** @var UserProfile $model */
                return Html::a($model->surnameName, ['/admin/user-profile/view', 'id' => $model->id ], [
                    'title' => AmosAdmin::t('amosnews', 'Apri il profilo di {nome_profilo}', ['nome_profilo' => $model->surnameName])
                ]);
            },
            'format' => 'html'
        ],
        [
            'class' => 'arter\amos\core\views\grid\ActionColumn',
            'template' => '{googleContact}{connect}',
            'buttons' => [
                'googleContact' => function($url, $model){
                    /** @var UserProfile $model */
                    return \arter\amos\admin\widgets\GoogleContactWidget::widget(['model' => $model]).'&nbsp;';
                },
                'connect' =>  function ($url, $model) {
                    /** @var UserProfile $model */
                    return \arter\amos\admin\widgets\ConnectToUserWidget::widget([ 'model' => $model, 'isGridView' => true ]);
                }
            ]
        ]
    ],
]);
?>
