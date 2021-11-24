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
 * @package    arter\amos\community\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\community\controllers;

use arter\amos\community\exceptions\CommunityException;
use arter\amos\community\models\Community;
use arter\amos\community\utilities\ReportsUtility;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class ReportsController
 * @package arter\amos\community\controllers
 */
class ReportsController extends Controller
{
    /**
     * @var ReportsUtility $reportUtility
     */
    private $reportUtility = null;
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        $this->reportUtility = new ReportsUtility();
    }
    
    /**
     * @inheritdoc
     * @return mixed
     */
    public function behaviors()
    {
        $behaviors = ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'uploaded-files-size',
                            'contacts-list',
                            'documents-types',
                            'access-frequency',
                            'all-uploaded-files-size',
                            'all-contacts-list',
                            'all-documents-types',
                            'all-access-frequency',
                        ],
                        'roles' => ['AMMINISTRATORE_COMMUNITY']
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post']
                ]
            ]
        ]);
        return $behaviors;
    }
    
    /**
     * @param int $id
     * @return string
     * @throws CommunityException
     * @throws NotFoundHttpException
     */
    public function actionUploadedFilesSize($id)
    {
        $community = $this->findModel($id);
        $excel = $this->reportUtility->uploadedFileSizesByCommunity($community);
        return $excel;
    }
    
    /**
     * @return string
     * @throws CommunityException
     */
    public function actionAllUploadedFilesSize()
    {
        $excel = $this->reportUtility->uploadedFileSizes();
        return $excel;
    }
    
    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionContactsList($id)
    {
        $community = $this->findModel($id);
        $models = $this->reportUtility->getCommunityAndSubcommunitiesUsersData($community);
        $columns = $this->reportUtility->getCommunityAndSubcommunitiesUsersColumns();
        $excel = $this->reportUtility->makeExcel($models, $columns);
        return $excel;
    }
    
    /**
     * @return string
     */
    public function actionAllContactsList()
    {
        $models = $this->reportUtility->getAllCommunityAndSubcommunitiesUsersData();
        $columns = $this->reportUtility->getCommunityAndSubcommunitiesUsersColumns();
        $excel = $this->reportUtility->makeExcel($models, $columns);
        return $excel;
    }
    
    /**
     * @param int $id
     * @return string
     * @throws CommunityException
     * @throws NotFoundHttpException
     */
    public function actionDocumentsTypes($id)
    {
        $community = $this->findModel($id);
        $excel = $this->reportUtility->uploadedFileTypesByCommunity($community);
        return $excel;
    }
    
    /**
     * @return string
     * @throws CommunityException
     */
    public function actionAllDocumentsTypes()
    {
        $excel = $this->reportUtility->uploadedFileTypes();
        return $excel;
    }
    
    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionAccessFrequency($id)
    {
        $community = $this->findModel($id);
        $models = $this->reportUtility->getCommunityFrequencyData($community);
        $columns = $this->reportUtility->getCommunityFrequencyColumns();
        $excel = $this->reportUtility->makeExcel($models, $columns);
        return $excel;
    }
    
    /**
     * @return string
     */
    public function actionAllAccessFrequency()
    {
        $models = $this->reportUtility->getAllCommunityFrequencyData();
        $columns = $this->reportUtility->getCommunityFrequencyColumns();
        $excel = $this->reportUtility->makeExcel($models, $columns);
        return $excel;
    }
    
    /**
     * @param int $id
     * @return Community
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        $model = Community::findOne($id);
        if (is_null($model)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $model;
    }
}
