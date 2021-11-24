<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles\widget
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_partnership_profiles\widgets;

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserProfile;
use arter\amos\admin\widgets\UserCardWidget;
use arter\amos\core\forms\editors\m2mWidget\M2MWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\user\User;
use arter\amos\core\utilities\JsUtility;
use arter\amos\organizzazioni\models\Profilo;
use arter\amos\organizzazioni\models\ProfiloUserMm;
use arter\amos\organizzazioni\Module;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\PjaxAsset;

/**
 * Class AnimationMembersWidget
 * @package backend\modules\aster_partnership_profiles\widgets
 */
class AnimationMembersWidget extends Widget
{
    /**
     * @var Profilo $model
     */
    public $model = null;

    /**
     * (eg. ['PARTICIPANT'] - thw widget will show only member with role participant)
     * @var array Array of roles to show
     */
    public $showRoles = null;

    /**
     * @var bool $showAdditionalAssociateButton Set to true if another 'invite user' button is required
     */
    public $showAdditionalAssociateButton = false;

    /**
     * @var array $additionalColumns Additional Columns
     */
    public $additionalColumns = [];

    /**
     * @var bool $viewEmail
     */
    public $viewEmail = false;

    /**
     * @var bool $viewInvitation
     */
    public $viewInvitation = true;

    /**
     * @var bool $checkManagerRole
     */
    public $checkManagerRole = false;

    /**
     * @var string $addPermission
     */
    public $addPermission = 'PARTNERSHIPPROFILES_UPDATE';

    /**
     * @var string $manageAttributesPermission
     */
    public $manageAttributesPermission = 'PARTNERSHIPPROFILES_UPDATE';

    /**
     * @var bool $forceActionColumns
     */
    public $forceActionColumns = false;

    /**
     * @var string $actionColumnsTemplate
     */
    public $actionColumnsTemplate = '';

    /**
     * @var bool $viewM2MWidgetGenericSearch
     */
    public $viewM2MWidgetGenericSearch = false;

    /**
     * @var array $targetUrlParams
     */
    public $targetUrlParams = null;

    /**
     * @var string $gridId
     */
    public $gridId = 'animations-users-tags-grid';

    /**
     * @var bool $enableModal
     */
    public $enableModal = false;

    /**
     * @var string $delete_member_message
     */
    public $delete_member_message = false;

    /**
     * @var string
     */
    public $communityManagerRoleName = '';

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        if (!$this->model) {
            throw new InvalidConfigException($this->throwErrorMessage('model'));
        }

//        if ($this->model instanceof Profilo) {
//            $this->enableModal = true;
//        }

//        $this->delete_member_message = ($this->delete_member_message) ? $this->delete_member_message : Module::t('amosorganizzazioni', 'Are you sure to remove this user?');
    }

    /**
     * @param string $field
     * @return string
     */
    protected function throwErrorMessage($field)
    {
        return Module::t('amosorganizzazioni', 'Wrong widget configuration: missing field {field}', ['field' => $field]);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
//        $customInvitationForm = $this->organizationsModule->customInvitationForm;
//        $inviteUserOfcommunityParent = $this->organizationsModule->inviteUserOfcommunityParent;

        $gridId = $this->gridId . (!empty($this->showRoles) ? '-' . implode('-', $this->showRoles) : '');
        $model = $this->model;
        $params = [];
        $params['showRoles'] = $this->showRoles;
        $params['showAdditionalAssociateButton'] = $this->showAdditionalAssociateButton;
        $params['additionalColumns'] = $this->additionalColumns;
        $params['viewEmail'] = $this->viewEmail;
        $params['viewInvitation'] = $this->viewInvitation;
        $params['checkManagerRole'] = $this->checkManagerRole;
        $params['addPermission'] = $this->addPermission;
        $params['manageAttributesPermission'] = $this->manageAttributesPermission;
        $params['forceActionColumns'] = $this->forceActionColumns;
        $params['actionColumnsTemplate'] = $this->actionColumnsTemplate;
        $params['viewM2MWidgetGenericSearch'] = $this->viewM2MWidgetGenericSearch;
        $params['targetUrlParams'] = $this->targetUrlParams;
        $params['enableModal'] = $this->enableModal;
        $params['gridId'] = $this->gridId;
        $params['communityManagerRoleName'] = $this->communityManagerRoleName;

        $url = \Yii::$app->urlManager->createUrl([
            '/organizzazioni/profilo/organization-employees',
            'id' => $model->id,
            'classname' => $model->className(),
            'params' => $params
        ]);
        $searchPostName = 'searchEmployeeName' . (!empty($this->showRoles) ? implode('', $this->showRoles) : '');

        $js = JsUtility::getSearchM2mFirstGridJs($gridId, $url, $searchPostName);
        PjaxAsset::register($this->getView());
        $this->getView()->registerJs($js, View::POS_LOAD);

//        /** @var Profilo $profiloModel */
//        $profiloModel = $this->organizationsModule->createModel('Profilo');

        /** @var UserProfile $emptyUserProfile */
        $emptyUserProfile = AmosAdmin::instance()->createModel('UserProfile');
//        $roleLabel = Module::t('amosorganizzazioni', '#profilo_user_mm_role_label');
        $statusLabel = Module::t('amosorganizzazioni', '#profilo_user_mm_status_label');

        $itemsMittente = [
            'userImage' => [
                'label' => $emptyUserProfile->getAttributeLabel('userProfileImage'),
                'headerOptions' => [
                    'id' => Module::t('amosorganizzazioni', 'user_image'),
                ],
                'contentOptions' => [
                    'id' => Module::t('amosorganizzazioni', 'user_image'),
                ],
                'format' => 'raw',
                'value' => function ($model) {
                    /** @var \arter\amos\organizzazioni\models\ProfiloUserMm $model */
                    return UserCardWidget::widget(['model' => $model->user->userProfile]);
                }
            ],
            'name' => [
                'attribute' => 'user.userProfile.surnameName',
                'label' => $emptyUserProfile->getAttributeLabel('surnameName'),
                'headerOptions' => [
                    'id' => Module::t('amosorganizzazioni', 'surname_name'),
                ],
                'contentOptions' => [
                    'headers' => Module::t('amosorganizzazioni', 'surname_name'),
                ],
                'format' => 'html',
                'value' => function ($model) {
                    /** @var \arter\amos\organizzazioni\models\ProfiloUserMm $model */
                    $surnameName = $model->user->userProfile->surnameName;
                    return Html::a($surnameName, $model->user->userProfile->getFullViewUrl(), [
                        'title' => Module::t('amosorganizzazioni', 'Apri il profilo di {nome_profilo}', ['nome_profilo' => $surnameName])
                    ]);
                }
            ],
            'user.email',
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
//            'role' => [
//                'attribute' => 'role',
//                'label' => $roleLabel,
//                'headerOptions' => [
//                    'id' => $roleLabel,
//                ],
//                'contentOptions' => [
//                    'headers' => $roleLabel,
//                ],
//                'value' => function ($model) {
//                    /** @var \arter\amos\organizzazioni\models\ProfiloUserMm $model */
//                    return Module::t('amosorganizzazioni', $model->role);
//                }
//            ],
        ];

        $exportColumns = [
            'user.userProfile.nome',
            'user.userProfile.cognome',
            'user.email' => [
                'attribute' => 'user.email',
                'label' => Module::t('amosorganizzazioni', 'Email')
            ],
            'user.userProfile.codice_fiscale',
//            'partnerOf.userProfile.nomeCognome' => [
//                'attribute' => 'partnerOf.userProfile.nomeCognome',
//                'label' => Module::t('amosorganizzazioni', 'Invited by')
//            ],
            'status' => [
                'attribute' => 'status',
                'label' => Module::t('amosorganizzazioni', 'Confirm status'),
                'value' => function ($model) {
                    /** @var \arter\amos\organizzazioni\models\ProfiloUserMm $model */
                    return Module::t('amosorganizzazioni', $model->status);
                }
            ],
//            'invitation_accepted_at' => [
//                'attribute' => 'invitation_accepted_at',
//                'label' => Module::t('amosorganizzazioni', 'Confirm date'),
//                'value' => function ($model) {
//                    /** @var \arter\amos\organizzazioni\models\ProfiloUserMm $model */
//                    return \Yii::$app->formatter->asDatetime($model->invitation_accepted_at, 'humanalwaysdatetime');
//                }
//            ]
        ];

        $view_email_partecipants = false;
        if (isset($this->organizationsModule->view_email_partecipants)) {
            $view_email_partecipants = $this->organizationsModule->view_email_partecipants;
        }

        if ($view_email_partecipants || ($this->viewEmail)) {
            $itemsMittente['email'] = [
                'label' => Module::t('amosorganizzazioni', 'Email'),
                'headerOptions' => [
                    'id' => Module::t('amosorganizzazioni', 'email'),
                ],
                'contentOptions' => [
                    'headers' => Module::t('amosorganizzazioni', 'email'),
                ],
                'value' => function ($model) {
                    /** @var \arter\amos\organizzazioni\models\ProfiloUserMm $model */
                    return $model->user->email;
                }
            ];
        }

//        if ($this->viewInvitation) {
//            $itemsMittente['invited_at'] = [
//                'attribute' => 'invited_at',
//                'label' => Module::t('amosorganizzazioni', '#invited_at'),
//                'headerOptions' => [
//                    'id' => Module::t('amosorganizzazioni', '#invited_at'),
//                ],
//                'contentOptions' => [
//                    'headers' => Module::t('amosorganizzazioni', '#invited_at'),
//                ],
//                'value' => function ($model) {
//                    /** @var \arter\amos\organizzazioni\models\ProfiloUserMm $model */
//                    return \Yii::$app->formatter->asDatetime($model->invited_at);
//                }
//            ];
//            $itemsMittente['invitation_accepted_at'] = [
//                'attribute' => 'invitation_accepted_at',
//                'label' => Module::t('amosorganizzazioni', '#invitation_accepted_at'),
//                'headerOptions' => [
//                    'id' => Module::t('amosorganizzazioni', '#invitation_accepted_at'),
//                ],
//                'contentOptions' => [
//                    'headers' => Module::t('amosorganizzazioni', '#invitation_accepted_at'),
//                ],
//                'value' => function ($model) {
//                    /** @var \arter\amos\organizzazioni\models\ProfiloUserMm $model */
//                    return \Yii::$app->formatter->asDatetime($model->invitation_accepted_at);
//                }
//            ];
//            $itemsMittente['partner_of'] = [
//                'attribute' => 'invitation_partner_of',
//                'label' => Module::t('amosorganizzazioni', '#invitation_partner_of'),
//                'headerOptions' => [
//                    'id' => Module::t('amosorganizzazioni', '#invitation_partner_of'),
//                ],
//                'contentOptions' => [
//                    'headers' => Module::t('amosorganizzazioni', '#invitation_partner_of'),
//                ],
//                'value' => function ($model) {
//                    /** @var \arter\amos\organizzazioni\models\ProfiloUserMm $model */
//                    return (!is_null($model->partnerOf) ? $model->partnerOf->userProfile->surnameName : '-');
//                }
//            ];
//        }
        $isSubOrganization = !empty($model->parent_id);

        //Merge additional solumns
        $itemsMittente = ArrayHelper::merge($itemsMittente, $this->additionalColumns);

        $actionColumnsTemplate = '';
        if ($this->checkManager()) {
            $actionColumnsTemplate = '{acceptUser}{rejectUser}{deleteRelation}';
        }
        if ($this->forceActionColumns) {
            $actionColumnsTemplate = $this->actionColumnsTemplate;
        }

        /** @var ProfiloUserMm $profiloUserMmModel */
        $profiloUserMmModel = $this->organizationsModule->createModel('ProfiloUserMm');
        $profiloUserMmTable = $profiloUserMmModel::tableName();
        $userTable = User::tableName();
        $userProfileTable = UserProfile::tableName();

        $query = !empty($this->showRoles)
            ? $model->getProfiloUserMms()->andWhere([$profiloUserMmTable . '.role' => $this->showRoles])
            : $model->getProfiloUserMms();
        $query->innerJoin($userTable, $profiloUserMmTable . '.user_id = ' . $userTable . '.id AND ' . $userTable . '.deleted_at IS NULL')
            ->innerJoin($userProfileTable, $userProfileTable . '.user_id = ' . $userTable . '.id AND ' . $userProfileTable . '.deleted_at IS NULL')
            ->andWhere([$userProfileTable . '.attivo' => UserProfile::STATUS_ACTIVE])
            ->andWhere([$userTable . '.status' => User::STATUS_ACTIVE]);

        if (isset($_POST[$searchPostName])) {
            $searchName = $_POST[$searchPostName];
            if (!empty($searchName)) {
                $query->andWhere(['or',
                    ['like', $userProfileTable . '.nome', $searchName],
                    ['like', $userProfileTable . '.cognome', $searchName],
                    ['like', "CONCAT( " . $userProfileTable . ".nome , ' ', " . $userProfileTable . ".cognome )", $searchName],
                    ['like', "CONCAT( " . $userProfileTable . ".cognome , ' ', " . $userProfileTable . ".nome )", $searchName]
                ]);
            }
        }

        /** @var \arter\amos\invitations\Module $invitationsModule */
        $invitationsModule = Yii::$app->getModule('invitations');
        $invitationsModulePresent = !is_null($invitationsModule);
        if ($invitationsModulePresent) {
            Yii::$app->session->set($invitationsModule::beginCreateNewSessionKey(), Url::current());
        }

//        $insass = ($inviteUserOfcommunityParent && !$isSubCommunity && $customInvitationForm) || (!$inviteUserOfcommunityParent && $customInvitationForm);
        $widget = M2MWidget::widget([
            'model' => $model,
            'modelId' => $model->id,
            'modelData' => $query,
            'overrideModelDataArr' => true,
            'exportMittenteConfig' => [
                'exportEnabled' => true,
                'exportColumns' => $exportColumns
            ],
            'forceListRender' => true,
            'targetUrlParams' => $this->targetUrlParams,
            'gridId' => $gridId,
            'firstGridSearch' => true,
            'isModal' => $this->enableModal,
            'createAdditionalAssociateButtonsEnabled' => false,
            'disableCreateButton' => (is_null(Yii::$app->getModule('invitations')) || !Yii::$app->user->can('INVITATION_CREATE')),
            'checkPermWithNewMethod' => false,
            'btnAssociaLabel' => Module::t('amosorganizzazioni', 'Associate employees'),
            'btnAssociaClass' => 'btn btn-primary',
            'createNewBtnLabel' => Module::t('amosorganizzazioni', 'Invite employees'),
            'btnAdditionalAssociateLabel' => Module::t('amosorganizzazioni', 'Invite employees'),
            'actionColumnsTemplate' => $actionColumnsTemplate,
            'deleteRelationTargetIdField' => 'user_id',
//            'targetUrl' => $insass ? '/community/community/insass-m2m' : '/community/community/associa-m2m',
            'targetUrl' => '/organizzazioni/profilo/associa-m2m',
            'additionalTargetUrl' => '/organizzazioni/profilo/additional-associate-m2m',
            'createNewTargetUrl' => ['/invitations/invitation/create', 'moduleName' => Module::getModuleName(), 'contextModelId' => $model->id],
            'moduleClassName' => Module::className(),
            'targetUrlController' => 'profilo',
            'postName' => 'Profilo',
            'postKey' => 'user',
            'permissions' => [
                'add' => $this->addPermission,
                'manageAttributes' => $this->manageAttributesPermission
            ],
            'actionColumnsButtons' => [
                'acceptUser' => function ($url, $model) {
                    /** @var \arter\amos\organizzazioni\models\ProfiloUserMm $model */
                    $status = $model->status;
                    $createUrlParams = ['/organizzazioni/profilo/accept-user', 'profiloId' => $model->profilo_id, 'userId' => $model->user_id];
                    $btn = '';
                    if ($status == ProfiloUserMm::STATUS_WAITING_OK_ORGANIZATION_REFEREE) {
                        $btn = Html::a(
                            Module::t('amosorganizzazioni', 'Accept user'),
                            Yii::$app->urlManager->createUrl($createUrlParams), ['class' => 'btn btn-primary', 'style' => 'font-size: 0.8em']);
                    }
                    return $btn;
                },
                'rejectUser' => function ($url, $model) {
                    /** @var \arter\amos\organizzazioni\models\ProfiloUserMm $model */
                    $btn = '';
                    $createUrlParams = ['/organizzazioni/profilo/reject-user', 'profiloId' => $model->profilo_id, 'userId' => $model->user_id];
                    if ($model->status == ProfiloUserMm::STATUS_WAITING_OK_ORGANIZATION_REFEREE) {
                        $btn = Html::a(
                            Module::t('amosorganizzazioni', 'Reject user'),
                            Yii::$app->urlManager->createUrl($createUrlParams), ['class' => 'btn btn-primary', 'style' => 'font-size: 0.8em']);
                    }
                    return $btn;
                },
                'deleteRelation' => function ($url, $model) {
                    /** @var \arter\amos\organizzazioni\models\ProfiloUserMm $model */
                    $url = '/organizzazioni/profilo/elimina-m2m';
                    $profilo = $model->profilo;
                    $targetId = $model->user_id;
                    $urlDelete = Yii::$app->urlManager->createUrl([
                        $url,
                        'id' => $profilo->id,
                        'targetId' => $targetId
                    ]);
                    $loggedUser = Yii::$app->getUser();
                    if ($loggedUser->can('ADD_EMPLOYEE_TO_ORGANIZATION_PERMISSION', ['model' => $this->model])) {
                        $btnDelete = Html::a(
                            AmosIcons::show('close', ['class' => '']),
                            $urlDelete,
                            ['title' => Module::t('amosorganizzazioni', 'Delete'),
                                'data-confirm' => $this->delete_member_message,
                                'class' => 'btn btn-danger-inverse'
                            ]
                        );
                        if (($profilo->created_by == $model->user_id) && !$loggedUser->can("ADMIN")) {
                            $btnDelete = '';
                        }
                    } else {
                        $btnDelete = '';
                    }
                    return $btnDelete;
                },
            ],
            'itemsMittente' => $itemsMittente,
        ]);

        return "<div id='" . $gridId . "' data-pjax-container='" . $gridId . "-pjax' data-pjax-timeout=\"1000\"  class=\"table-responsive\">" . $widget . "</div>";
    }

    /**
     * @return bool
     */
    private function checkManager()
    {
        return true; // TODO FUTURE USE. For now return true. See community widget.
    }
}
