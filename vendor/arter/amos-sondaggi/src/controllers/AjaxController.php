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
 * @package    arter\amos\sondaggi\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\sondaggi\controllers;

use arter\amos\sondaggi\AmosSondaggi;
use arter\amos\sondaggi\models\SondaggiDomande;
use arter\amos\sondaggi\models\SondaggiDomandePagine;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * Class AjaxController
 * @package arter\amos\sondaggi\controllers
 */
class AjaxController extends Controller
{
    /**
     * @inheritdoc
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
                            'domande-by-pagine',
                            'pagine',
                            'pagine-by-sondaggio',
                        ],
                        'roles' => ['@']
                    ]
                ]
            ]
        ]);
        return $behaviors;
    }

    public function actionPagineBySondaggio()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $id_selected = end($_POST['depdrop_params']);
            $pagine = SondaggiDomandePagine::find()->andWhere(['sondaggi_id' => $id])->asArray()->all();
            $selected = null;
            if ($id != null && count($pagine) > 0) {
                $selected = '';
                foreach ($pagine as $i => $pagina) {

                    $out[] = ['id' => $pagina['id'], 'name' => $pagina['titolo']];

                    if ($id_selected) {
                        $selected = $id_selected;
                    } elseif ($i == 0) {
                        $selected = $pagina['id'];
                    }
                }
                // Shows how you can preselect a value
                return Json::encode(['output' => $out, 'selected' => $selected]);
            }
        }
        return Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionDomandeByPagine()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $id_selected = end($_POST['depdrop_params']);
            $pagine = SondaggiDomande::find()->andWhere(['sondaggi_domande_pagine_id' => $id])->orderBy('ordinamento ASC')->asArray()->all();
            $selected = null;
            if ($id != null && count($pagine) > 0) {
                $selected = '';
                foreach ($pagine as $i => $pagina) {

                    $out[] = ['id' => $pagina['id'], 'name' => $pagina['domanda']];

                    if ($id_selected) {
                        $selected = $id_selected;
                    } elseif ($i == 0) {
                        $selected = $pagina['id'];
                    }
                }
                // Shows how you can preselect a value
                return Json::encode(['output' => $out, 'selected' => $selected]);
            }
        }
        return Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionPagine($search = null, $id = null)
    {
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new Query();
            $query->select('id, titolo AS text')
                ->from('sondaggi_domande_pagine')
                ->where('titolo LIKE "%' . $search . '%"');
            //->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => SondaggiDomandePagine::findOne($id)->titolo];
        } else {
            $out['results'] = ['id' => 0, 'text' => AmosSondaggi::t('amossondaggi', 'Nessun risultato trovato')];
        }
        return Json::encode($out);
    }
}
