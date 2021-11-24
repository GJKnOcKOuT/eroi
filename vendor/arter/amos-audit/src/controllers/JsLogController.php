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

use arter\amos\audit\Audit;
use arter\amos\audit\models;

use Yii;
use yii\helpers\Json;
use yii\web\Response;

/**
 * JsLogController
 * @package arter\amos\audit\controllers
 */
class JsLogController extends \yii\web\Controller
{
    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * @return array
     */
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Json::decode(Yii::$app->request->post('data'));
        if (!isset($data['auditEntry'])) {
            $entry = Audit::getInstance()->getEntry(true);
            $data['auditEntry'] = $entry->id;
        }

        // Convert data into the loggable object
        $javascript = new models\AuditJavascript();
        $map = [
            'auditEntry' => 'entry_id',
            'message'    => 'message',
            'type'       => 'type',
            'file'       => 'origin',
            'line'       => function ($value) use ($javascript) {
                $javascript->origin .= ':' . $value;
            },
            'col'        => function ($value) use ($javascript) {
                $javascript->origin .= ':' . $value;
            },
            'data'       => function ($value) use ($javascript) {
                if (count($value)) $javascript->data = $value;
            },
        ];

        foreach ($map as $key => $target)
            if (isset($data[$key])) {
                if (is_callable($target)) $target($data[$key]);
                else $javascript->$target = $data[$key];
            }

        if (!$javascript->type)
            $javascript->type = 'unknown';

        if ($javascript->save())
            return ['result' => 'ok', 'entry' => $data['auditEntry']];

        return ['result' => 'error', 'errors' => $javascript->getErrors()];
    }
}