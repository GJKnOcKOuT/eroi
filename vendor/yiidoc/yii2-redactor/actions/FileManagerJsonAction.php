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
 */

namespace yii\redactor\actions;


use yii\base\Action;
use yii\helpers\FileHelper;
use yii\web\HttpException;
use Yii;

class FileManagerJsonAction extends Action
{

    public function init()
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, 'This action allow only ajaxRequest');
        }
    }

    public function run()
    {
        $config = ['recursive' => true];
        if (!is_null(Yii::$app->controller->module->imageAllowExtensions)) {
            $onlyExtensions = array_map(function ($ext) {
                return '*.' . $ext;
            }, Yii::$app->controller->module->imageAllowExtensions);
            $config['only'] = $onlyExtensions;
        }
        $filesPath = FileHelper::findFiles(Yii::$app->controller->module->getSaveDir(), $config);
        if (is_array($filesPath) && count($filesPath)) {
            $result = [];
            foreach ($filesPath as $filePath) {
                $url = Yii::$app->controller->module->getUrl(pathinfo($filePath, PATHINFO_BASENAME));
                $fileName = pathinfo($filePath, PATHINFO_FILENAME);
                $result[] = ['title' => $fileName, 'name' => $fileName, 'link' => $url, 'size' => Yii::$app->formatter->asShortSize(filesize($filePath)), 2];
            }
            return $result;
        }
    }
}