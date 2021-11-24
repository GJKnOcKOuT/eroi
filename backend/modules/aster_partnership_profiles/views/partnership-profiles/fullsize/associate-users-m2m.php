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

use backend\modules\aster_partnership_profiles\utility\PartnershipProfilesUtility;
use arter\amos\core\forms\editors\m2mWidget\M2MWidget;
use arter\amos\core\user\User;
use arter\amos\partnershipprofiles\Module;

/**
 * @var \arter\amos\core\user\User $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('partnershipprofiles', 'Organizzazioni'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('partnershipprofiles', 'Invite Users');

$post = Yii::$app->request->post();
$withoutTags = true;

$genericSearch = \Yii::$app->request->post('genericSearch') ?: \Yii::$app->request->get('genericSearch');

if (empty($genericSearch)) {
    $query = PartnershipProfilesUtility::getQueryToAssociateUsersTags($model, $withoutTags, $genericSearch);
    $query->andWhere('0=1');
} else {
    $query = PartnershipProfilesUtility::getQueryToAssociateUsersTags($model, $withoutTags, $genericSearch);
}

?>

<?= M2MWidget::widget([
    'model' => $model,
    'modelId' => $model->id,
    'modelData' => $model->getUsers(),
    'modelDataArrFromTo' => [
        'from' => 'id',
        'to' => 'id'
    ],
    'modelTargetSearch' => [
        'class' => User::className(),
        'query' => $query,
    ],
    'gridId' => 'partnershipprofiles-user-grid',
    'viewSearch' => true,
	'm2mwidgetButtonPagination' => true,
    'relationAttributesArray' => ['status', 'role'],
    'targetUrlController' => 'partnership-profiles',
    'moduleClassName' => Module::className(),
    'postName' => 'PartnershipProfiles',
    'postKey' => 'user',
    'targetColumnsToView' => [
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
                $userProfile = $model->userProfile;
                return empty($userProfile) ? '' : \arter\amos\admin\widgets\UserCardWidget::widget([
                    'model' => $userProfile,
                    'containerAdditionalClass' => 'nom'
                ]);
            }
        ],
        'name' => [
            'attribute' => 'profile.surnameName',
            'label' => Module::t('amospartnershipprofiles', 'Name'),
            'headerOptions' => [
                'id' => Module::t('amospartnershipprofiles', 'Name'),
            ],
            'contentOptions' => [
                'headers' => Module::t('amospartnershipprofiles', 'Name'),
            ]
        ],
    ],
]);
?>
