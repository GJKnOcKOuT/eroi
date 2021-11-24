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
 * @package    arter\amos\organizzazioni\views\profilo
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserProfile;
use arter\amos\admin\widgets\UserCardWidget;
use arter\amos\core\forms\editors\m2mWidget\M2MWidget;
use arter\amos\core\user\User;
use arter\amos\organizzazioni\controllers\ProfiloController;
use arter\amos\organizzazioni\Module;

/**
 * @var yii\web\View $this
 * @var \arter\amos\organizzazioni\models\Profilo $model
 */

$this->title = Module::t('amosorganizzazioni', 'Invite employees');
$this->params['breadcrumbs'][] = $this->title;

/** @var ProfiloController $appController */
$appController = Yii::$app->controller;

/** @var UserProfile $emptyUserProfile */
$emptyUserProfile = AmosAdmin::instance()->createModel('UserProfile');

?>

<?= M2MWidget::widget([
    'model' => $model,
    'modelId' => $model->id,
    'modelData' => $model->getProfiloUsers(),
    'modelDataArrFromTo' => [
        'from' => 'id',
        'to' => 'id'
    ],
    'modelTargetSearch' => [
        'class' => User::className(),
        'query' => $appController->getAssociaM2mQuery($model),
    ],
    'gridId' => 'organizations-employees-grid',
    'viewSearch' => (isset($viewM2MWidgetGenericSearch) ? $viewM2MWidgetGenericSearch : false),
//    'isModal' => true, // TODO da ripristinare. Da fare fix per reload sezione impiegati in form che non ricarica i pulsanti quando post associazione dipendente.
    'relationAttributesArray' => ['status', 'role'],
    'targetUrlController' => 'profilo',
    'moduleClassName' => Module::className(),
    'postName' => 'Profilo',
    'postKey' => 'user',
    'targetColumnsToView' => [
        'userImage' => [
            'label' => $emptyUserProfile->getAttributeLabel('userProfileImage'),
            'headerOptions' => [
                'id' => Module::t('amosorganizzazioni', 'User image'),
            ],
            'contentOptions' => [
                'headers' => Module::t('amosorganizzazioni', 'User image'),
            ],
            'format' => 'raw',
            'value' => function ($model) {
                /** @var \arter\amos\core\user\User $model */
                return UserCardWidget::widget(['model' => $model->userProfile, 'containerAdditionalClass' => 'nom']);
            }
        ],
        'name' => [
            'attribute' => 'profile.surnameName',
            'label' => Module::t('amosorganizzazioni', 'Name'),
            'headerOptions' => [
                'id' => Module::t('amosorganizzazioni', 'Name'),
            ],
            'contentOptions' => [
                'headers' => Module::t('amosorganizzazioni', 'Name'),
            ]
        ],
    ],
]);
