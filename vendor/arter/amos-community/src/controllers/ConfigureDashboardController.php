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
use arter\amos\community\models\CommunityAmosWidgetsMm;
use arter\amos\community\models\CommunityUserMm;
use arter\amos\community\models\search\CommunitySearch;
use arter\amos\community\rbac\UpdateOwnNetworkCommunity;
use arter\amos\community\utilities\CommunityUtil;
use arter\amos\community\widgets\ConfigureDashboardCommunityWidget;
use arter\amos\core\controllers\CrudController;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\widget\WidgetAbstract;
use arter\amos\dashboard\AmosDashboard;
use arter\amos\dashboard\models\AmosWidgets;
use arter\amos\dashboard\models\search\AmosWidgetsSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class ConfigureDashboardController extends CrudController
{
    /**
     * @var string $layout
     */
//    public $layout = 'main';
//    public $layout = 'room';

    /**
     * @inheritdoc
     */
    public function init()
    {

        $this->setModelObj(AmosCommunity::instance()->createModel('Community'));
        $this->setModelSearch(new CommunitySearch());

        $this->setAvailableViews([]);

        AmosCommunityAsset::register(Yii::$app->view);
        $this->setAvailableViews([
            'grid' => [
                'name' => 'grid',
                'label' => AmosDashboard::t('amosdashboard',
                    '{iconaTabella}'.Html::tag('p', AmosDashboard::t('amosdashboard', 'Tabella')),
                    [
                        'iconaTabella' => AmosIcons::show('view-list-alt')
                    ]),
                'url' => '?currentView=grid'
            ],
            'icon' => [
                'name' => 'icon',
                'label' => AmosDashboard::t('amosdashboard',
                    '{iconaElenco}'.Html::tag('p', AmosDashboard::t('amosdashboard', 'Icone')),
                    [
                        'iconaElenco' => AmosIcons::show('grid')
                    ]),
                'url' => '?currentView=icon'
            ],
        ]);

        parent::init();

        if(!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->view->pluginIcon = 'dash dash-dashboard';
        }

        $this->setUpLayout();

    }

    /**
     * @inheritdoc
     * @return mixed
     */
    public function behaviors()
    {
        $behaviors =
                [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                            ],
                            'roles' => ['COMMUNITY_WIDGETS_CONFIGURATOR'],
                        ],
                    ]
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['post', 'get']
                    ]
                ]
        ];
        return $behaviors;
    }

    public function actionIndex($layout = null, $id = null)
    {
        Url::remember();
        $this->setUpLayout('list');
        $moduleCwh = \Yii::$app->getModule('cwh');
        if (is_null($id) && isset($moduleCwh) && !empty($moduleCwh->getCwhScope())) {
            $scope = $moduleCwh->getCwhScope();
            if (isset($scope['community'])) {
                $id = $scope['community'];
            }
        }
        $model = $this->findModel($id);
        $params = ConfigureDashboardCommunityWidget::getDashBoardWidgets($model);
        if(\Yii::$app->request->isPost){
            $model->saveDashboardCommunity();
            return $this->redirect(['/community/configure-dashboard', 'id' => $id]);
        }

        $params ['currentView'] = $this->getCurrentView();
        $params ['availableViews'] = $this->getAvailableViews();

        return $this->render('index', $params);
    }

}