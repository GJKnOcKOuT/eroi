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
 * @package    arter\amos\admin\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\widgets;

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserContact;
use arter\amos\admin\models\UserProfile;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\user\User;
use arter\amos\core\utilities\JsUtility;
use Yii;
use yii\base\Widget;
use yii\web\View;
use yii\widgets\PjaxAsset;

/**
 * Class UserContacsWidget
 * @package arter\amos\admin\widgets
 */
class UserContacsWidget extends Widget
{

    /**
     * @var int $userId
     */
    public $userId = null;

    /**
     * @var bool|false true if we are in edit mode, false if in view mode or otherwise
     */
    public $isUpdate = false;

    /**
     * @var string $gridId
     */
    public $gridId = 'user-contanct-grid';

    /**
     * @var
     */
    private $userProfile;

    /**
     * widget initialization
     */
    public function init()
    {
        parent::init();


        if (is_null($this->userId)) {
            throw new \Exception(AmosAdmin::t('amosadmin', 'Missing user id'));
        }

        $this->userProfile = UserProfile::find()->andWhere(['user_id' => $this->userId])->one();
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $confirm = $this->getConfirm();
        $canAssociateContact = \Yii::$app->user->can('ASSOCIATE_CONTACTS');

        $gridId = $this->gridId;
        $url = \Yii::$app->urlManager->createUrl([
            '/admin/user-profile/contacts',
            'id' => $this->userProfile->id,
            'isUpdate' => $this->isUpdate
            ]);
        $searchPostName = 'searchContactsName';

        $js = JsUtility::getSearchM2mFirstGridJs($gridId, $url, $searchPostName);
        PjaxAsset::register($this->getView());
        $this->getView()->registerJs($js, View::POS_LOAD);

        $itemsMittente = [
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

                    /** @var UserContact $model */
                    if($this->userId == $model->user_id) {
                        $profile = User::findOne($model->contact_id)->getProfile();
                    }else{
                        $profile = User::findOne($model->user_id)->getProfile();
                    }
                    return UserCardWidget::widget(['model' => $profile]);
                }
            ],
            'name' => [
                'headerOptions' => [
                    'id' => AmosAdmin::t('amosadmin', 'Name'),
                ],
                'contentOptions' => [
                    'headers' => AmosAdmin::t('amosadmin', 'Name'),
                ],
                'label' => AmosAdmin::t('amosadmin', 'Name'),
                'format' => 'raw',
                'value' => function ($model) use ($confirm) {
                    /** @var UserContact $model */
                    if($this->userId == $model->user_id) {
                        $userProfile = User::findOne($model->contact_id)->getProfile();
                        $name = $userProfile->getNomeCognome();
                    }else{
                        $userProfile = User::findOne($model->user_id)->getProfile();
                        $name = $userProfile->getNomeCognome();
                    }
                    return Html::a($name, ['/admin/user-profile/view', 'id' => $userProfile->id ], [
                        'title' => AmosAdmin::t('amoscommunity', 'Apri il profilo di {nome_profilo}', ['nome_profilo' => $name]),
                        'data' => $confirm
                    ]);
                }
            ],
            'status' => [
                'attribute' => 'status',
                'label' => AmosAdmin::t('amosadmin', 'Status'),
                'headerOptions' => [
                    'id' => AmosAdmin::t('amosadmin', 'Status'),
                ],
                'contentOptions' => [
                    'headers' => AmosAdmin::t('amosadmin', 'Status'),
                ],
                'value' => function($model){
                    /** @var UserContact $model */
                    if($model->status == UserContact::STATUS_INVITED) {
                        return AmosAdmin::t('amosadmin', 'Waiting for acceptance');
                    } else {
                        return AmosAdmin::t('amosadmin', 'Connected');
                    }
                }
            ],
            'created_at' => [
                'attribute' => 'created_at',
                'format' => 'dateTime',
            ],
            'accepted_at' => [
                'attribute' => 'accepted_at',
                'format' => 'dateTime',
            ],
        ];

//        UserContact::find()-> andWhere("user_id = ".$this->userId. " OR contact_id = ".$this->userId)->andWhere(['<>', 'status', UserContact::STATUS_REFUSED]);

        $contactsInvited = UserContact::find()
            ->innerJoin('user_profile', 'user_profile.user_id = user_contact.contact_id')
            ->andWhere('user_contact.deleted_at IS NULL AND user_profile.deleted_at IS NULL')
            ->andWhere("user_contact.user_id = ".$this->userId)->andWhere(['<>', 'user_contact.status', UserContact::STATUS_REFUSED])
            ->andWhere(['user_profile.attivo' => 1]);

        $contactsInviting= UserContact::find()->innerJoin('user_profile', 'user_profile.user_id = user_contact.user_id')
            ->andWhere('user_contact.deleted_at IS NULL AND user_profile.deleted_at IS NULL')
            ->andWhere("user_contact.contact_id = ".$this->userId)->andWhere(['<>', 'user_contact.status', UserContact::STATUS_REFUSED])
            ->andWhere(['user_profile.attivo' => 1]);

        if(isset($_POST[$searchPostName])){
            $searchName = $_POST[$searchPostName];
            if(!empty($searchName)){
                $contactsInvited->andWhere(['or',
                    ['like', 'user_profile.nome',$searchName],
                    ['like', 'user_profile.cognome', $searchName],
                    ['like', "CONCAT( user_profile.nome , ' ', user_profile.cognome )", $searchName],
                    ['like', "CONCAT( user_profile.cognome , ' ', user_profile.nome )", $searchName]
                ]);
                $contactsInviting->andWhere(['or',
                    ['like', 'user_profile.nome',$searchName],
                    ['like', 'user_profile.cognome', $searchName],
                    ['like', "CONCAT( user_profile.nome , ' ', user_profile.cognome )", $searchName],
                    ['like', "CONCAT( user_profile.cognome , ' ', user_profile.nome )", $searchName]
                ]);
            }
        }
        $contacts = UserContact::find()
            ->select('*')
            ->from([UserContact::tableName() => $contactsInvited->union($contactsInviting)]);

        $model = User::findOne($this->userId)->getProfile();
        $loggedUserId = Yii::$app->getUser()->id;
        $this->isUpdate = $this->isUpdate && ($loggedUserId == $model->user_id) && $canAssociateContact;

        $widget = \arter\amos\core\forms\editors\m2mWidget\M2MWidget::widget([
            'model' => $model,
            'modelId' => $model->id,
            'modelData' => $contacts,
            'overrideModelDataArr' => true,
            'forceListRender' => true,
            'targetUrlParams' => [
                'viewM2MWidgetGenericSearch' => true
            ],
            'gridId' => $gridId,
            'firstGridSearch' => true,
            'itemsSenderPageSize' => 10,
            'pageParam' => 'page-contacts',
            'disableCreateButton' => true,
            'createAssociaButtonsEnabled' => $this->isUpdate,
            'btnAssociaId' => 'user-contacts-widget-associa-btn-id',
            'btnAssociaLabel' => AmosAdmin::t('amosadmin', 'Add new contacts'),
            'actionColumnsTemplate' => $this->isUpdate ? '{googleContact}{connect}{deleteRelation}' : '{googleContact}',
            'targetUrl' => '/admin/user-contact/associate-contacts',
            'createNewTargetUrl' => '/admin/user-profile/create',
            'moduleClassName' => AmosAdmin::className(),
            'targetUrlController' => 'user-contact',
            'postName' => 'UserContact',
            'postKey' => 'userContact',
            'permissions' => [
                'add' => 'USERPROFILE_UPDATE',
                'manageAttributes' => 'USERPROFILE_UPDATE'
            ],
            'actionColumnsButtons' => [
                'googleContact' => function($url, $model){
                    /** @var UserContact $model */
                    return GoogleContactWidget::widget(['model' => $model->getInvitingUserProfile()]).'&nbsp;';
                },
                'connect' => function ($url, $model) {
                    $btn = ConnectToUserWidget::widget(['model' => $model, 'isGridView' => true ]);
                    return $btn;
                },

                'deleteRelation' => function ($url, $model) use($loggedUserId) {
                    /** @var UserContact $model */
                    $url = '/admin/user-contact/delete-contact';
                    $urlDelete = Yii::$app->urlManager->createUrl([
                        $url,
                        'id' => $model->id,
                    ]);
                    if ($loggedUserId == $this->userId /*&& ($model->created_by != $loggedUser->id || $loggedUser->can('ADMIN'))*/) {
                        if($model->user_id == $loggedUserId) {
                            $name = $model->contactUserProfile->getNomeCognome();
                        } else {
                            $name = $model->userProfile->getNomeCognome();
                        }
                        $btnDelete = Html::a( AmosIcons::show('close', ['class' => 'btn-delete-relation']),
//                            '<p class="btn btn-tool-secondary">' . AmosIcons::show('close') . '</p>'
                            $urlDelete,
                            [
                                'title' => AmosAdmin::t('amosadmin', 'Delete'),
                                'data-confirm' => AmosAdmin::t('amosadmin', 'Are you sure to remove'). " " . $name ." "
                                    . AmosAdmin::t('amosadmin', 'from your contact list'),
                            ]
                        );
                    } else {
                        $btnDelete = '';
                    }
                    return $btnDelete;
                }
            ],
            'itemsMittente' => $itemsMittente,
        ]);

        echo '';
        return "<div id=\"user-contanct-grid\" data-pjax-container=\"user-contanct-grid-pjax\" data-pjax-timeout=\"1000\">
                <h3>".AmosAdmin::tHtml('amosadmin', 'Contacts')."</h3>"
                .$widget
                ."</div><div class=\"clearfix\"></div> ";
    }

    /**
     * @return array|null
     */
    public function getConfirm(){
        $controller = Yii::$app->controller;
        $isActionUpdate = ($controller->action->id == 'update');
        $confirm = $isActionUpdate ? [
            'confirm' => \arter\amos\core\module\BaseAmosModule::t('amoscore', '#confirm_exit_without_saving')
        ] : null;
        return $confirm;
    }
}