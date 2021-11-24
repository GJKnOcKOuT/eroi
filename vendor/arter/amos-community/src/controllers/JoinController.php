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
 * @package    arter\amos\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\community\controllers;

use arter\amos\community\AmosCommunity;
use arter\amos\community\assets\AmosCommunityAsset;
use arter\amos\community\models\Community;
use arter\amos\community\models\CommunityUserMm;
use arter\amos\community\models\search\CommunitySearch;
use arter\amos\community\rbac\UpdateOwnNetworkCommunity;
use arter\amos\core\controllers\CrudController;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class JoinController extends CrudController
{
    /**
     * @var string $layout
     */
//    public $layout = 'main';
//    public $layout = 'room';
    public $layout = 'view_network';

    /**
     * @inheritdoc
     */
    public function init()
    {

        $this->setModelObj(AmosCommunity::instance()->createModel('Community'));
        $this->setModelSearch(new CommunitySearch());

        $this->setAvailableViews([]);

        AmosCommunityAsset::register(Yii::$app->view);

        parent::init();

        $this->setUpLayout();
    }

    /**
     * @inheritdoc
     * @return mixed
     */
    public function behaviors()
    {
        $behaviors = ArrayHelper::merge([],
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'live-chat',
                            ],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'remove'
                            ],
                            'roles' => ['COMMUNITY_MEMBER', 'COMMUNITY_READER', 'AMMINISTRATORE_COMMUNITY', 'BASIC_USER']
                        ],
                    ]
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['post', 'get']
                    ]
                ]
            ]);
        return $behaviors;
    }

    public function actionIndex($layout = null, $id = null, $subscribe = null, $urlRedirect = null)
    {
        /** @var  $model Community*/
        $model = $this->findModel($id);

        $userCommunity = CommunityUserMm::findOne(['user_id' => Yii::$app->user->id, 'community_id' => $id]);

        if($subscribe == 1 && $model->community_type_id == 1 && empty($userCommunity)){
            $module = \Yii::$app->getModule('community');
            if($module) {
                $module->createCommunityUser($model->id, CommunityUserMm::STATUS_ACTIVE, CommunityUserMm::ROLE_PARTICIPANT, \Yii::$app->user->id);
                $userCommunity = CommunityUserMm::findOne(['user_id' => Yii::$app->user->id, 'community_id' => $id]);
            }
        }



        /**
         * If The User is not subscribed to community
         */
        if (empty($model)) {
            return $this->redirect(['/dashboard']);
        }
        if (empty($userCommunity)) {
            if ($model->community_type_id == 2) {

                $this->addFlash('danger',
                    AmosCommunity::t('amosadmin', 'You Can\'t access a community you are not a member of'));
                return $this->redirect(['/community/community/view', 'id' => $id]);
            } else if ($model->community_type_id == 3) {

                return $this->redirect(['/dashboard']);
            }
        }


        $moduleCwh = \Yii::$app->getModule('cwh');
        if (isset($moduleCwh)) {
            $moduleCwh->setCwhScopeInSession([
                'community' => $id,
            ],
                [
                    'mm_name' => 'community_user_mm',
                    'entity_id_field' => 'community_id',
                    'entity_id' => $id
                ]);
        }

        if($subscribe == 1 && !empty($urlRedirect)){
            return $this->redirect($urlRedirect);
        }


        $this->setListsBreadcrumbs($model);
        return $this->render('index', [
            'model' => $model
        ]);
    }

    /**
     * @return string
     */
    public function actionRemove()
    {
        $moduleCwh = \Yii::$app->getModule('cwh');
        if (isset($moduleCwh)) {
            $moduleCwh->resetCwhScopeInSession();
        }
        return;
    }

    /**
     * @return string
     */
    public function actionLiveChat() {
        return $this->render('live-chat');
    }

    /**
     * Used to set page title and breadcrumbs.
     *
     * @param Community $model Page title (ie. Created by, ...)
     */
    private function setListsBreadcrumbs($model)
    {
        if ($model->context != Community::className()) {
            $contextModel                            = Yii::createObject($model->context);
            $callingModel                            = $contextModel::findOne(['community_id' => $model->id]);
//            $createRedirectUrlParams = [
//                $callingModel->getPluginModule() . '/' . $callingModel->getPluginController() . '/' . $callingModel->getRedirectAction(),
//                'id' => $callingModel->id,
//            ];
//            $redirectUrl = Yii::$app->urlManager->createUrl($createRedirectUrlParams);
            Yii::$app->view->params['breadcrumbs'][] = [
                'label' => $model->name,
                'url' => Url::previous(),
                'remove_action' => '/community/join/remove'
            ];
        } else {
            Yii::$app->view->params['breadcrumbs'][] = [
                'label' => AmosCommunity::t('amoscommunity', 'Community'),
                'url' => \yii\helpers\Url::to('/community'),
                'remove_action' => '/community/join/remove'
            ];
        }
        Yii::$app->view->params['breadcrumbs'][] = AmosCommunity::t('amoscommunity', "Dashboard");
    }
}