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
 * @package    arter\amos\myactivities\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\myactivities\controllers;

use arter\amos\core\controllers\CrudController;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\myactivities\AmosMyActivities;
use arter\amos\myactivities\models\MyActivities;
use arter\amos\myactivities\models\search\MyActivitiesModelSearch;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Class MyActivitiesController
 * MyActivitiesController implements the CRUD actions
 *
 * @property \arter\amos\myactivities\models\MyActivities $model
 * @property \arter\amos\myactivities\models\MyActivities $modelSearch
 *
 * @package arter\amos\myactivities\controllers
 */
class MyActivitiesController extends CrudController
{
    /**
     * @var string $layout
     */
    public $layout = 'list';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setModelObj(new MyActivities());
        $this->setModelSearch(new MyActivities());

        $this->setAvailableViews([
            'list' => [
                'name' => 'list',
                'label' => AmosIcons::show('view-list') . Html::tag('p', AmosMyActivities::t('amoscore', 'List')),
                'url' => '?currentView=list'
            ],
        ]);

        parent::init();
        
        $this->setUpLayout();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'index',
                        ],
                        'roles' => ['ADMIN', 'VALIDATED_BASIC_USER']
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
    }

    /**
     * @param string|null $layout
     * @return string
     */
    public function actionIndex($layout = NULL)
    {
        /** @var \arter\amos\cwh\AmosCwh $moduleCwh */
        $moduleCwh = \Yii::$app->getModule('cwh');
        if (isset($moduleCwh)) {
            $moduleCwh->resetCwhScopeInSession();
        }
        
        Url::remember();
        $this->setUpLayout('list');

        $modelSearch = new MyActivitiesModelSearch;
        $modelSearch->load(\Yii::$app->request->getQueryParams());

        $model = new MyActivities();
        $listOfActivities = $model->getMyActivities($modelSearch);
        
        $dataProvider = new ArrayDataProvider();
        if (count($listOfActivities) > 0) {
            $dataProvider->setModels($listOfActivities);
            $this->parametro['empty'] = false;
        } else {
            $dataProvider->setModels([]);
            $this->parametro['empty'] = true;
        }
        $this->dataProvider = $dataProvider;

        $this->setModelSearch($modelSearch);
        
        return parent::actionIndex();
    }
}