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
 * @package    arter\amos\comuni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\comuni\controllers\base;

use Yii;
use yii\db\Query;
use yii\helpers\Json;
use yii\web\Controller;
use arter\amos\comuni\models\IstatComuni;
use arter\amos\comuni\models\IstatComuniCap;
use arter\amos\comuni\models\IstatProvince;
use arter\amos\comuni\AmosComuni;

class AjaxController extends Controller
{

    public function actionComuniByProvincia($soppresso = null)
    {
        $req = \Yii::$app->getRequest()->post();
        if (\Yii::$app->getRequest()->isGet) {
            $req = \Yii::$app->getRequest()->get();
        }

        $out = [];
        if (isset($req['depdrop_parents'])) {
            $id = end($req['depdrop_parents']);
            $id_selected = end($req['depdrop_params']);
            $query_by_provincia = IstatComuni::find()->andWhere(['istat_province_id' => $id]);
            if(!is_null($soppresso)) {
                $query_by_provincia ->andWhere(['soppresso' => $soppresso]);
            }
            $comuni = $query_by_provincia->orderBy('nome ASC')->asArray()->all();
            $selected = null;
            if ($id != null && count($comuni) > 0) {
                $selected = '';
                foreach ($comuni as $i => $comune) {
                    $out[] = ['id' => $comune['id'], 'name' => $comune['nome']];

                    if ($id_selected) {
                        $selected = $id_selected;
                    }
                }
                // Shows how you can preselect a value
                return Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }
        return Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionComuni($search = null, $id = null)
    {
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new Query();
            $query->select('id, nome AS text')
                ->from(IstatComuni::tableName())
                ->where('nome LIKE "%' . $search . '%"');
            //->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => IstatComuni::findOne($id)->nome];
        } else {
            $out['results'] = ['id' => 0, 'text' => AmosComuni::t('amoscomuni', 'Nessun risultato trovato')];
        }
        return Json::encode($out);
    }

    public function actionProvince($search = null, $id = null)
    {
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new Query();
            $query->select('id, nome AS text')
                ->from(IstatProvince::tableName())
                ->where('nome LIKE "%' . $search . '%"')
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => IstatProvince::findOne($id)->nome];
        } else {
            $out['results'] = ['id' => 0, 'text' => AmosComuni::t('amoscomuni', 'Nessun risultato trovato')];
        }
        return Json::encode($out);
    }

    public function actionCapsByComune($sospeso = null)
    {
        $req = \Yii::$app->getRequest()->post();
        if (\Yii::$app->getRequest()->isGet) {
            $req = \Yii::$app->getRequest()->get();
        }

        $out = [];
        if (isset($req['depdrop_parents'])) {
            $id = end($req['depdrop_parents']);
            $id_selected = end($req['depdrop_params']);
            $query_by_comune = IstatComuniCap::find()->andWhere(['comune_id' => $id]);
            if(!is_null($sospeso)) {
                $query_by_comune ->andWhere(['sospeso' => $sospeso]);
            }
            $caps = $query_by_comune->orderBy('cap ASC')->asArray()->all();
            $selected = null;
            if ($id != null && count($caps) > 0) {
                $selected = '';
                foreach ($caps as $i => $cap) {
                    $out[] = ['id' => $cap['id'], 'name' => $cap['cap']];

                    if ($id_selected) {
                        $selected = $id_selected;
                    }
                }
                // Shows how you can preselect a value
                return Json::encode(['output' => $out, 'selected' => $selected]);
            }
        }
        return Json::encode(['output' => '', 'selected' => '']);
    }

}
