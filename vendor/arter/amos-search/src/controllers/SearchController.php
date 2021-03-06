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
 * @package    arter\amos\search\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\search\controllers;

use arter\amos\search\models\GeneralSearch;
use Yii;
use arter\amos\core\controllers\BackendController;
use arter\amos\search\assets\SearchAsset;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Class SearchController
 * @package arter\amos\search\controllers
 */
class SearchController extends BackendController
{
    /**
     * @var string $layout
     */
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function init()
    {
        SearchAsset::register(Yii::$app->view);
        $this->setUpLayout();
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),
                [
                'access' => [
                    'class' => AccessControl::className(),
                    'ruleConfig' => [
                        'class' => AccessRule::className(),
                    ],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'do-search'
                            ],
                            'roles' => ['@']
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['post', 'get']
                    ]
                ]
        ]);
    }

    public function actionIndex($layout = null, $queryString = null, $tagIds = null, $moduleName = null)
    {
        /*
        pr('here');
        die();
        */

        Url::remember();
        $modelSearch = new GeneralSearch();
        $searchModule = Yii::$app->getModule('search');
        if(!$searchModule->enableNetworkScope) {
            $moduleCwh = Yii::$app->getModule('cwh');
            if (!is_null($moduleCwh)) {
                $moduleCwh->resetCwhScopeInSession();
            }
        }
        $modulesToSearch = $searchModule->modulesToSearch;
        //controllo dentro la queryString se vengono passati tags o caratteri che eseguono codice esterno
        //$toFilterRequest = \Yii::$app->request->get();
        //$filteredRequest = $modelSearch->filterRequest($toFilterRequest);
        /*
        pr($filteredRequest);
        die();
        */
        //$modelSearch->load($filteredRequest);
        $modelSearch->load(\Yii::$app->request->get());

        /*
        pr(\Yii::$app->request->get());
        die();
        */
              

        if (!empty($tagIds) && array_key_exists('admin', $modulesToSearch)) {
            $admin['admin']  = $modulesToSearch['admin'];
            $modulesToSearch = array_diff($modulesToSearch, $admin);
        }

        //if there's a current module, display the result block for that module first
        if (!is_null($moduleName) && array_key_exists($moduleName, $modulesToSearch)) {
            $moduleArray[$moduleName] = $modulesToSearch[$moduleName];
            if (!empty($tagIds)) {
                $modulesToSearch = $moduleArray;
            } else {
                $modulesToSearch = ArrayHelper::merge($moduleArray, $modulesToSearch);
            }
        }

        return $this->render('index',
                [
                'queryString' => $queryString,
                'tagIds' => $tagIds,
                'searchModels' => $modulesToSearch,
                'moduleName' => $moduleName ? $moduleName : null,
                'modelSearch' => $modelSearch
        ]);
    }

    public function actionDoSearch($layout = null, $queryString = null, $moduleName = null, $tagIds = null)
    {
        /*
        pr('here');
        die();
        */

        /*
        pr(\Yii::$app->request->get());
        die();
        */
        //pr($layout);
        //pr($queryString, 'test');
        //die();

        Url::remember();
        $modelSearch = new GeneralSearch();

        /*
        $toFilterRequest = \Yii::$app->request->get();
        $filteredRequest = $modelSearch->filterRequest($toFilterRequest);
        $queryString = $modelSearch->filterRequest();
        */

        /*
        pr($filteredRequest);
        pr($queryString);
        die();
        */
        
        
        //$modelSearch->load($filteredRequest);
        
        /*
        pr($test, 'test2');
        die();
        */

        $modelSearch->load(\Yii::$app->request->get());
        $searchModule = Yii::$app->getModule('search');
        if(!$searchModule->enableNetworkScope) {
            $moduleCwh = Yii::$app->getModule('cwh');
            if (!is_null($moduleCwh)) {
                $moduleCwh->resetCwhScopeInSession();
            }
        }



        $searchParamsArray = !empty($queryString) ? explode(" ", $queryString) : [];

        $searchModelName    = $searchModule->modulesToSearch[$moduleName];
        $currentModelSearch = new $searchModelName();

        $modelLabel = $currentModelSearch->getGrammar()->getModelLabel();

        if (!empty($tagIds)) {
            $arrayTagIds = explode(',',$tagIds);
            $dataProvider = $currentModelSearch->globalSearchTags($arrayTagIds);
        } else {
            $dataProvider = $currentModelSearch->globalSearch($searchParamsArray);

        }

        if (Yii::$app->request->isPjax) {
           
            return $this->render('doSearch',
                    [
                    'dataProvider' => $dataProvider,
                    'queryString' => $queryString,
                    'tagIds' => $tagIds,
                    'moduleName' => $moduleName ? $moduleName : null,
                    'modelLabel' => $modelLabel ? $modelLabel : null,
                    'modelSearch' => $modelSearch
            ]);
        } else {
            //die('not pjax');
            // La richiesta non ?? Pjax. Faccio redirect alla search index passando la query string.
            return $this->redirect(['/search/search/index', 'queryString' => $queryString, 'tagIds' => $tagIds, 'moduleName' => $moduleName]);
        }
    }
}