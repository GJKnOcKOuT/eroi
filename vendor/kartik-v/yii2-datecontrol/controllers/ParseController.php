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
 * @package   yii2-datecontrol
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2016
 * @version   1.9.5
 */

namespace kartik\datecontrol\controllers;

use DateTimeZone;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use kartik\datecontrol\DateControl;

/**
 * ParseController class manages the actions for date conversion via ajax from display to save.
 *
 * @package kartik\datecontrol\controllers
 */
class ParseController extends Controller
{
    /**
     * Convert display date for saving to model.
     *
     * @return string JSON encoded HTML output
     */
    public function actionConvert()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        if (!isset($post['displayDate'])) {
            return ['status' => 'error', 'output' => 'No display date found'];
        }
        $saveFormat = $dispFormat = $dispTimezone = $saveTimezone = $displayDate = '';
        $settings = [];
        extract($post);
        $date = DateControl::getTimestamp($displayDate, $dispFormat, $dispTimezone, $settings);
        if (empty($date) || !$date) {
            $value = '';
        } elseif ($saveTimezone != null) {
            $value = $date->setTimezone(new DateTimeZone($saveTimezone))->format($saveFormat);
        } else {
            $value = $date->format($saveFormat);
        }
        return ['status' => 'success', 'output' => $value];
    }
}