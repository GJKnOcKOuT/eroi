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

use arter\amos\audit\components\web\Controller;
use arter\amos\audit\models\AuditJavascript;
use arter\amos\audit\models\AuditJavascriptSearch;

use Yii;
use yii\web\NotFoundHttpException;

/**
 * JavascriptController
 * @package arter\amos\audit\controllers
 */
class JavascriptController extends Controller
{
    /**
     * Lists all AuditJavascript models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuditJavascriptSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }

    /**
     * Displays a single AuditJavascript model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = AuditJavascript::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('The requested javascript does not exist.');
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
