<?php

namespace backend\modules\supercraft\controllers;

use backend\modules\supercraft\models\ProcessoAziendale;
use backend\modules\supercraft\models\PaSearch;
use backend\modules\supercraft\models\query;
use backend\modules\supercraft\models\User;
use backend\modules\supercraft\models\QueryForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaController implements the CRUD actions for ProcessoAziendale model.
 */
class PaController extends Controller
{
    /**
     * @var mixed
     */

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ProcessoAziendale models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*
        $data = $this->queryDataAll();
        $id_azienda = 0;
        echo '<h1> TUTTI </h1>';
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        $data = $this->queryDataInCorso();
        echo '<h1> IN CORSO </h1>';
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        $data = $this->queryDataArchiviati();
        echo '<h1> ARCHIVIATI </h1>';
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        exit;*/

        $searchModel = new PaSearch();
        if (!empty($this->request)) {
            $dataProvider = $searchModel->search($this->request->queryParams);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    private function visualizza($data){
        try {
            echo '<pre>';
            var_dump($data);
            echo '</pre>';
        }catch (InvalidArgumentException $ex){
            return $ex;
        }

    }
    private function queryData($id_azienda,$id_processo_aziendale){
        return processoAziendale::find()
            ->where(['=','id_azienda',$id_azienda])
            ->andWhere(['=','id_processo_aziendale',$id_processo_aziendale])
            ->select(['id_processo_aziendale', 'nome', 'id_azienda', 'data_inizio', 'data_fine', 'descrizione'])
            ->asArray()
            ->all();

    }
    private function queryDataInCorso(){
        $time = new \DateTime('now');
        $today = $time->format('Y-m-d');
        return processoAziendale::find()
            ->select(['id_processo_aziendale', 'nome', 'id_azienda', 'data_inizio', 'data_fine', 'descrizione'])
            ->where("id_azienda = 1")
            ->andWhere(['>=', 'data_fine', $today])
            ->orWhere(['is', 'data_fine', new \yii\db\Expression('null')])
            ->asArray()
            ->all();

    }
    private function queryDataArchiviati(){
        $time = new \DateTime('now');
        $today = $time->format('Y-m-d');
        return processoAziendale::find()
            ->select(['id_processo_aziendale', 'nome', 'id_azienda', 'data_inizio', 'data_fine', 'descrizione'])
            ->where("id_azienda = 1")
            ->andWhere(['<=', 'data_fine', $today])
            ->asArray()
            ->all();

    }

    public function actionQuery()
    {
        $model = new QueryForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            if(isset($_POST['id_azienda']) && isset($_POST['id_processo_aziendale'])){
                $this->visualizza($this->queryData($_POST['id_azienda'],$_POST['id_processo_aziendale']));
            }
            Yii::$app->session->setFlash('success', 'You have entered the data correctly');
        }
        return $this->render('query',['model'=>$model]);

    }

    /**
     * Displays a single ProcessoAziendale model.
     * @param int $id_processo_aziendale Id Processo Aziendale
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_processo_aziendale)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_processo_aziendale),
        ]);
    }

    /**
     * Creates a new ProcessoAziendale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProcessoAziendale();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_processo_aziendale' => $model->id_processo_aziendale]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProcessoAziendale model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_processo_aziendale Id Processo Aziendale
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_processo_aziendale)
    {
        $model = $this->findModel($id_processo_aziendale);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_processo_aziendale' => $model->id_processo_aziendale]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProcessoAziendale model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_processo_aziendale Id Processo Aziendale
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_processo_aziendale)
    {
        $this->findModel($id_processo_aziendale)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProcessoAziendale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_processo_aziendale Id Processo Aziendale
     * @return ProcessoAziendale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_processo_aziendale)
    {
        if (($model = ProcessoAziendale::findOne($id_processo_aziendale)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @return string|void
     */

}
