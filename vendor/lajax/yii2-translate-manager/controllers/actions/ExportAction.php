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


namespace lajax\translatemanager\controllers\actions;

use Yii;
use yii\web\JsonResponseFormatter;
use yii\web\Response;
use yii\web\XmlResponseFormatter;
use lajax\translatemanager\Module;
use lajax\translatemanager\models\ExportForm;

/**
 * Class for exporting translations.
 */
class ExportAction extends \yii\base\Action
{
    /**
     * Show export form or generate export file on post
     *
     * @return string
     */
    public function run()
    {
        /** @var Module $module */
        $module = $this->controller->module;

        $model = new ExportForm([
            'format' => $module->defaultExportFormat,
        ]);

        if ($model->load(Yii::$app->request->post())) {
            $fileName = Yii::t('language', 'translations') . '.' . $model->format;

            Yii::$app->response->format = $model->format;

            Yii::$app->response->formatters = [
                Response::FORMAT_XML => [
                    'class' => XmlResponseFormatter::className(),
                    'rootTag' => 'translations',
                ],
                Response::FORMAT_JSON => [
                    'class' => JsonResponseFormatter::className(),
                ],
            ];

            Yii::$app->response->setDownloadHeaders($fileName);

            return $model->getExportData();
        } else {
            if (empty($model->languages)) {
                $model->exportLanguages = $model->getDefaultExportLanguages($module->defaultExportStatus);
            }

            return $this->controller->render('export', [
                'model' => $model,
            ]);
        }
    }
}
