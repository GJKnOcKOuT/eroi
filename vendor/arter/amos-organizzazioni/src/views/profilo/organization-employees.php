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
use arter\amos\core\user\User;
use arter\amos\core\views\AmosGridView;
use arter\amos\organizzazioni\controllers\ProfiloController;
use arter\amos\organizzazioni\Module;
use arter\amos\organizzazioni\widgets\OrganizationsMembersWidget;
use kartik\alert\Alert;
use yii\data\ActiveDataProvider;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\organizzazioni\models\Profilo $model
 * @var bool $isUpdate
 */

/** @var ProfiloController $appController */
$appController = Yii::$app->controller;

/** @var UserProfile $emptyUserProfile */
$emptyUserProfile = AmosAdmin::instance()->createModel('UserProfile');
$emptyUser = new User();
$statusLabel = Module::t('amosorganizzazioni', '#profilo_user_mm_status_label');
$isUpdate = (isset($isUpdate) ? $isUpdate : false);

?>

<?php if ($model->isNewRecord): ?>
    <?= Alert::widget([
        'type' => Alert::TYPE_WARNING,
        'body' => Module::t('amosorganizzazioni', '#alert_invite_employees'),
        'closeButton' => false
    ]); ?>
<?php else: ?>
    <?php if (!$isUpdate): ?>
        <div class="col-xs-12">
            <?= AmosGridView::widget([
                'dataProvider' => new ActiveDataProvider([
                    'query' => $appController->getOrganizationEmployeesQuery($model, false)
                ]),
                'columns' => [
                    [
                        'label' => $emptyUserProfile->getAttributeLabel('userProfileImage'),
                        'format' => 'raw',
                        'value' => function ($model) {
                            /** @var \arter\amos\organizzazioni\models\ProfiloUserMm $model */
                            return UserCardWidget::widget(['model' => $model->user->userProfile]);
                        }
                    ],
                    'user.userProfile.surnameName',
                    [
                        'attribute' => 'user.email',
                        'label' => $emptyUser->getAttributeLabel('email')
                    ],
                    'status' => [
                        'attribute' => 'status',
                        'label' => $statusLabel,
                        'headerOptions' => [
                            'id' => $statusLabel,
                        ],
                        'contentOptions' => [
                            'headers' => $statusLabel,
                        ],
                        'value' => function ($model) {
                            /** @var \arter\amos\organizzazioni\models\ProfiloUserMm $model */
                            return Module::t('amosorganizzazioni', $model->status);
                        }
                    ],
                ]
            ]); ?>
        </div>
    <?php else: ?>
        <?php
        $widgetConf = [
            'model' => $model,
//            'enableModal' => (isset($enableModal) ? $enableModal : true), // TODO da ripristinare. Da fare fix per reload sezione impiegati in form che non ricarica i pulsanti quando post associazione dipendente.
            'targetUrlParams' => (isset($targetUrlParams) ? $targetUrlParams : ['viewM2MWidgetGenericSearch' => true])
        ];
        if (isset($showRoles)) {
            $widgetConf['showRoles'] = $showRoles;
        }
        if (isset($showAdditionalAssociateButton)) {
            $widgetConf['showAdditionalAssociateButton'] = $showAdditionalAssociateButton;
        }
        if (isset($additionalColumns)) {
            $widgetConf['additionalColumns'] = $additionalColumns;
        }
        if (isset($viewEmail)) {
            $widgetConf['viewEmail'] = $viewEmail;
        }
        if (isset($checkManagerRole)) {
            $widgetConf['checkManagerRole'] = $checkManagerRole;
        }
        if (isset($addPermission)) {
            $widgetConf['addPermission'] = $addPermission;
        }
        if (isset($manageAttributesPermission)) {
            $widgetConf['manageAttributesPermission'] = $manageAttributesPermission;
        }
        if (isset($forceActionColumns)) {
            $widgetConf['forceActionColumns'] = $forceActionColumns;
        }
        if (isset($actionColumnsTemplate)) {
            $widgetConf['actionColumnsTemplate'] = $actionColumnsTemplate;
        }
        if (isset($viewM2MWidgetGenericSearch)) {
            $widgetConf['viewM2MWidgetGenericSearch'] = $viewM2MWidgetGenericSearch;
        }
        if (isset($gridId)) {
            $widgetConf['gridId'] = $gridId;
        }
        if (isset($organizationManagerRoleName)) {
            $widgetConf['organizationManagerRoleName'] = $organizationManagerRoleName;
        }
        ?>
        <?= OrganizationsMembersWidget::widget($widgetConf); ?>
    <?php endif; ?>
<?php endif; ?>
