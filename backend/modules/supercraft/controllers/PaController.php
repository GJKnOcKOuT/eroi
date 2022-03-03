<?php

namespace backend\modules\supercraft\controllers;

use backend\modules\supercraft\models\AttivitaReale;
use backend\modules\supercraft\models\FaseReale;
use backend\modules\supercraft\models\FasiDiProcesso;
use backend\modules\supercraft\models\PadreDi;
use backend\modules\supercraft\models\ProcessoAziendale;
use backend\modules\supercraft\models\PaSearch;
use backend\modules\supercraft\models\User;
use backend\modules\supercraft\models\dashboard;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\SqlDataProvider;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaController implements the CRUD actions for ProcessoAziendale model.
 */
class PaController extends Controller
{
    public $layout = 'main';

    /**
     * @var mixed
     */

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['ADMIN', 'VALIDATED_BASIC_USER']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post', 'get']
                ]
            ]
        ];
    }

    /**
     * Lists all ProcessoAziendale models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new PaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('dashboard', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDashboard()
    {
        $count = Yii::$app->db->createCommand(' SELECT COUNT(*) FROM processo_aziendale WHERE id_azienda = 1');
        $searchModel = new PaSearch();
        $sql = "SELECT *
                FROM  processo_aziendale
                WHERE id_azienda = 1
        ";
        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count
        ]);
        return $this->render('dashboard', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionIncorso()
    {
        $count = Yii::$app->db->createCommand(' SELECT COUNT(*) FROM processo_aziendale WHERE id_azienda = 1');
        $searchModel = new PaSearch();
        $sql = "SELECT *
                FROM  processo_aziendale
                WHERE 
                      id_azienda = 1 AND (data_fine > CURDATE() OR data_fine IS NULL)      
        ";
        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count
        ]);
        return $this->render('dashboard', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionArchiviati()
    {
        $count = Yii::$app->db->createCommand(' SELECT COUNT(*) FROM processo_aziendale WHERE id_azienda = 1');
        $searchModel = new PaSearch();
        $sql = $this->queryDataArchiviati();
        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count
        ]);
        return $this->render('dashboard', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Mostra le opportunita all'utente, cioè tutte i processi aziendali che potrebbero essere di suo interesse
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionOpportunita()
    {
        {
            $count = Yii::$app->db->createCommand(' SELECT COUNT(*) FROM processo_aziendale WHERE id_azienda = 1');
            $searchModel = new PaSearch();
            $sql = "SELECT *
                FROM  processo_aziendale
                WHERE NOT id_azienda = 1
                ";
            $dataProvider = new SqlDataProvider([
                'sql' => $sql,
                'totalCount' => $count
            ]);
            return $this->render('opportunita', [
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function queryData($id_azienda, $id_processo_aziendale, $type)
    {
        if ($id_processo_aziendale === 0) {
            if ($type === 1) {
                return ProcessoAziendale::find()
                    ->where(['!=', 'id_azienda', $id_azienda])
                    ->select(['id_processo_aziendale', 'nome', 'id_azienda', 'data_inizio', 'descrizione'])
                    ->asArray()
                    ->all();
            }
            return processoAziendale::find()
                ->where(['=', 'id_azienda', $id_azienda])
                ->select(['id_processo_aziendale', 'nome', 'id_azienda', 'data_inizio', 'descrizione'])
                ->asArray()
                ->all();
        }
        return processoAziendale::find()
            ->where(['=', 'id_azienda', $id_azienda])
            ->andWhere(['=', 'id_processo_aziendale', $id_processo_aziendale])
            ->select(['id_processo_aziendale', 'nome', 'id_azienda', 'data_inizio', 'descrizione'])
            ->asArray()
            ->all();

    }

    private function queryDataInCorso()
    {

        return processoAziendale::find()
            ->select(['id_processo_aziendale', 'nome', 'id_azienda', 'data_inizio', 'data_fine', 'descrizione'])
            ->where("id_azienda = 1")
            ->andWhere(['>', 'data_fine', date("Y-m-d H:i:s")])
            ->orWhere(['=', 'data_fine', ''])
            ->asArray()
            ->all();

    }

    private function queryDataArchiviati()
    {
        return "SELECT *
                FROM  processo_aziendale
                WHERE id_azienda = 1 AND data_fine <= " . date("Y-m-d") . "
                ";

    }

    public function actionQuery()
    {
        $model = new dashboard();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (isset($_POST['id_azienda']) && isset($_POST['id_processo_aziendale'])) {
                $this->visualizza($this->queryData($_POST['id_azienda'], $_POST['id_processo_aziendale'], new ProcessoAziendale));
            }
            Yii::$app->session->setFlash('success', 'You have entered the data correctly');
        }
        return $this->render('query', ['model' => $model]);

    }

    /**
     * @param int $id_processo_aziendale Id Processo Aziendale
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionHome($id_processo_aziendale)
    {
        $searchModel = new PaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('home', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProcessoAziendale model.
     * @param int $id_processo_aziendale Id Processo Aziendale
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_processo_aziendale, $fl)
    {


        $sql = ("SELECT fp.*,fr.*
FROM processo_aziendale pa 
INNER JOIN processo_innovativo pi ON (pa.id_processo_innovativo = pi.id_processo_innovativo)
INNER JOIN fasi_di_processo fp ON (fp.id_processo_innovativo = pi.id_processo_innovativo) 
LEFT JOIN fase_reale fr ON (fr.id_processo_aziendale = pa.id_processo_aziendale AND fr.id_fasi_di_processo = fp.id_fasi_di_processo)
WHERE pa.id_processo_aziendale =" . $id_processo_aziendale);

        $count = Yii::$app->db->createCommand(' SELECT COUNT(*) FROM fasi_di_processo WHERE id_processo_innovativo =' . $this->findModel($id_processo_aziendale)->id_processo_innovativo);
        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count
        ]);
        return $this->render('statoprocesso', [
            'dataProvider' => $dataProvider,
            'model' => $this->findModel($id_processo_aziendale),
            'id_processo_aziendale' => $id_processo_aziendale,
            'fl' => $fl,
        ]);
    }

    public function actionViewazioni($id_processo_aziendale, $id_fase_reale, $fl)
    {


        $sql = ("SELECT *
FROM attivita_reale 
WHERE fase_reale_id_fase_reale =" . $id_fase_reale);


        $count = Yii::$app->db->createCommand(' SELECT COUNT(*) FROM attivita_reale WHERE id_processo_aziendale =' . $id_processo_aziendale . ' AND id_fase_reale =' . $id_fase_reale);
        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count
        ]);
        return $this->render('statofase', [
            'dataProvider' => $dataProvider,
            'model' => $this->findModel($id_processo_aziendale),
            'fase_reale' => $id_fase_reale,
            'fl' => $fl
        ]);
    }

    public function actionFinefase($id_fase_reale)
    {
        $model = FaseReale::findOne($id_fase_reale);
        $model->data_fine = date("Y-m-d H:i:s");
        $model->save();
        $padre = PadreDi::find()
            ->where(['=', 'id_padre', $model['id_fasi_di_processo']])
            ->asArray()
            ->all();
            $figlio = FasiDiProcesso::find()
                ->where(['=', "id_fasi_di_processo", $padre[0]['id_figlio']])
                ->asArray()
                ->all();
            $nuova_fase = new FaseReale();
            $nuova_fase->data_inizio = date("Y-m-d H:i:s");
            $nuova_fase->descrizione = $figlio[0]['nome_processo'];
            $nuova_fase->id_processo_aziendale = $model->id_processo_aziendale;
            $nuova_fase->id_fasi_di_processo = $figlio[0]['id_fasi_di_processo'];
            $nuova_fase->save();
            if ($nuova_fase == '') {
                ProcessoAziendale::findOne($model->id_processo_aziendale)->data_fine = date("Y-m-d H:i:s");
            }
        return $this->redirect(['view?id_processo_aziendale=' . $model->id_processo_aziendale . '&fl=0']);
    }

    /**a
     * Creates a new ProcessoAziendale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public
    function actionCreate()
    {
        $model = new ProcessoAziendale();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['dashboard', 'id_processo_aziendale' => $model->id_processo_aziendale, 'fl' => 0]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new ProcessoAziendale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public
    function actionCreateattivita($id_fase_reale, $id_processo_aziendale)
    {
        $model = new AttivitaReale();
        $model['data_fine'] = '';
        $model['fase_reale_id_fase_reale'] = $id_fase_reale;
        $model['data_inizio'] = date("Y-m-d H:i:s");
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['viewazioni', 'id_processo_aziendale' => $id_processo_aziendale, 'id_fase_reale' => $id_fase_reale, 'fl' => 0]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('createattivita', [
            'model' => $model,
        ]);
    }

    public
    function actionFineattivita($id_attivita_reale, $id_processo_aziendale)
    {
        $model = AttivitaReale::findOne($id_attivita_reale);
        $model['data_fine'] = date("Y-m-d H:i:s");
        $model->save();
        return $this->redirect(['viewazioni?id_processo_aziendale=' . $id_processo_aziendale . '&id_fase_reale=' . $model['fase_reale_id_fase_reale'] . '&fl=0']);
    }

    /**
     * Updates an existing ProcessoAziendale model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_processo_aziendale Id Processo Aziendale
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionUpdate($id_processo_aziendale)
    {
        $model = $this->findModel($id_processo_aziendale);

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['viewazioni?id_processo_aziendale=' . $id_processo_aziendale . '&id_fase_reale=' . $model['fase_reale_id_fase_reale']]);
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
    public
    function actionDelete($id_processo_aziendale)
    {
        try {
            $this->findModel($id_processo_aziendale)->delete();
        } catch (Exception $err) {
            return $err;
        }


        return $this->redirect(['index']);
    }

    /**
     * Finds the ProcessoAziendale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_processo_aziendale Id Processo Aziendale
     * @return ProcessoAziendale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id_processo_aziendale)
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
