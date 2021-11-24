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


/**
 * @package   yii2-dynagrid
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2015 - 2019
 * @version   1.5.1
 */

namespace kartik\dynagrid\controllers;

use kartik\dynagrid\models\DynaGridSettings;
use Yii;
use yii\base\InvalidConfigException;
use yii\web\Controller;
use yii\web\Response;

/**
 * SettingsController will manage the actions for dynagrid settings
 *
 * @package kartik\dynagrid\controllers
 */
class SettingsController extends Controller
{
    /**
     * Fetch dynagrid setting configuration
     *
     * @return mixed
     * @throws  InvalidConfigException
     */
    public function actionGetConfig()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new DynaGridSettings();
        $out = ['status' => '', 'content' => ''];
        $request = Yii::$app->request;
        if ($model->load($request->post()) && $model->validate()) {
            $validate = $model->validateSignature($request->post('configHashData', ''));
            if ($validate === true) {
                $out = ['status' => 'success', 'content' => var_export($model->getDataConfig(), true)];
            } else {
                $out = ['status' => 'error', 'content' => '<div class="alert alert-danger">' . $validate . '</div>'];
            }
        }
        return $out;
    }
}