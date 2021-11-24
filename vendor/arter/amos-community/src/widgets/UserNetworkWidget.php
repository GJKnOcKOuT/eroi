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
 * @package    arter\amos\community\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\community\widgets;

use arter\amos\community\AmosCommunity;
use arter\amos\community\assets\AmosCommunityAsset;
use arter\amos\community\models\Community;
use arter\amos\community\models\CommunityType;
use arter\amos\community\models\CommunityUserMm;
use arter\amos\community\rules\DeleteOwnCommunityRelationRule;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\user\User;
use arter\amos\core\utilities\JsUtility;
use Yii;
use yii\base\Widget;
use yii\web\View;
use yii\widgets\PjaxAsset;

/**
 * Class UserNetworkWidget
 * @package arter\amos\community\widgets
 */
class UserNetworkWidget extends Widget
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
    public $gridId = 'user-community-grid';
    
    /**
     * @var AmosCommunity $communityModule
     */
    private $communityModule = null;
    
    /**
     * widget initialization
     */
    public function init()
    {
        parent::init();
        
        if (is_null($this->userId)) {
            throw new \Exception(AmosCommunity::t('amoscommunity', 'Missing user id'));
        }
        AmosCommunityAsset::register($this->getView());
        $this->communityModule = AmosCommunity::instance();
    }
    
    /**
     * @return mixed
     */
    public function run()
    {
        if (!$this->communityModule->enableUserNetworkWidget) {
            return '';
        }
        
        $confirm = $this->getConfirm();
        
        $gridId = $this->gridId;
        $url = \Yii::$app->urlManager->createUrl([
            '/community/community/user-network',
            'userId' => $this->userId,
            'isUpdate' => $this->isUpdate
        ]);
        $searchPostName = 'searchCommunityName';
        
        $js = JsUtility::getSearchM2mFirstGridJs($gridId, $url, $searchPostName);
        PjaxAsset::register($this->getView());
        $this->getView()->registerJs($js, View::POS_LOAD);
        
        $itemsMittente = [
            'logo_id' => [
                'headerOptions' => [
                    'id' => AmosCommunity::t('amoscommunity', 'Logo'),
                ],
                'contentOptions' => [
                    'headers' => AmosCommunity::t('amoscommunity', 'Logo'),
                ],
                'label' => AmosCommunity::t('amoscommunity', 'Logo'),
                'format' => 'raw',
                'value' => function ($model) {
                    return CommunityCardWidget::widget(['model' => $model]);
                }
            ],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model) use ($confirm) {
                    /** @var Community $model */
                    return Html::a($model->name, ['/community/community/view', 'id' => $model->id], [
                        'title' => AmosCommunity::t('amoscommunity', 'Apri il profilo della community {community_name}', ['community_name' => $model->name]),
                        'data' => $confirm
                    ]);
                }
            ],
            'communityType' => [
                'attribute' => 'communityType',
                'format' => 'html',
                'value' => function ($model) {
                    /** @var Community $model */
                    if (!is_null($model->community_type_id)) {
                        return AmosCommunity::t('amoscommunity', $model->communityType->name);
                    } else {
                        return '-';
                    }
                }
            ],
            'created_by' => [
                'attribute' => 'created_by',
                'format' => 'html',
                'value' => function ($model) {
                    /** @var Community $model */
                    $name = '-';
                    if (!is_null($model->created_by)) {
                        $creator = User::findOne($model->created_by);
                        if (!empty($creator)) {
                            return $creator->getProfile()->getNomeCognome();
                        }
                    }
                    return $name;
                }
            ],
            'status' => [
                'attribute' => 'status',
                'label' => AmosCommunity::t('amoscommunity', 'Status'),
                'headerOptions' => [
                    'id' => AmosCommunity::t('amoscommunity', 'Status'),
                ],
                'contentOptions' => [
                    'headers' => AmosCommunity::t('amoscommunity', 'Status'),
                ],
                'value' => function ($model) {
                    /** @var Community $model */
                    $mmrow = CommunityUserMm::findOne(['user_id' => $this->userId, 'community_id' => $model->id]);
                    return AmosCommunity::t('amoscommunity', $mmrow->status);
                }
            ],
            'role' => [
                'attribute' => 'role',
                'label' => AmosCommunity::t('amoscommunity', 'Role'),
                'headerOptions' => [
                    'id' => AmosCommunity::t('amoscommunity', 'Role'),
                ],
                'contentOptions' => [
                    'headers' => AmosCommunity::t('amoscommunity', 'Role'),
                ],
                'value' => function ($model) {
                    /** @var Community $model */
                    $mmrow = CommunityUserMm::findOne(['user_id' => $this->userId, 'community_id' => $model->id]);
                    return AmosCommunity::t('amoscommunity', $mmrow->role);
                }
            ],
        ];
        
        $communityObject = Yii::createObject(Community::className());
        $communities = $communityObject->getUserNetworkQuery($this->userId);
        
        if (!Yii::$app->user->can('ADMIN')) {
            $communitiesMms = CommunityUserMm::find()->andWhere(['user_id' => Yii::$app->user->id])->select('community_id');
            $communities->andWhere([
                'or',
                [
                    '<>',
                    'community.community_type_id',
                    \arter\amos\community\models\CommunityType::COMMUNITY_TYPE_CLOSED
                ],
                ['in', 'community.id', $communitiesMms]
            ]);
        }
        
        if (isset($_POST[$searchPostName])) {
            $searchName = $_POST[$searchPostName];
            if (!empty($searchName)) {
                $communities->andWhere(['LIKE', 'community.name', $searchName]);
            }
        }
        
        $model = User::findOne($this->userId)->getProfile();
        $loggedUserId = Yii::$app->getUser()->id;
        $this->isUpdate = $this->isUpdate && ($loggedUserId == $model->user_id);
        $module = \Yii::$app->getModule(AmosCommunity::getModuleName());
        $communityType = $module->communityType;
        
        $widget = \arter\amos\core\forms\editors\m2mWidget\M2MWidget::widget([
            'model' => $model,
            'modelId' => $model->id,
            'modelData' => $communities,
            'overrideModelDataArr' => true,
            'forceListRender' => true,
            'targetUrlParams' => [
                'viewM2MWidgetGenericSearch' => true
            ],
            'gridId' => $gridId,
            'firstGridSearch' => true,
            'itemsSenderPageSize' => 10,
            'pageParam' => 'page-community',
            'disableCreateButton' => true,
            'createAssociaButtonsEnabled' => !$module->disableCommunityAssociationUserProfile && $this->isUpdate && (CommunityType::COMMUNITY_TYPE_CLOSED != $communityType),
            'btnAssociaId' => 'community-network-widget-associa-btn-id',
            'btnAssociaLabel' => AmosCommunity::t('amoscommunity', 'Add new community'),
            'actionColumnsTemplate' => $this->isUpdate ? '{joinCommunity}{deleteRelation}' : '',
            'deleteRelationTargetIdField' => 'user_id',
            'targetUrl' => '/community/community/associate-community-m2m',
            'createNewTargetUrl' => '/admin/user-profile/create',
            'moduleClassName' => AmosCommunity::className(),
            'targetUrlController' => 'community',
            'postName' => 'User',
            'postKey' => 'user',
            'permissions' => [
                'add' => 'USERPROFILE_UPDATE',
                'manageAttributes' => 'USERPROFILE_UPDATE'
            ],
            'actionColumnsButtons' => [
                'joinCommunity' => function ($url, $model) {
                    $btn = JoinCommunityWidget::widget(['model' => $model, 'isGridView' => true]);
                    return $btn;
                },
                
                'deleteRelation' => function ($url, $model) {
                    $url = '/community/community/elimina-m2m';
                    $module = \Yii::$app->getModule(AmosCommunity::getModuleName());
                    $communityId = $model->id;
                    $targetId = $this->userId;
                    $urlDelete = Yii::$app->urlManager->createUrl([
                        $url,
                        'id' => $communityId,
                        'targetId' => $targetId
                    ]);
                    $loggedUser = Yii::$app->getUser();
                    
                    if (\Yii::$app->user->can(DeleteOwnCommunityRelationRule::className(), ['model' => $model]) && !$module->disableCommunityAssociationUserProfile && $loggedUser->id == $this->userId && ($model->created_by != $loggedUser->id || $loggedUser->can('ADMIN'))) {
                        $btnDelete = Html::a(AmosIcons::show('close', ['class' => 'btn-delete-relation']),
//                            '<p class="btn btn-tool-secondary">' . AmosIcons::show('close') . '</p>',
                            $urlDelete,
                            [
                                'title' => AmosCommunity::t('amoscommunity', 'Delete'),
                                'data-confirm' => AmosCommunity::t('amoscommunity', 'Are you sure to cancel your subscrition to this community?'),
                            ]
                        );
                    } else {
                        $btnDelete = '';
                    }
                    return $btnDelete;
                },
            ],
            'itemsMittente' => $itemsMittente,
        ]);
        
        return "<div id='" . $gridId . "' data-pjax-container='" . $gridId . "-pjax' data-pjax-timeout=\"1000\">"
            . "<h3>" . AmosCommunity::tHtml('amoscommunity', 'Community to which you participate') . "</h3>"
            . $widget . "</div>";
    }
    
    /**
     * @return array|null
     */
    public function getConfirm()
    {
        $controller = Yii::$app->controller;
        $isActionUpdate = ($controller->action->id == 'update');
        $confirm = $isActionUpdate ?
            ['confirm' => BaseAmosModule::t('amoscore', '#confirm_exit_without_saving')]
            : null;
        
        return $confirm;
    }
}
