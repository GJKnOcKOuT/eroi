<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


namespace arter\amos\audit\controllers;

use arter\amos\audit\components\Helper;
use arter\amos\audit\components\web\Controller;
use arter\amos\audit\models\AuditMail;
use arter\amos\audit\models\AuditMailSearch;

use Yii;
use yii\web\NotFoundHttpException;

/**
 * MailController
 * @package arter\amos\audit\controllers
 */
class MailController extends Controller
{
    /**
     * Lists all AuditMail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuditMailSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single AuditMail model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = AuditMail::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('The requested mail does not exist.');
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single AuditMail model's HTML.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionViewHtml($id)
    {
        $model = AuditMail::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('The requested mail does not exist.');
        }
        $this->layout = false;
        return $this->render('view-html', [
            'model' => $model,
        ]);
    }

    /**
     * Download an AuditMail file as eml.
     * @param $id
     * @throws NotFoundHttpException
     */
    public function actionDownload($id)
    {
        $model = AuditMail::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('The requested mail does not exist.');
        }
        Yii::$app->response->sendContentAsFile(Helper::uncompress($model->data), $model->id . '.eml');
    }
}
